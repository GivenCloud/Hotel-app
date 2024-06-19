@csrf
<label for="">Name</label>
<input type="text" name="name" placeholder="Name" value="{{ old('name', $hotel->name)}}">

<label for="">Adress</label>
<input type="text" name="adress" placeholder="Adress" value="{{ old('adress', $hotel->adress)}}">

<label for="">Phone</label>
<input type="number" name="phone" pattern="[0-9]{8}" placeholder="Phone" value="{{ old('phone', $hotel->phone)}}">

<label for="">Email</label>
<input type="email" name="email" placeholder="Email" value="{{ old('email', $hotel->email)}}">

<label for="">Website</label>
<input type="text" name="website" placeholder="Website" value="{{ old('website', $hotel->website)}}">

<input type="submit" value="Send">
<a href="{{ route('hotel.index') }}"><button type="button">Back</button></a>