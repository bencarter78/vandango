<?php

namespace App\Http\Controllers\SurveyHound;

use App\SurveyHound\Survey;
use App\Contracts\DbRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyHound\StoreSurveyRequest;

class SurveysController extends Controller
{
    /**
     * @var string
     */
    protected $module = 'surveyhound';

    /**
     * @var
     */
    protected $surveys;

    /**
     * @var Survey
     */
    private $model;

    /**
     * SurveysController constructor.
     *
     * @param DbRepository $surveys
     * @param Survey       $model
     */
    public function __construct(DbRepository $surveys, Survey $model)
    {
        $this->surveys = $surveys;
        $this->model = $model;
        $this->surveys->setModel($this->model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("{$this->module}.index", ['surveys' => $this->surveys->getAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("{$this->module}.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSurveyRequest $request
     * @return Response
     */
    public function store(StoreSurveyRequest $request)
    {
        $this->model->create($request->except(['_token', 'submit']));

        return redirect()->route("{$this->module}.index")->with('success', 'You have successfully created a survey');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route("{$this->module}.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return view("{$this->module}.edit", ['survey' => $this->surveys->requireById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSurveyRequest $request
     * @param  int               $id
     * @return Response
     */
    public function update(StoreSurveyRequest $request, $id)
    {
        $survey = $this->surveys->requireById($id);
        $survey->update($request->except(['_token', '_method', 'submit']));

        return redirect()->route("{$this->module}.index")->with('success', 'You have successfully updated the survey');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $survey = $this->surveys->requireById($id);
        $survey->delete();

        return redirect()->route("{$this->module}.index")->with('success', 'You have successfully trashed the survey');
    }

    /**
     * Display the trashed items
     *
     * @return Response
     */
    public function trashed()
    {
        return view("general.trashed", [
            'collection' => $this->surveys->getAllTrashedPaginated(20, 'title'),
            'title' => 'Survey',
            'route' => 'surveyhound.restore',
        ]);
    }

    /**
     * Restore the trashed item
     *
     * @param  int $id
     * @return Response
     */
    public function restore($id)
    {
        $this->surveys->restoreById($id);

        return redirect()->route("{$this->module}.index")->with('success', 'You have successfully restored the survey');
    }
}
