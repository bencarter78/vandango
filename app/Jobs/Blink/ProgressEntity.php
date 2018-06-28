<?php

namespace App\Jobs\Blink;

use App\Blink\Repositories\Statuses;

class ProgressEntity
{
    /**
     * @var
     */
    private $entity;

    /**
     * @var
     */
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param $entity
     * @param $userId
     */
    public function __construct($entity, $userId)
    {
        $this->entity = $entity;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @param Statuses $statuses
     * @return void
     * @throws \App\Exceptions\FollowingStatusDoesNotExistException
     */
    public function handle(Statuses $statuses)
    {
        $this->entity->statuses()->attach(
            $statuses->getNextStatus($this->entity->statuses->last())->id,
            ['updated_by' => $this->userId]
        );
    }
}
