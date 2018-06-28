<?php

namespace App\Http\Controllers\Eportfolio\Onefile;

use App\Apply\Models\Sector;
use App\Eportfolios\Models\Centre;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('eportfolio.onefile.sectors.index', [
            'sectors' => Sector::with('eportfolioCentres')->orderBy('code')->orderBy('name')->get(),
        ]);
    }

    /**
     * @param Sector $sector
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Sector $sector)
    {
        if ( ! Auth::user()->hasAccess('eportfolioAdmin')) {
            return back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        return view('eportfolio.onefile.sectors.edit', [
            'sector' => $sector->load('eportfolioCentres'),
            'centres' => Centre::orderBy('name')->get(),
        ]);
    }

    /**
     * @param Sector $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Sector $sector)
    {
        if ( ! Auth::user()->hasAccess('eportfolioAdmin')) {
            return back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        $sector->syncCentres(request('centre_id'));

        return redirect(route('eportfolios.onefile.sectors.index'))->with('success', 'You have successfully updated the sector');
    }
}
