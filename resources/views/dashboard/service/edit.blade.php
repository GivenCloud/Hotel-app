@extends('dashboard.layout')

@section('content')
    <h1>update service: {{ $service->name }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('service.update', $service->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('dashboard.service.form')
    </form>
@endsection