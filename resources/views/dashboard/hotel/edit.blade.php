@extends('dashboard.layout')

@section('content')
<h1>Update hotel: {{ $hotel->name }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('hotel.update', $hotel->id)}}" method="POST">
        @method('PUT')
        @include('dashboard.hotel.form')
    </form>
@endsection