@extends('dashboard.layout')

@section('content')
<h1>Update room: {{ $room->number }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('room.update', $room->id)}}" method="POST">
        @method('PUT')
        @include('dashboard.room.form')
    </form>
@endsection