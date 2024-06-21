@extends('dashboard.layout')

@section('content')
    <h1>{{ $guest->name }}</h1>
    <p>{{ $guest->lastName }}</p>
    <p>{{ $guest->dniPassport }}</p>
    <p>{{ $guest->email }}</p>
    <p>{{ $guest->phone }}</p>
    <p>{{ $guest->checkInDate }}</p>
    <p>{{ $guest->checkOutDate }}</p>

    <a href="{{ route('guest.index') }}"><button type="button">Back</button></a>
@endsection