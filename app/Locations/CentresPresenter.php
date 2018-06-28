<?php

namespace App\Locations;

use Laracasts\Presenter\Presenter;

class CentresPresenter extends Presenter
{
    /**
     * @return string
     */
    public function googleMap()
    {
        $address = str_replace(' ', '+', $this->address());

        return 'https://www.google.co.uk/maps/search/' . str_replace(',', '', $address);
    }

    /**
     * @return string
     */
    public function address()
    {
        $add2 = isset( $this->add2 ) ? $this->add2 . ', ' : '';
        $add3 = isset( $this->add3 ) ? $this->add3 . ', ' : '';

        return $this->add1 . ', ' . $add2 . $add3 . $this->add4 . ', ' . $this->add5 . ', ' . $this->post_code;
    }

    /**
     * @return mixed|string
     */
    public function formatTel()
    {
        if ($this->tel == '') {
            return 'N/A';
        }

        return formatTel($this->tel);
    }

} 