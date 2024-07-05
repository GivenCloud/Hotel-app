@extends('dashboard.layout')

@section('content')
    <h1>{{ $type->name }}</h1>
    <p>{{ $type->price }}</p>
    <p>{{ $type->capacity }}</p>

    <a href="{{ route('type.index') }}"><button type="button">Back</button></a>
@endsection