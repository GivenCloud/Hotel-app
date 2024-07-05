<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\StoreRequest;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Type::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Type::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = Type::findOrFail($id);
        return response()->json($type, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $type = Type::findOrFail($id);
        $type->update($request->validated());
        return response()->json($type, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return response()->json(null, 204);
    }

    public function search($name)
    {
        return response()->json(Type::where('name', 'like', "%$name%")->get(), 200);
    }

    public function getRooms($id)
    {
        $type = Type::findOrFail($id);
        return response()->json($type->rooms, 200);
    }
}
