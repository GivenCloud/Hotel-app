@extends('dashboard.layout')

@section('content')
<h1>Update guest: {{ $guest->name }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('guest.update', $guest->id)}}" method="POST">
        @method('PUT')
        @include('dashboard.guest.form')
    </form>
@endsection