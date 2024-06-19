@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <div class="error">
                    <li>{{ $error }}</li>
                </div>
            @endforeach
        </ul>
    </div>
@endif