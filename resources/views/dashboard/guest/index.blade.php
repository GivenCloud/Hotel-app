@extends('dashboard.layout')

@section('content')
    <a href="{{ route('guest.create')}}">Create</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>DNI/Passport</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Check in date</th>
                <th>Check out date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->lastName }}</td>
                    <td>{{ $guest->dniPassport }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->checkInDate }}</td>
                    <td>{{ $guest->checkOutDate }}</td>
                    <td>
                        <a href="{{ route('guest.show', $guest)}}">See</a>
                        <a href="{{ route('guest.edit', $guest) }}">Edit</a>
                        <form action="{{ route('guest.destroy', $guest) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $guests->links() }}
    
@endsection