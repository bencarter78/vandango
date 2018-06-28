<?php

namespace App\UserManager\Users;

use Laracasts\Presenter\Presenter;

class UserMetaPresenter extends Presenter
{

    /**
     * @return mixed|string
     */
    public function formatTel()
    {
        return formatTel($this->tel);
    }

    /**
     * @return mixed|string
     */
    public function formatMobile()
    {
        return formatTel($this->mobile);
    }

    /**
     * @return string
     */
    public function onProbation()
    {
        if ($this->probation_end_date != null) {
            return '<span class="badge badge-warning"><small>Probation</small></span>';
        }
    }
}