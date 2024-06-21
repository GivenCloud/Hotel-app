@csrf
<label for="">Name</label>
<input type="text" name="name" placeholder="Name" value="{{ old('name', $service->name)}}">

<label for="">Description</label>
<textarea name="description" placeholder="Description" value="{{ old('description', $service->description)}}"></textarea>

{{---}}
<label for="">Category</label>
<select name="category">
    @foreach($services->category as $category)
        <option value="{{ $category }}" {{ $category == old('category', $category) ? 'selected' : '' }}>{{ $category }}</option>
    @endforeach
</select>
{{---}}

<input type="submit" value="Send">
<a href="{{ route('service.index') }}"><button type="button">Back</button></a>