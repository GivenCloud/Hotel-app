@extends('dashboard.layout')

@section('content')
    <h1>{{ $room->number }}</h1>
    <p>{{ $room->type->name }}</p>
    <p>{{ $room->type->price }}</p>
    <p>Guests:</p>
    <ul class="list-disc ml-4 ">
        @foreach ($room->guests as $guest)
            <li class="inline-block ml-2">
                {{$guest->name}} 
                <form action="{{ route('room.destroyGuest', ['room' => $room->id, 'guest' => $guest->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('room.index') }}"><button type="button">Back</button></a>
@endsection