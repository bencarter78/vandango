<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\UserRepository;
use App\Judi\Models\UserAssessmentSetting;

class UserAssessmentSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var UserAssessmentSetting
     */
    private $model;

    /**
     * UserAssessmentSettingsController constructor.
     *
     * @param UserRepository        $users
     * @param UserAssessmentSetting $model
     */
    public function __construct(UserRepository $users, UserAssessmentSetting $model)
    {
        $this->users = $users;
        $this->model = $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('judi.assessments.user', ['settings' => $this->model->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id The user ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->requireById($id);

        if ( ! $user->assessmentSettings) {
            $this->model->create(['user_id' => $id, 'settings' => json_encode([])]);
        }

        return view('judi.assessments.user', [
            'user' => $user->load('assessmentSettings'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];

        if ($request->has('process_id')) {
            foreach ($request->get('process_id') as $key => $value) {
                if ($value != '') {
                    $data[$value] = $request->get('type')[$key];
                }
            }
        }

        $this->model->findOrNew($id)->update(['settings' => json_encode($data)]);

        return back()->with('success', 'You have successfully update the settings.');
    }
}
