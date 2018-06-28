<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\User;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Vacancies;
use App\Events\Blink\VacancyWasDeleted;
use Symfony\Component\HttpFoundation\Response;

class VacancyController extends Controller
{
    /**
     * @var Vacancies
     */
    protected $vacancies;

    /**
     * VacancyController constructor.
     *
     * @param $vacancies
     */
    public function __construct(Vacancies $vacancies)
    {
        $this->vacancies = $vacancies;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            $this->vacancies->getAll('id', 'asc', [
                'applicationManager', 'contact', 'contact.organisation', 'hires', 'level', 'location', 'sector', 'statuses', 'submittedBy',
            ])
        );
    }

    /**
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $vacancy = $this->vacancies->requireById($id);

        if ($this->authorizeForUser(User::findOrFail(request()->user_id), 'delete', $vacancy)) {
            event(new VacancyWasDeleted($vacancy));

            return $this->response([$vacancy->delete()]);
        }

        return $this->response([
            'errors' => [
                'status' => Response::HTTP_FORBIDDEN,
                'title' => 'Permission Denied',
                'detail' => 'You do not have permission to delete this vacancy.',
            ],
        ], Response::HTTP_FORBIDDEN);
    }
}
