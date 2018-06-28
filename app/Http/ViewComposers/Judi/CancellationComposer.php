<?php

namespace App\Http\ViewComposers\Judi;

use App\Judi\Models\Cancellation;

class CancellationComposer
{
    /**
     * @var CancellationRepository
     */
    protected $cancellations;

    /**
     * @param Cancellation $cancellations
     */
    function __construct(Cancellation $cancellations)
    {
        $this->model = $cancellations;
    }

    /**
     * @param $view
     * @return mixed
     */
    public function compose($view)
    {
        return $view->with('cancellationReasons', $this->model->orderBy('type')->get());
    }

}