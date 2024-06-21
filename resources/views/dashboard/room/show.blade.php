@extends('dashboard.layout')

@section('content')
    <h1>{{ $room->number }}</h1>
    <p>{{ $room->type }}</p>
    <p>{{ $room->price }}</p>

    <a href="{{ route('room.index') }}"><button type="button">Back</button></a>
@endsection