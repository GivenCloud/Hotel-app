@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment.errors-form')
    
    <h1>Add guests to room {{ $room->number }}</h1>

    <div class="container">
        <form action="{{ route('room.storeGuest', ['room' => $room->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <div class="form-group">
                <label for="guests">Guests:</label>
                @foreach ($guests as $guest)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guest_id[]" value="{{ $guest->id }}" id="guest{{ $guest->id }}"
                        @if($room->guests->contains($guest->id)) checked @endif>
                        <label class="form-check-label" for="guest{{ $guest->id }}">
                            {{ $guest->name }} 
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Add guests</button>
            <a href="{{ route('room.index') }}"><button type="button">Back</button></a>
        </form>
    </div>

@endsection