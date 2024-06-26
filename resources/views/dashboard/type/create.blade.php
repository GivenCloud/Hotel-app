@extends('dashboard.layout')

@section('content')
    <h1>Create type</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('type.store')}}" method="POST">
        @include('dashboard.type.form')
    </form>
@endsection