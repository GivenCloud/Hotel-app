@csrf
<label for="">Name</label>
<input type="text" name="name" placeholder="Name" value="{{ old('name', $guest->name)}}">

<label for="">Last Name</label>
<input type="text" name="lastName" placeholder="Last Name" value="{{ old('lastName', $guest->lastName)}}">

<label for="">DNI/Passport</label>
<input type="text" name="dniPassport" placeholder="DNI/Passport" value="{{ old('dniPassport', $guest->dniPassport)}}">

<label for="">Email</label>
<input type="email" name="email" placeholder="Email" value="{{ old('email', $guest->email)}}">

<label for="">Phone</label>
<input type="number" name="phone" pattern="[0-9]{8}" placeholder="Phone" value="{{ old('phone', $guest->phone)}}">

<label for="">Check in date</label>
<input type="date" name="checkInDate" placeholder="Check in date" value="{{ old('checkInDate', $guest->checkInDate)}}">

<label for="">Check out date</label>
<input type="date" name="checkOutDate" placeholder="Check out date" value="{{ old('checkOutDate', $guest->checkOutDate)}}">

<input type="submit" value="Send">

<a href="{{ route('guest.index') }}"><button type="button">Back</button></a>