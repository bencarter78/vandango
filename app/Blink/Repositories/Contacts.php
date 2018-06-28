<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Contact;
use App\Blink\Models\Organisation;

class Contacts extends BlinkRepository
{
    /**
     * @var Organisation
     */
    protected $model;

    /**
     * Organisations constructor.
     *
     * @param $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchByName($name)
    {
        $q = $this->selectFullNameConcatenated();

        env('DB_CONNECTION') == 'testing'
            ? $q->where(\DB::raw("first_name || ' ' || surname"), 'LIKE', "%$name%")
            : $q->where(\DB::raw("CONCAT (first_name, ' ', surname)"), 'LIKE', "%$name%");

        return $q->withTrashed()
                 ->with('organisation')
                 ->get();
    }
}