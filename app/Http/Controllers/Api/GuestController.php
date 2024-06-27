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
        return response()->json(Guest::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Guest::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return response()->json($guest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Guest $guest)
    {
        return response()->json($guest->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json('true');
    }
}
