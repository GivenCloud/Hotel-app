@extends('dashboard.layout')

@section('content')
    <h1>{{ $service->name }}</h1>
    <p>{{ $service->description }}</p>
    <p>{{ $service->category->name }}</p>
    <p>Hotels:</p>
    <ul class="list-disc ml-4 ">
        @foreach ($service->hotels as $hotel)
            <li class="inline-block ml-2">
                {{$hotel->name}} 
                <form action="{{ route('service.destroyHotel', ['service' => $service->id, 'hotel' => $hotel->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Guests:</p>
    <ul class="list-disc ml-4 ">
        @foreach ($service->guests as $guest)
            <li class="inline-block ml-2">
                {{$guest->name}} 
                <form action="{{ route('service.destroyGuest', ['service' => $service->id, 'guest' => $guest->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('service.index') }}"><button type="button">Back</button></a>
@endsection