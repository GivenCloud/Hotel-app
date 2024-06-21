@extends('dashboard.layout')

@section('content')
    <h1>Edit service</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('service.store')}}" method="POST">
        @method('PUT')
        @include('dashboard.service.form')
    </form>
@endsection