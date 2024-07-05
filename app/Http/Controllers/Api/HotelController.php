<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreRequest;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Hotel::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Hotel::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->validated());
        return response()->json($hotel, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(null, 204);
    }

    public function search($name)
    {
        return response()->json(Hotel::where('name', 'like', "%$name%")->get(), 200);
    }

    public function getRooms($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel->rooms, 200);
    }

    public function getServices($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel->services, 200);
    }
}
