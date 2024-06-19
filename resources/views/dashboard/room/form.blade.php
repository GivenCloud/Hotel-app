@csrf
<label for="">Number</label>
<input type="number" name="number" placeholder="Number" value="{{ old('number', $room->number)}}">

<label for="">Adress</label>
<input type="text" name="type" placeholder="Type" value="{{ old('type', $room->type)}}">

<label for="">Price</label>
<input type="number" name="price" placeholder="Price" value="{{ old('price', $room->price)}}">

<input type="submit" value="Send">
<a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>