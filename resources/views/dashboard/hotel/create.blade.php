@extends('dashboard.layout')

@section('content')
    <h1>Create hotel</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('hotel.store')}}" method="POST">
        @include('dashboard.hotel.form')
    </form>
@endsection