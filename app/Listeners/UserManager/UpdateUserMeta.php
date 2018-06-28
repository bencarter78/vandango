<?php

namespace App\Listeners\UserManager;

use App\Events\UserManager\UserWasUpdated;

class UpdateUserMeta
{
    /**
     * @var array
     */
    private $attributes = ['tel', 'mobile', 'ext'];

    /**
     * Handle the event.
     *
     * @param  UserWasUpdated $event
     * @return void
     */
    public function handle(UserWasUpdated $event)
    {
        return $event->getUser()->meta->update($this->getData($event->getCommand()));
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getData($request)
    {
        return collect($this->attributes)->flatMap(function ($value) use ($request) {
            return [$value => $request->get($value) == '' ? null : str_replace(' ', '', $request->get($value))];
        })->toArray();
    }
}
