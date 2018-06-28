<?php

namespace App\Events\Blink;

use App\Blink\Models\Course;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CoursePriceListWasUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * @var Course
     */
    public $course;

    /**
     * Create a new event instance.
     *
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }
}
