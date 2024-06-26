@csrf
<label for="">Number</label>
<input type="number" name="number" placeholder="Number" value="{{ old('number', $room->number) }}">

<label for="">Type</label>
<select name="type_id" id="typeSelect">
    <option value="">Select a type</option>
    @foreach ($types as $type)
        <option data-price="{{ $type->price }}" 
            @if (old("type_id", $room->type_id) == $type->id) 
                selected 
            @endif 
            value="{{ $type->id }}">{{ $type->name }}</option>
    @endforeach
</select>

<label for="">Hotel</label>
<select name="hotel_id">
    <option value="">Select a hotel</option>
    @foreach ($hotels as $hotel)
        <option 
            @if (old("hotel_id", $room->hotel_id) == $hotel->id) 
                selected 
            @endif 
            value="{{ $hotel->id }}">{{ $hotel->name }}</option>
    @endforeach
</select>

<label for="">Price: </label>
<span id="priceDisplay">Select a type to see the price</span>

<input type="submit" value="Send">
<a href="{{ route('room.index') }}"><button type="button">Back</button></a>

<script>
document.getElementById('typeSelect').addEventListener('change', function() {
    updatePriceDisplay();
});

function updatePriceDisplay() {
    var typeSelect = document.getElementById('typeSelect');
    var selectedOption = typeSelect.options[typeSelect.selectedIndex];
    var price = selectedOption.getAttribute('data-price');
    document.getElementById('priceDisplay').textContent = price ? ` ${price}` : 'Select a type to see the price';
}

// Llamar a la función updatePriceDisplay cuando la página se carga
document.addEventListener('DOMContentLoaded', function() {
    updatePriceDisplay();
});
</script>