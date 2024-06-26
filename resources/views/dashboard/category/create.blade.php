@extends('dashboard.layout')

@section('content')
    <h1>Create category</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('category.store')}}" method="POST">
        @include('dashboard.category.form')
    </form>
@endsection