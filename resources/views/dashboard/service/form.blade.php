@csrf
<label for="">Name</label>
<input type="text" name="name" placeholder="Name" value="{{ old('name', $service->name)}}">

<label for="">Description</label>
<textarea name="description" placeholder="Description" value="{{ old('description', $service->description)}}"></textarea>

<label for="">Category</label>
<select name="category_id">
    <option value="">Select a category</option>
    @foreach ($categories as $name => $id)
        <option @if (old("category_id", $service->category_id) == $id)
            selected
        @endif value="{{ $id }}">{{ $name }}</option>
    @endforeach
</select>

<input type="submit" value="Send">
<a href="{{ route('service.index') }}"><button type="button">Back</button></a>