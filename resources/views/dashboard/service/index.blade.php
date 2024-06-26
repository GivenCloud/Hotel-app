@extends('dashboard.layout')

@section('content')
    <a href="{{ route('service.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Description</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Category</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $service->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $service->description }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $service->category->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
                        <a href="{{ route('service.show', $service)}}">See</a>
                        <a href="{{ route('service.edit', $service) }}">Edit</a>
                        <form action="{{ route('service.destroy', $service) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }}
    
@endsection