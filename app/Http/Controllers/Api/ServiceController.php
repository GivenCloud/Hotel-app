<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Service::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Service::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }

    public function search($name)
    {
        return response()->json(Service::where('name', 'like', "%$name%")->get(), 200);
    }

    public function getCategory($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service->category, 200);
    }

    public function getHotels($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service->hotels, 200);
    }

    public function getGuests($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service->guests, 200);
    }
}