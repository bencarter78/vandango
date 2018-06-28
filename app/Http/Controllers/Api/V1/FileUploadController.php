<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\UserManager\Users\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileUploadController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->download(storage_path('app/' . request('path')));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->validate(request(), ['user_id' => 'required']);

        return $this->response(['path' => request('file')->store('users/' . request('user_id'))], Response::HTTP_CREATED);
    }
}
