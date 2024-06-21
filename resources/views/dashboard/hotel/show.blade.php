@extends('dashboard.layout')

@section('content')
    <h1>{{ $hotel->name }}</h1>
    <p>{{ $hotel->address }}</p>
    <p>{{ $hotel->phone }}</p>
    <p>{{ $hotel->email }}</p>
    <p>{{ $hotel->website }}</p>

    <a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>
@endsection