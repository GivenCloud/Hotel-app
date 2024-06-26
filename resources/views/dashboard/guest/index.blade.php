@extends('dashboard.layout')

@section('content')
    <a href="{{ route('guest.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Last Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">DNI/Passport</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Email</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Phone</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Check in date</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Check out date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->lastName }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->dniPassport }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->email }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->phone }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->checkInDate }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $guest->checkOutDate }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
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