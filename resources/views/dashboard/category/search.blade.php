@extends('dashboard.layout')

@section('content')
    <a href="{{ route('category.create')}}">Create</a>

    <table class="table-auto w-full bg-white">
        <thead>
            <tr class="border">
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">ID</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Name</th>
                <th class="px-6 py-4 bg-gray-50 font-medium text-gray-500 uppercase leading-4 tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoriesSearch as $category)
                <tr class="border">
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $category->id }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">{{ $category->name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-center">
                        <a href="{{ route('category.show', $category)}}">See</a>
                        <a href="{{ route('category.edit', $category) }}">Edit</a>
                        <form action="{{ route('category.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categoriesSearch->links() }}
    
@endsection