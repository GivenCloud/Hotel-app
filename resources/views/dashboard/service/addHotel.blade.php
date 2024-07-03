@php
    use Illuminate\Support\Facades\Route;
@endphp

@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment.errors-form')
    
    <h1 class="text-2xl font-bold mb-6">Add hotels to service {{ $service->number }}</h1>

    <div class="container mx-auto p-4 bg-white shadow-md rounded">
        <form id="add-hotels-form" action="{{ route('service.storeHotel', ['service' => $service->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="hotel_id[]" value="">

            <div class="form-group mb-4 relative">
                <label for="hotel-search" class="block text-gray-700 font-medium mb-2">Search Hotels:</label>
                <input type="text" id="hotel-search" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Search for hotels">
                <div id="autocomplete-results" class="absolute w-full bg-white shadow-md rounded-md mt-1 z-10"></div>
            </div>

            <div class="form-group mb-4">
                <label for="selected-hotels" class="block text-gray-700 font-medium mb-2">Selected Hotels:</label>
                <div id="selected-hotels" class="border p-2 rounded-md bg-gray-100">
                    <!-- Los huéspedes seleccionados aparecerán aquí -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add hotels</button>
            <a href="{{ route('service.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Back</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedHotels = [];

            // Búsqueda de huéspedes con autocompletado
            let hotels = @json($hotels);

            // Búsqueda del elemento
            let searchInput = document.getElementById('hotel-search');
            let selectedHotelsDiv = document.getElementById('selected-hotels');
            let form = document.getElementById('add-hotels-form');
            let autocompleteResultsDiv = document.getElementById('autocomplete-results');

            searchInput.addEventListener('input', function() {
                let searchValue = searchInput.value.toLowerCase();
                let filteredHotels = hotels.filter(hotel => hotel.name.toLowerCase().includes(searchValue));
                showAutocompleteResults(filteredHotels);
            });

            function showAutocompleteResults(filteredHotels) {
                autocompleteResultsDiv.innerHTML = '';
                filteredHotels.forEach(hotel => {
                    let hotelDiv = document.createElement('div');
                    hotelDiv.textContent = hotel.name;
                    hotelDiv.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                    hotelDiv.addEventListener('click', () => {
                        addHotel(hotel);
                        searchInput.value = '';
                        clearAutocompleteResults();
                    });
                    autocompleteResultsDiv.appendChild(hotelDiv);
                });
            }

            function clearAutocompleteResults() {
                autocompleteResultsDiv.innerHTML = '';
            }

            function addHotel(hotel) {
                if (!selectedHotels.find(g => g.id === hotel.id)) {
                    selectedHotels.push(hotel);
                    updateSelectedHotels();
                }
            }

            function removeHotel(hotelId) {
                selectedHotels = selectedHotels.filter(g => g.id !== hotelId);
                updateSelectedHotels();
            }

            function updateSelectedHotels() {
                selectedHotelsDiv.innerHTML = '';
                selectedHotels.forEach(hotel => {
                    let hotelDiv = document.createElement('div');
                    hotelDiv.classList.add('selected-hotel', 'flex', 'items-center', 'justify-between', 'p-2', 'bg-white', 'shadow-sm', 'rounded-md', 'mb-2');
                    hotelDiv.textContent = hotel.name;
                    let removeButton = document.createElement('button');
                    removeButton.classList.add('btn', 'btn-danger', 'bg-red-500', 'hover:bg-red-700', 'text-white', 'font-bold', 'py-1', 'px-2', 'rounded');
                    removeButton.textContent = 'Remove';
                    removeButton.addEventListener('click', () => removeHotel(hotel.id));
                    hotelDiv.appendChild(removeButton);
                    selectedHotelsDiv.appendChild(hotelDiv);
                });

                // Actualizar los inputs ocultos con los IDs de los huéspedes seleccionados
                let existingInputs = form.querySelectorAll('input[name="hotel_id[]"]');
                existingInputs.forEach(input => input.remove());
                selectedHotels.forEach(hotel => {
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'hotel_id[]';
                    hiddenInput.value = hotel.id;
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
