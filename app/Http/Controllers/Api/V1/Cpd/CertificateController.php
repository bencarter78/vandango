<?php

namespace App\Http\Controllers\Api\V1\Cpd;

use App\Cpd\Certificate;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'user_id' => 'required',
            'title' => 'required',
            'path' => 'required',
        ], [
            'title.required' => 'Please enter a title for this certificate',
            'path.required' => 'Please upload a file',
        ]);

        return $this->response(Certificate::create([
            'user_id' => request('user_id'),
            'title' => request('title'),
            'achieved_on' => request('achieved_on'),
            'expires_on' => request('expires_on'),
            'path' => request('path'),
        ]));
    }
}
