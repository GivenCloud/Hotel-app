@extends('dashboard.layout')

@section('content')
    <h1>Create room</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('room.store')}}" method="POST">
        @include('dashboard.room.form')
    </form>
@endsection