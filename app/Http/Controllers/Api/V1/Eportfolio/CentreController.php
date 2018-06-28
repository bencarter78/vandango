<?php

namespace App\Http\Controllers\Api\V1\Eportfolio;

use App\Eportfolios\Models\Centre;
use App\Http\Controllers\Controller;

class CentreController extends Controller
{
    public function index()
    {
        return $this->response(Centre::with('sectors')->orderBy('name')->get());
    }
}
