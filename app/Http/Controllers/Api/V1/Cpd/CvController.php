<?php

namespace App\Http\Controllers\Api\V1\Cpd;

use App\Cpd\Cv;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update()
    {
        $this->validate(request(), [
            'user_id' => 'required',
            'path' => 'required',
        ], ['path.required' => 'Please upload a file']);

        $cv = Cv::updateOrCreate(['user_id' => request('user_id')], ['path' => request('path')]);


        return $this->response(['path' => $cv->path]);

    }
}
