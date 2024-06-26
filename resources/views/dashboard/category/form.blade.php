@csrf
<label for="">Name</label>
<input type="text" name="name" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Name" value="{{ old('name', $category->name)}}">

<input type="submit" value="Send">
<a href="{{ route('category.index') }}"><button type="button">Back</button></a>