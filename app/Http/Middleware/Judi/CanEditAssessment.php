<?php

namespace App\Http\Middleware\Judi;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\UserManager\Users\UserRepository;
use App\Judi\Repositories\AssessmentRepository;

class CanEditAssessment
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var AssessmentRepository
     */
    protected $assessments;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @param AssessmentRepository $assessments
     * @param Guard                $auth
     * @param UserRepository       $users
     */
    function __construct(AssessmentRepository $assessments, Guard $auth, UserRepository $users)
    {
        $this->assessments = $assessments;
        $this->auth        = $auth;
        $this->users       = $users;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        if (isLineManager($user->id, $this->getRequestedUser($request->segment(3))) || $user->hasAccess('judiAdmin')) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
    }

    /**
     * @param $assessmentId
     * @return mixed
     * @throws \App\Core\EntityNotFoundException
     */
    private function getRequestedUser($assessmentId)
    {
        return $this->users->requireById($this->getAssessmentUser($assessmentId));
    }

    /**
     * @param $assessmentId
     * @return mixed
     * @throws \App\Core\EntityNotFoundException
     */
    private function getAssessmentUser($assessmentId)
    {
        $assessment = $this->assessments->requireById($assessmentId);

        return $assessment->user_id;
    }

}
