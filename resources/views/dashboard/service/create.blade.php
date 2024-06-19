@extends('dashboard.layout')

@section('content')
    <h1>Create service</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('service.store')}}" method="POST">
        @include('dashboard.service.form')
    </form>
@endsection