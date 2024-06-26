@extends('dashboard.layout')

@section('content')
<h1>Update type: {{ $type->name }}</h1>

    @include('dashboard.fragment.errors-form')

    <form action="{{ route('type.update', $type->id)}}" method="POST">
        @method('PUT')
        @include('dashboard.type.form')
    </form>
@endsection