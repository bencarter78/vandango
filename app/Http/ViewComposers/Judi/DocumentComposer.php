<?php

namespace App\Http\ViewComposers\Judi;

use App\Judi\Repositories\DocumentRepository;

class DocumentComposer
{
    /**
     * @var DocumentRepository
     */
    protected $documents;

    /**
     * @param DocumentRepository $documents
     */
    function __construct(DocumentRepository $documents)
    {
        $this->documents = $documents;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('documents', $this->documents->getAll('title'));
    }

}