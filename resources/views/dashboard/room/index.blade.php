@extends('dashboard.layout')

@section('content')
    <a href="{{ route('room.create')}}">Create</a>

    <table>
        <thead>
            <tr>
                <th>Number</th>
                <th>Type</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->number }}</td>
                    <td>{{ $room->type }}</td>
                    <td>{{ $room->price }}</td>
                    <td>
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
    
@endsection