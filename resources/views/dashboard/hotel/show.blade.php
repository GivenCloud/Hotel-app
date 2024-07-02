@extends('dashboard.layout')

@section('content')
    <h1>{{ $hotel->name }}</h1>
    <p>Adress: {{ $hotel->address }}</p>
    <p>Phone number: {{ $hotel->phone }}</p>
    <p>Email: {{ $hotel->email }}</p>
    <p>Website: {{ $hotel->website }}</p>
    <p>Services:</p>
    <ul class="list-disc ml-4">
        @foreach ($hotel->services as $service)
            <li class="inline-block ml-2">
                {{$service->name}}
                <form action="{{ route('hotel.destroyService', ['hotel' => $hotel->id, 'service' => $service->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>
@endsection