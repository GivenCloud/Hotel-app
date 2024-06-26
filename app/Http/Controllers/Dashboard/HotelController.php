<?php

namespace App\Http\Controllers\Dashboard;

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
        $hotels = Hotel::paginate(5);
        $prueba = Hotel::find(1);

        return view('dashboard.hotel.index', compact('hotels', 'prueba'));
    }

    public function search()
    {
        $search = request('search');
        $hotelsSearch = Hotel::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('adress', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('website', 'LIKE', "%{$search}%");

        $hotelsSearch = $hotelsSearch->paginate(5);
        return view('dashboard.hotel.search', compact('hotelsSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotel = new Hotel();
        return view('dashboard.hotel.create', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Hotel::create($request->validated());
        return redirect()->route('hotel.index')->with('session', 'Hotel created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('dashboard.hotel.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('dashboard.hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return redirect()->route('hotel.index')->with('session', 'Hotel updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index')->with('session', 'Hotel deleted successfully');
    }
}
