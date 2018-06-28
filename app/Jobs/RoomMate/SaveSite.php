<?php

namespace App\Jobs\RoomMate;

use Carbon\Carbon;
use App\RoomMate\Models\Site;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveSite
{
    use Dispatchable;

    /**
     * @var Site
     */
    private $site;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param Site  $site
     * @param array $data
     */
    public function __construct(Site $site, array $data = [])
    {
        $this->site = $site;
        $this->data = $data;
        $this->parseOpeningHours();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $site = $this->site->updateOrCreate(['name' => $this->data['name']], $this->data);
        $this->saveLocation($site);

        return $site;
    }

    /**
     * @return void
     */
    public function parseOpeningHours()
    {
        $this->data['opens_at'] = Carbon::parse($this->data['opens_at']);
        $this->data['closes_at'] = Carbon::parse($this->data['closes_at']);
    }

    /**
     * @param $site
     * @return mixed
     */
    private function saveLocation($site)
    {
        if ($site->location) {
            return $site->location->update($this->data);
        }

        return $site->location()->create($this->data);
    }
}
