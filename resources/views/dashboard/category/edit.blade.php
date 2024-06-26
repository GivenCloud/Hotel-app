@extends('dashboard.layout')

@section('content')
<h1>Update category: {{ $category->name }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('category.update', $category->id)}}" method="POST">
        @method('PUT')
        @include('dashboard.category.form')
    </form>
@endsection