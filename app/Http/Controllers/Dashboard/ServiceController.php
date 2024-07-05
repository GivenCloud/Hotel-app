<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManyToMany\GuestService\StoreGuestRequest;
use App\Http\Requests\ManyToMany\HotelService\StoreHotelRequest;
use App\Http\Requests\Service\StoreRequest;
use App\Models\Category;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\ManyToMany\GuestService;
use App\Models\ManyToMany\HotelService;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(5);
        return view('dashboard.service.index', compact('services'));
    }

    public function search()
    {
        $search = request('search');
        $category = Category::where('name', $search)->first();

        if ($category) {
            $categoryId = $category->id;
        } else {
            $categoryId = null; 
        }

        $servicesSearch = Service::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere(function ($query) use ($categoryId) {
                $query->where('category_id', '=', $categoryId);
            });

        $servicesSearch = $servicesSearch->paginate(5);
        return view('dashboard.service.search', compact('servicesSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'name');
        $service = New Service();
        return view('dashboard.service.create', compact('service', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Service::create($request->validated());
        return redirect()->route('service.index')->with('session', 'Service stored successfully');    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('dashboard.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories = Category::pluck('id', 'name');
        return view('dashboard.service.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Service $service)
    {
        $service->update($request->validated());
        return redirect()->route('service.index')->with('session', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index')->with('session', 'Service deleted successfully');
    }

    public function addHotel(Service $service)
    {
        $addedHotels = $service->hotels->pluck('id')->toArray();
        $hotels = Hotel::whereNotIn('id', $addedHotels)->get();
        return view('dashboard.service.addHotel', compact('hotels', 'service'));
    }

    public function storeHotel(StoreHotelRequest $request)
    {
        $serviceId = $request->validated()['service_id'];
        $hotelIds = $request->validated()['hotel_id'] ?? [];

        $service = Service::findOrFail($serviceId);
        $service->hotels()->syncWithoutDetaching($hotelIds);
        
        return redirect()->route('service.index')->with('session', 'Hotel added to the service successfully');
    }

    public function destroyHotel($serviceId, $hotelId)
    {
        $serviceHotel = HotelService::where('service_id', $serviceId)->where('hotel_id', $hotelId)->first();
        if ($serviceHotel) {
            $serviceHotel->delete();
        }
        $service = Service::findOrFail($serviceId);
        return view('dashboard.service.show', compact('service'));
    }

    public function addGuest(Service $service)
    {
        $addedGuests = $service->guests->pluck('id')->toArray();
        $guests = Guest::whereNotIn('id', $addedGuests)->get();
        return view('dashboard.service.addGuest', compact('guests', 'service'));
    }

    public function storeGuest(StoreGuestRequest $request)
    {
        $serviceId = $request->validated()['service_id'];
        $guestIds = $request->validated()['guest_id'] ?? [];

        $service = Service::findOrFail($serviceId);
        $service->guests()->syncWithoutDetaching($guestIds);
        
        return redirect()->route('service.index')->with('session', 'Guest added to the service successfully');
    }

    public function destroyGuest($serviceId, $guestId)
    {
        $serviceGuest = GuestService::where('service_id', $serviceId)->where('guest_id', $guestId)->first();
        if ($serviceGuest) {
            $serviceGuest->delete();
        }
        $service = Service::findOrFail($serviceId);
        return view('dashboard.service.show', compact('service'));
    }
}
