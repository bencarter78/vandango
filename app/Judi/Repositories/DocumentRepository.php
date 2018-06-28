<?php

namespace App\Judi\Repositories;

use App\Core\BaseRepository;
use App\Judi\Models\Document;

class DocumentRepository extends BaseRepository
{
    /**
     * @var Document
     */
    protected $model;

    /**
     * @param Document $model
     */
    function __construct(Document $model)
    {
        $this->model = $model;
    }

}