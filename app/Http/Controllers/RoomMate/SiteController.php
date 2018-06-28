<?php

namespace App\Http\Controllers\RoomMate;

use App\RoomMate\Models\Site;
use App\Jobs\RoomMate\SaveSite;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomMate\SiteRequest;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roommate.sites.index', ['sites' => Site::with('location')->orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roommate.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SiteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteRequest $request)
    {
        dispatch(new SaveSite(new Site(), $request->all()));

        return redirect()->route('roommate.sites.index')->with('success', 'You have successfully added the site.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomMate\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomMate\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        return view('roommate.sites.edit', ['site' => $site]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SiteRequest                $request
     * @param  \App\RoomMate\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function update(SiteRequest $request, Site $site)
    {
        dispatch(new SaveSite($site, $request->all()));

        return redirect()->route('roommate.sites.index')->with('success', 'You have successfully updated the site.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomMate\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return redirect()->back()->with('success', 'You have successfully deleted the site.');
    }
}
