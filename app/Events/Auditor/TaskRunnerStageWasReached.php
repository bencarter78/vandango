<?php

namespace App\Events\Auditor;

use App\Auditor\Tasks\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskRunnerStageWasReached implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Task
     */
    public $task;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param Task  $task
     * @param array $data
     */
    public function __construct(Task $task, $data = [])
    {
        $this->task = $task;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('auditor.task.runner');
    }
}
