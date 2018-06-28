<?php

namespace App\Http\Controllers\RoomMate;

use Illuminate\Http\Request;
use App\RoomMate\Models\Site;
use App\RoomMate\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomMate\RoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roommate.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roommate.rooms.create', ['sites' => Site::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        Room::updateOrCreate(['name' => $request->get('name'), 'site_id' => $request->get('site_id')], $request->all());

        return redirect()->route('roommate.rooms.index')->with('success', 'You have successfully updated the room.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomMate\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomMate\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('roommate.rooms.edit', ['room' => $room, 'sites' => Site::orderBy('name')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomRequest                $request
     * @param  \App\RoomMate\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->all());

        return redirect()->route('roommate.rooms.index')->with('success', 'You have successfully updated the room.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomMate\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return back()->with('success', 'You have succussfully deleted the room.');
    }
}
