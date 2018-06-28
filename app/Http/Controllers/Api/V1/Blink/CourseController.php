<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Events\Blink\CoursePriceListWasUpdated;
use Carbon\Carbon;
use App\Blink\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blink\CourseRequest;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = Course::with('awardingBody', 'sector')->orderBy('title')->get();

        return $this->response($courses);
    }

    /**
     * @param CourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create($this->requestData());
        event(new CoursePriceListWasUpdated($course));

        return $this->response($course, Response::HTTP_CREATED);
    }

    /**
     * @param Course        $course
     * @param CourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Course $course, CourseRequest $request)
    {
        $course->update($this->requestData());
        event(new CoursePriceListWasUpdated($course));

        return $this->response($course, Response::HTTP_OK);
    }

    /**
     * @return array
     */
    private function requestData()
    {
        return [
            'sector_id' => request('sector_id'),
            'type' => request('type'),
            'framework_expires_on' => request('framework_expires_on') ? Carbon::createFromFormat('d/m/Y', request('framework_expires_on')) : null,
            'title' => request('title'),
            'code' => request('code'),
            'description' => request('description'),
            'level' => request('level'),
            'capability' => request('capability'),
            'awarding_body_id' => request('awarding_body_id'),
            'epa_provider' => request('epa_provider'),
            'aim_ref_standard' => request('aim_ref_standard'),
            'aim_ref_mandatory' => request('aim_ref_mandatory'),
            'aim_ref_optional' => request('aim_ref_optional'),
            'programme_length' => request('programme_length'),
            'programme_length_adult' => request('programme_length_adult'),
            'total_training' => request('total_training'),
            'total_epa' => request('total_epa'),
            'total_negotiated' => request('total_negotiated'),
            'funding_band' => request('funding_band'),
            'funding_cap' => request('funding_cap'),
            'co_investment' => request('co_investment'),
            'employer_contribution' => request('employer_contribution'),
            'additional_delivery' => request('additional_delivery'),
            'total_contribution' => request('total_contribution'),
            'provider_incentive' => request('provider_incentive'),
            'provider_uplift' => request('provider_uplift'),
            'notes' => request('notes'),
        ];
    }
}
