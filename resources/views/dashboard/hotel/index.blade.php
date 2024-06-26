@extends('dashboard.layout')

@section('content')
    @if ($prueba != null)
        <p>Este es el servicio del que dispone el hotel: </p>
        <ul>
            @if ($prueba->services)
                @foreach ($prueba->services as $service)
                    <li>{{ $service->name }}</li>
                @endforeach
            @endif
        </ul>  
    @endif
    
    <a href="{{ route('hotel.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Adress</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Phone</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Email</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Website</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $hotel->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $hotel->adress }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $hotel->phone }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $hotel->email }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $hotel->website }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
                        <a href="{{ route('hotel.show', $hotel)}}">See</a>
                        <a href="{{ route('hotel.edit', $hotel) }}">Edit</a>
                        <form action="{{ route('hotel.destroy', $hotel) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $hotels->links() }}
    
@endsection