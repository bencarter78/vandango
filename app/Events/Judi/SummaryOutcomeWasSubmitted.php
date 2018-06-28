<?php
namespace App\Events\Judi;

use App\Events\Event;
use App\Judi\Models\Summary;
use Illuminate\Queue\SerializesModels;

class SummaryOutcomeWasSubmitted extends Event
{
    use SerializesModels;

    /**
     * @var Summary
     */
    protected $summary;

    /**
     * Create a new event instance.
     *
     * @param Summary $summary
     */
    public function __construct(Summary $summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return Summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

}
