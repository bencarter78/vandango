<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Status;
use App\Exceptions\FollowingStatusDoesNotExistException;

class Statuses extends BlinkRepository
{
    /**
     * @var Status
     */
    protected $model;

    /**
     * Statuses constructor.
     *
     * @param $model
     */
    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    /**
     * @param $current
     * @return mixed
     * @throws FollowingStatusDoesNotExistException
     */
    public function getNextStatus($current)
    {
        $nextStatus = $this->model
            ->whereOwner($current->owner)
            ->whereOrder($current->order + 1)
            ->whereType($current->type)
            ->first();

        if ( ! $nextStatus) {
            throw new FollowingStatusDoesNotExistException('There is no following status to attach to the entity');
        }

        return $nextStatus;
    }

    /**
     * @param        $type
     * @param        $owner
     * @param string $orderBy
     * @return mixed
     */
    public function getTypeByOwner($type, $owner, $orderBy = 'name')
    {
        return $this->model->whereOwner($owner)->whereType($type)->orderBy($orderBy)->get();
    }
}