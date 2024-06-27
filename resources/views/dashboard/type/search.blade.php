@extends('dashboard.layout')

@section('content')
    <a href="{{ route('type.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">ID</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Price</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($typesSearch as $type)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $type->id }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $type->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $type->price }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
                        <a href="{{ route('type.show', $type)}}">See</a>
                        <a href="{{ route('type.edit', $type) }}">Edit</a>
                        <form action="{{ route('type.destroy', $type) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $typesSearch->links() }}
    
@endsection