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
        return response()->json(Type::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Type::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return response()->json($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Type $type)
    {
        return response()->json($type->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return response()->json('true');
    }
}
