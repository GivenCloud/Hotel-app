@csrf
<label for="">Name</label>
<input type="text" name="name" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Name" value="{{ old('name', $hotel->name)}}">

<label for="">Address</label>
<input type="text" name="address" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Address" value="{{ old('address', $hotel->address)}}">

<label for="">Phone</label>
<input type="number" name="phone" pattern="[0-9]{8}" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Phone" value="{{ old('phone', $hotel->phone)}}">

<label for="">Email</label>
<input type="email" name="email" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Email" value="{{ old('email', $hotel->email)}}">

<label for="">Website</label>
<input type="text" name="website" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Website" value="{{ old('website', $hotel->website)}}">

<input type="submit" value="Send">
<a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>