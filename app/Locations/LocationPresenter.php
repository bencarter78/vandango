<?php

namespace App\Locations;

use Laracasts\Presenter\Presenter;

class LocationPresenter extends Presenter
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
        return collect([$this->add1, $this->add2, $this->add3, $this->town, $this->county, $this->postcode])
            ->reject(function ($el) {
                return $el == '';
            })
            ->implode(', ');
    }

    /**
     * @return mixed|string
     */
    public function formatTel()
    {
        return $this->tel == '' ? 'N/A' : formatTel($this->tel);
    }

} 