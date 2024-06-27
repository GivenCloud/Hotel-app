@extends('dashboard.layout')

@section('content')
    <a href="{{ route('room.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Number</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Type</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Hotel</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Price</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roomsSearch as $room)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $room->number }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $room->type->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $room->hotel->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $room->type->price }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
                        <a href="{{ route('room.show', $room)}}">See</a>
                        <a href="{{ route('room.edit', $room) }}">Edit</a>
                        <form action="{{ route('room.destroy', $room) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $roomsSearch->links() }}
    
@endsection