<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Judi\Repositories\SummaryRepository;

class SummaryDocumentation extends Controller
{
    /**
     * @var SummaryRepository
     */
    protected $summaries;

    /**
     * SummaryOutcomeController constructor.
     *
     * @param $summaries
     */
    public function __construct(SummaryRepository $summaries)
    {
        $this->summaries = $summaries;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \App\Core\EntityNotFoundException
     */
    public function index($id)
    {
        $summary = $this->summaries->requireById($id, true);

        $tmpFilepath = 'tmp/' . collect(explode('/', $summary->document_path))->last();

        Storage::put(
            $tmpFilepath,
            Storage::disk(config('vandango.judi.disk'))->get($summary->document_path)
        );

        return response()->download(storage_path('app/' . $tmpFilepath))->deleteFileAfterSend(true);
    }
}
