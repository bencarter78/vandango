<?php

namespace App\Judi\Presenters;

use Laracasts\Presenter\Presenter;

class SummaryPresenter extends Presenter
{
    /**
     * @return string
     */
    public function fileName()
    {
        if ($this->document_path != null) {
            $filename = explode('/', $this->document_path);

            return $filename[( count($filename) - 1 )];
        }

        return '';
    }

}