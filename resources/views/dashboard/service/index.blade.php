@extends('dashboard.layout')

@section('content')
    <a href="{{ route('service.create')}}">Create</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->category }}</td>
                    <td>
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
    
@endsection