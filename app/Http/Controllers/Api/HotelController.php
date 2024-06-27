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
        return response()->json(Hotel::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Hotel::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Hotel $hotel)
    {
        return response()->json($hotel->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json('true');
    }
}
