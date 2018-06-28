<?php

namespace App\Listeners\Blink;

use App\Contracts\HttpClient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Blink\CoursePriceListWasUpdated;

class UpdateExternalPricingCatalogue implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create the event listener.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param  CoursePriceListWasUpdated $event
     * @return void
     */
    public function handle(CoursePriceListWasUpdated $event)
    {
        $this->client->put(config('vandango.api.external.uri') . '/courses', [
            'form_params' => [
                'course' => json_encode($event->course),
                'api_key' => bcrypt(config('vandango.ava.apiKey')),
            ],
        ]);
    }
}
