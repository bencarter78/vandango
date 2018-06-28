<?php

namespace App\Console\Commands\KeySafe;

use App\KeySafe\Models\Key;
use App\Contracts\HttpClient;
use Illuminate\Console\Command;
use App\KeySafe\Mailers\KeySafeMailer;

class KeyAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keysafe:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns keys to learners';

    /**
     * @var string
     */
    protected $uri = 'http://10.2.70.11/papi/public/api/v2/keysafe';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var LearnerMailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param HttpClient    $client
     * @param KeySafeMailer $mailer
     */
    public function __construct(HttpClient $client, KeySafeMailer $mailer)
    {
        parent::__construct();
        $this->client = $client;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->client->get($this->uri, ['query' => ['type' => 'hair']]);
        if ($learners = $this->client->getContents()) {
            foreach ($learners->data as $learner) {
                if ($this->learnerHasNoKeyAssigned($learner)) {
                    $this->assignKey($learner);
                }
            }
        }

        $this->checkKeyStockLevels();
    }

    /**
     * @param $learner
     * @return bool
     */
    private function learnerHasNoKeyAssigned($learner)
    {
        return Key::withTrashed()->where('ident', $learner->ident)->get()->count() == 0;
    }

    /**
     * @param $email  string
     * @return mixed
     */
    private function isValidEmail($email)
    {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $learner
     * @return bool
     */
    private function assignKey($learner)
    {
        if ( ! $this->isValidEmail($learner->lnr_email)) {
            return $this->mailer->sendLearnerHasInvalidEmailNotification($learner);
        }

        $key = $this->getKey($learner);
        $this->mailer->sendLearnerAccessCode($key, trim($learner->adv_email));
        $this->mailer->sendProgAdminLearnerAccessCode($key);
        $key->delete();
    }

    /**
     * @param $learner
     * @return mixed
     */
    private function getKey($learner)
    {
        $key = Key::whereNull('ident')->first();
        $key->update([
            'ident' => $learner->ident,
            'first_name' => trim($learner->firstname),
            'surname' => trim($learner->surname),
            'email' => trim($learner->lnr_email),
        ]);

        return $key;
    }

    /**
     * @void
     */
    private function checkKeyStockLevels()
    {
        if (Key::all()->count() < 10) {
            $this->mailer->sendLowStockLevelNotification();
        }
    }
}
