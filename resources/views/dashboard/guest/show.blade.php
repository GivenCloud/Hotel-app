@extends('dashboard.layout')

@section('content')
    <h1>{{ $guest->name }}</h1>
    <p>{{ $guest->lastName }}</p>
    <p>{{ $guest->dniPassport }}</p>
    <p>{{ $guest->email }}</p>
    <p>{{ $guest->phone }}</p>
    <p>{{ $guest->checkInDate }}</p>
    <p>{{ $guest->checkOutDate }}</p>
    <p>Services:</p>
    <ul class="list-disc ml-4">
        @foreach ($guest->services as $service)
        <li class="inline-block ml-2">
            {{$service->name}}
            <form action="{{ route('guest.destroyService', ['guest' => $guest->id, 'service' => $service->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>

    <a href="{{ route('guest.index') }}"><button type="button">Back</button></a>
@endsection