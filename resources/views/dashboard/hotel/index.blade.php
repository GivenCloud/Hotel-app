@extends('dashboard.layout')

@section('content')
    <a href="{{ route('hotel.create')}}">Create</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Adress</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->adress }}</td>
                    <td>{{ $hotel->phone }}</td>
                    <td>{{ $hotel->email }}</td>
                    <td>{{ $hotel->website }}</td>
                    <td>
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
    
@endsection