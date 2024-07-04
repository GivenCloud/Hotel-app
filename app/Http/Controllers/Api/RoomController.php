<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Room::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Room::create($request->validated()));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Room $room)
    {
        return response()->json($room->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json('true');
    }

    public function search($name)
    {
        return response()->json(Room::where('name', 'like', "%$name%")->get());
    }

    public function getHotel(Room $room)
    {
        return response()->json($room->hotel);
    }

    public function getGuests(Room $room)
    {
        return response()->json($room->guests);
    }

    public function getType(Room $room)
    {
        return response()->json($room->type);
    }
}
