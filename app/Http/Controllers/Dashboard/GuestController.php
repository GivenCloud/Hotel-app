<?php

namespace App\Http\Controllers\Dashboard;

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
        $guests = Guest::paginate(5);
        return view('dashboard.guest.index', compact('guests'));
    }

    public function search()
    {
        $search = request('search');
        $guestsSearch = Guest::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('lastName', 'LIKE', "%{$search}%")
            ->orWhere('dniPassport', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('checkInDate', 'LIKE', "%{$search}%")
            ->orWhere('checkOutDate', 'LIKE', "%{$search}%");

        $guestsSearch = $guestsSearch->paginate(5);
        return view('dashboard.guest.search', compact('guestsSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guest = new Guest();
        return view('dashboard.guest.create', compact('guest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Guest::create($request->validated());
        return redirect()->route('guest.index')->with('session', 'Guest created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('dashboard.guest.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('dashboard.guest.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Guest $guest)
    {
        $guest->update($request->validated());
        return redirect()->route('guest.index')->with('session', 'Guest updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guest.index')->with('session', 'Guest deleted successfully');
    }
}
