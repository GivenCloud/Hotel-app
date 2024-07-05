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
        return response()->json(Room::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Room::create($request->validated()), 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->validated());
        return response()->json($room, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return response()->json(null, 204);
    }

    public function search($number)
    {
        return response()->json(Room::where('number', 'like', "%$number%")->get(), 200);
    }

    public function getHotel($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room->hotel, 200);
    }

    public function getGuests($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room->guests, 200);
    }

    public function getType($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room->type, 200);
    }
}
