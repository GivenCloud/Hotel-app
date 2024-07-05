@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment.errors-form')
    
    <h1>Add services to {{ $hotel->nombre }}</h1>

    <div class="container">
        <form action="{{ route('hotel.storeService', ['hotel' => $hotel->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

            <div class="form-group">
                <label for="services">Services:</label>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="service_id[]" value="{{ $service->id }}" id="service{{ $service->id }}">
                        <label class="form-check-label" for="service{{ $service->id }}">
                            {{ $service->name }} 
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Add services</button>
            <a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>
        </form>
    </div>

@endsection