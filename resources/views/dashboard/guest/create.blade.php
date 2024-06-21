@extends('dashboard.layout')

@section('content')
    <h1>Create guest</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('guest.store')}}" method="POST">
        @include('dashboard.guest.form')
    </form>
@endsection