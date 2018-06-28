<?php

namespace App\Jobs\Apply;

use App\Jobs\Job;
use App\Contracts\HttpClient;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateApplicantAccount extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param HttpClient $client
     */
    public function handle(HttpClient $client)
    {
        $client->post(env('APPLY_URI'), [
            'headers' => ['key' => env('APPLY_SECRET')],
            'json' => $this->data,
        ]);
    }
}
