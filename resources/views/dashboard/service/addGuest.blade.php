@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment.errors-form')
    
    <h1 class="text-2xl font-bold mb-6">Add guests to service {{ $service->number }}</h1>

    <div class="container mx-auto p-4 bg-white shadow-md rounded">
        <form id="add-guests-form" action="{{ route('service.storeGuest', ['service' => $service->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="guest_id[]" value="">

            <div class="form-group mb-4 relative">
                <label for="guest-search" class="block text-gray-700 font-medium mb-2">Search Guests:</label>
                <input type="text" id="guest-search" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Search for guests">
                <div id="autocomplete-results" class="absolute w-full bg-white shadow-md rounded-md mt-1 z-10"></div>
            </div>

            <div class="form-group mb-4">
                <label for="selected-guests" class="block text-gray-700 font-medium mb-2">Selected Guests:</label>
                <div id="selected-guests" class="border p-2 rounded-md bg-gray-100">
                    <!-- Los huéspedes seleccionados aparecerán aquí -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add guests</button>
            <a href="{{ route('service.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Back</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedGuests = [];

            // Búsqueda de huéspedes con autocompletado
            let guests = @json($guests);

            // Búsqueda del elemento
            let searchInput = document.getElementById('guest-search');
            let selectedGuestsDiv = document.getElementById('selected-guests');
            let form = document.getElementById('add-guests-form');
            let autocompleteResultsDiv = document.getElementById('autocomplete-results');

            searchInput.addEventListener('input', function() {
                let searchValue = searchInput.value.toLowerCase();
                let filteredGuests = guests.filter(guest => guest.name.toLowerCase().includes(searchValue));
                showAutocompleteResults(filteredGuests);
            });

            function showAutocompleteResults(filteredGuests) {
                autocompleteResultsDiv.innerHTML = '';
                filteredGuests.forEach(guest => {
                    let guestDiv = document.createElement('div');
                    guestDiv.textContent = guest.name;
                    guestDiv.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                    guestDiv.addEventListener('click', () => {
                        addGuest(guest);
                        searchInput.value = '';
                        clearAutocompleteResults();
                    });
                    autocompleteResultsDiv.appendChild(guestDiv);
                });
            }

            function clearAutocompleteResults() {
                autocompleteResultsDiv.innerHTML = '';
            }

            function addGuest(guest) {
                if (!selectedGuests.find(g => g.id === guest.id)) {
                    selectedGuests.push(guest);
                    updateSelectedGuests();
                }
            }

            function removeGuest(guestId) {
                selectedGuests = selectedGuests.filter(g => g.id !== guestId);
                updateSelectedGuests();
            }

            function updateSelectedGuests() {
                selectedGuestsDiv.innerHTML = '';
                selectedGuests.forEach(guest => {
                    let guestDiv = document.createElement('div');
                    guestDiv.classList.add('selected-guest', 'flex', 'items-center', 'justify-between', 'p-2', 'bg-white', 'shadow-sm', 'rounded-md', 'mb-2');
                    guestDiv.textContent = guest.name;
                    let removeButton = document.createElement('button');
                    removeButton.classList.add('btn', 'btn-danger', 'bg-red-500', 'hover:bg-red-700', 'text-white', 'font-bold', 'py-1', 'px-2', 'rounded');
                    removeButton.textContent = 'Remove';
                    removeButton.addEventListener('click', () => removeGuest(guest.id));
                    guestDiv.appendChild(removeButton);
                    selectedGuestsDiv.appendChild(guestDiv);
                });

                // Actualizar los inputs ocultos con los IDs de los huéspedes seleccionados
                let existingInputs = form.querySelectorAll('input[name="guest_id[]"]');
                existingInputs.forEach(input => input.remove());
                selectedGuests.forEach(guest => {
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'guest_id[]';
                    hiddenInput.value = guest.id;
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
