<?php
namespace App\Events\Judi;

use App\Events\Event;
use App\Judi\Models\Summary;
use Illuminate\Queue\SerializesModels;

class SummaryWasSubmitted extends Event
{
    use SerializesModels;

    /**
     * @var Summary
     */
    private $summaryId;

    /**
     * Create a new event instance.
     *
     * @param Summary $summaryId
     */
    public function __construct($summaryId)
    {
        $this->summaryId = $summaryId;
    }

    /**
     * @return integer
     */
    public function getSummaryId()
    {
        return $this->summaryId;
    }

}
