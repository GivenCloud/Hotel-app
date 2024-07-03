@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment.errors-form')
    
    <h1 class="text-2xl font-bold mb-6">Add rooms to guest {{ $guest->name }}</h1>

    <div class="container mx-auto p-4 bg-white shadow-md rounded">
        <form id="add-rooms-form" action="{{ route('guest.storeRoom', ['guest' => $guest->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="guest_id" value="{{ $guest->id }}">
            <input type="hidden" name="room_id[]" value="">

            <div class="form-group mb-4 relative">
                <label for="room-search" class="block text-gray-700 font-medium mb-2">Search Rooms:</label>
                <input type="text" id="room-search" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Search for rooms">
                <div id="autocomplete-results" class="absolute w-full bg-white shadow-md rounded-md mt-1 z-10"></div>
            </div>

            <div class="form-group mb-4">
                <label for="selected-rooms" class="block text-gray-700 font-medium mb-2">Selected Rooms:</label>
                <div id="selected-rooms" class="border p-2 rounded-md bg-gray-100">
                    <!-- Las habitaciones seleccionadas se mostrarán aquí -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add rooms</button>
            <a href="{{ route('guest.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Back</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedRooms = [];

            let rooms = @json($rooms);

            let searchInput = document.getElementById('room-search');
            let selectedRoomsDiv = document.getElementById('selected-rooms');
            let form = document.getElementById('add-rooms-form');
            let autocompleteResultsDiv = document.getElementById('autocomplete-results');

            searchInput.addEventListener('input', function() {
                let searchValue = searchInput.value.toLowerCase();
                let filteredRooms = rooms.filter(room => room.number.toString().toLowerCase().includes(searchValue));
                showAutocompleteResults(filteredRooms);
            });

            function showAutocompleteResults(filteredRooms) {
                autocompleteResultsDiv.innerHTML = '';
                filteredRooms.forEach(room => {
                    let roomDiv = document.createElement('div');
                    roomDiv.textContent = `Room ${room.number}`;
                    roomDiv.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                    roomDiv.addEventListener('click', () => {
                        addRoom(room);
                        searchInput.value = '';
                        clearAutocompleteResults();
                    });
                    autocompleteResultsDiv.appendChild(roomDiv);
                });
            }

            function clearAutocompleteResults() {
                autocompleteResultsDiv.innerHTML = '';
            }

            function addRoom(room) {
                if (!selectedRooms.find(r => r.id === room.id)) {
                    selectedRooms.push(room);
                    updateSelectedRooms();
                }
            }

            function removeRoom(roomId) {
                selectedRooms = selectedRooms.filter(r => r.id !== roomId);
                updateSelectedRooms();
            }

            function updateSelectedRooms() {
                selectedRoomsDiv.innerHTML = '';
                selectedRooms.forEach(room => {
                    let roomDiv = document.createElement('div');
                    roomDiv.classList.add('selected-room', 'flex', 'items-center', 'justify-between', 'p-2', 'bg-white', 'shadow-sm', 'rounded-md', 'mb-2');
                    roomDiv.textContent = `Room ${room.number}`;
                    let removeButton = document.createElement('button');
                    removeButton.classList.add('btn', 'btn-danger', 'bg-red-500', 'hover:bg-red-700', 'text-white', 'font-bold', 'py-1', 'px-2', 'rounded');
                    removeButton.textContent = 'Remove';
                    removeButton.addEventListener('click', () => {
                        removeRoom(room.id);
                        deleteRoomFromServer(room.id);
                    });
                    roomDiv.appendChild(removeButton);
                    selectedRoomsDiv.appendChild(roomDiv);
                });

                let existingInputs = form.querySelectorAll('input[name="room_id[]"]');
                existingInputs.forEach(input => input.remove());
                selectedRooms.forEach(room => {
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'room_id[]';
                    hiddenInput.value = parseInt(room.id, 10);  // Convertir a entero
                    form.appendChild(hiddenInput);
                });
            }

            document.addEventListener('click', function(event) {
                if (!searchInput.contains(event.target) && !autocompleteResultsDiv.contains(event.target)) {
                    clearAutocompleteResults();
                }
            });
        });
    </script>

@endsection
