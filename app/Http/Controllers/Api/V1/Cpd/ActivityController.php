<?php

namespace App\Http\Controllers\Api\V1\Cpd;

use Carbon\Carbon;
use App\Cpd\Activity;
use App\Cpd\Organisation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cpd\ActivityRequest;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            Activity::with('deliverer')->when(request('user_id'), function ($q) {
                $q->where('user_id', request('user_id'));
            })->get()
        );
    }

    /**
     * @param Activity $activity
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Activity $activity)
    {
        return $this->response($activity->load('deliverer'));
    }

    /**
     * @param ActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ActivityRequest $request)
    {
        return $this->response(Activity::create($this->requestData()));
    }

    /**
     * @param Activity        $activity
     * @param ActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Activity $activity, ActivityRequest $request)
    {
        $activity->update($this->requestData());

        return $this->response($activity);
    }

    /**
     * @param Activity $activity
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Activity $activity)
    {
        if (request('user_id') == $activity->user_id) {
            return $this->response($activity->delete());
        }

        return $this->response(['errors' => ['You are not authorised to delete this activity']], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return array
     */
    private function requestData()
    {
        return [
            'user_id' => request('user_id'),
            'timetable_id' => request('timetable_id'),
            'title' => request('title'),
            'starts_on' => Carbon::createFromFormat('d/m/Y', request('starts_on')),
            'ends_on' => Carbon::createFromFormat('d/m/Y', request('ends_on')),
            'completed_on' => request('completed_on') ? Carbon::createFromFormat('d/m/Y', request('completed_on')) : null,
            'total_hours' => request('total_hours'),
            'grade_id' => request('grade_id'),
            'reflection' => request('reflection'),
            'deliverer_id' => Organisation::firstOrCreate(['name' => request('organisation')])->id,
            'path' => request('path'),
        ];
    }
}
