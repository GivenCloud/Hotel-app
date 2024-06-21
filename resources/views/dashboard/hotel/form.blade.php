@csrf
<label for="">Name</label>
<input type="text" name="name" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Name" value="{{ old('name', $hotel->name)}}">

<label for="">Adress</label>
<input type="text" name="adress" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Adress" value="{{ old('adress', $hotel->adress)}}">

<label for="">Phone</label>
<input type="number" name="phone" pattern="[0-9]{8}" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Phone" value="{{ old('phone', $hotel->phone)}}">

<label for="">Email</label>
<input type="email" name="email" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Email" value="{{ old('email', $hotel->email)}}">

<label for="">Website</label>
<input type="text" name="website" class="block rounded-dm shadow-sm bg-purple-50 w-full" placeholder="Website" value="{{ old('website', $hotel->website)}}">

<input type="submit" value="Send">
<a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>