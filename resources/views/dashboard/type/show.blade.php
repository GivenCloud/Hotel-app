@extends('dashboard.layout')

@section('content')
    <h1>{{ $type->name }}</h1>

    <a href="{{ route('type.index') }}"><button type="button">Back</button></a>
@endsection