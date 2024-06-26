@csrf
<label for="">Name</label>
<input type="text" name="name" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Name" value="{{ old('name', $type->name)}}">

<label for="">Price</label>
<input type="number" name="price" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Price" value="{{ old('price', $type->price)}}">

<input type="submit" value="Send">
<a href="{{ route('type.index') }}"><button type="button">Back</button></a>