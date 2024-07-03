<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\ManyToMany\GuestService\StoreServiceRequest;
use App\Http\Requests\ManyToMany\RoomGuest\StoreRoomRequest;
use App\Models\Guest;
use App\Models\ManyToMany\GuestService;
use App\Models\ManyToMany\RoomGuest;
use App\Models\Room;
use App\Models\Service;

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

    public function addService(Guest $guest)
    {
        $services = Service::all();
        return view('dashboard.guest.addService', compact('guest', 'services'));
    }

    public function storeService(StoreServiceRequest $request)
    {
        $guestId = $request->validated()['guest_id'];
        $serviceIds = $request->validated()['service_id'];

        $guest = Guest::findOrFail($guestId);
        $guest->services()->syncWithoutDetaching($serviceIds);
        
        return redirect()->route('guest.index')->with('session', 'Service added successfully');
    }

    public function destroyService($guestId, $serviceId)
    {
        $guestService = GuestService::where('guest_id', $guestId)->where('service_id', $serviceId)->first();
        if ($guestService) {
            $guestService->delete();
        }
        $guest = Guest::findOrFail($guestId);
        return view('dashboard.guest.show', compact('guest'));
    }

    public function addRoom(Guest $guest)
    {
        $rooms = Room::all();
        return view('dashboard.guest.addRoom', compact('guest', 'rooms'));
    }

    public function storeRoom(StoreRoomRequest $request)
    {
        $guestId = $request->validated()['guest_id'];
        $roomIds = $request->validated()['room_id'] ?? [];

        $guest = Guest::findOrFail($guestId);
        $guest->rooms()->syncWithoutDetaching($roomIds);

        return redirect()->route('guest.index')->with('session', 'Room added to the guest successfully');
    }

    public function destroyRoom($guestId, $roomId)
    {
        $roomGuest = RoomGuest::where('room_id', $roomId)->where('guest_id', $guestId)->first();
        if ($roomGuest) {
            $roomGuest->delete();
        }
        $guest = Guest::findOrFail($guestId);
        return view('dashboard.guest.show', compact('guest'));
    }
}
