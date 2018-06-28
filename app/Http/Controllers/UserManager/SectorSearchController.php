<?php

namespace App\Http\Controllers\UserManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserManager\Sectors\SectorRepository;

class SectorSearchController extends Controller
{
    /**
     * @var
     */
    private $sectors;

    /**
     * SectorSearchController constructor.
     *
     * @param $sectors
     */
    public function __construct(SectorRepository $sectors)
    {
        $this->sectors = $sectors;
    }

    /**
     * @param Request $request
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $sectors = $this->sectors->searchByName($request->get('q'), 20);

            if ($sectors->count() > 0) {
                return view('usermanager.sectors.index', [
                    'sectors' => $sectors,
                    'search' => $request->get('q'),
                ]);
            }

            return back()->with('error', 'Sorry, nothing matches your search. Please try again');
        }
    }
}
