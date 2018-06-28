<?php

namespace App\UserManager\Sectors;

use Laracasts\Presenter\Presenter;

class SectorPresenter extends Presenter
{
    /**
     * @return string
     */
    public function sector()
    {
        return $this->name . ' [' . $this->code . ']';
    }

}