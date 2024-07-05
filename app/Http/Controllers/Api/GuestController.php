<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRequest;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Guest::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Guest::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return response()->json($guest, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->update($request->validated());
        return response()->json($guest, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();
        return response()->json(null, 204);
    }

    public function search($name)
    {
        return response()->json(Guest::where('name', 'like', "%$name%")->get());
    }

    public function getRooms($id)
    {
        $guest = Guest::findOrFail($id);
        return response()->json($guest->rooms, 200);
    }

    public function getServices($id)
    {
        $guest = Guest::findOrFail($id);
        return response()->json($guest->services, 200);
    }
}
