@extends('dashboard.layout')

@section('content')
    <h1>{{ $category->name }}</h1>

    <a href="{{ route('category.index') }}"><button type="button">Back</button></a>
@endsection