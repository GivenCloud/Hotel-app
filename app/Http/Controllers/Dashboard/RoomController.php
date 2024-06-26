<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Type;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::paginate(5);
        $room = Room::find(1);
        return view('dashboard.room.index', compact('rooms', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::get();
        $hotels = Hotel::get();
        $room = new Room();
        return view('dashboard.room.create', compact('room', 'types', 'hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Room::create($request->validated());
        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('dashboard.room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $types = Type::get();
        $hotels = Hotel::get();
        return view('dashboard.room.edit', compact('room', 'types', 'hotels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Room $room)
    {
        $room->update($request->validated());
        return redirect()->route('room.index')->with('session', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('room.index')->with('session', 'Room deleted successfully');
    }
}
