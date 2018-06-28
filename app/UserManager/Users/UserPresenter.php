<?php

namespace App\UserManager\Users;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function name()
    {
        return $this->first_name ? ucwords($this->first_name . ' ' . $this->surname) : '';
    }
}