@extends('dashboard.layout')

@section('content')
    <h1>{{ $service->name }}</h1>
    <p>{{ $service->description }}</p>
    <p>{{ $service->category }}</p>

    <a href="{{ route('service.index') }}"><button type="button">Back</button></a>
@endsection