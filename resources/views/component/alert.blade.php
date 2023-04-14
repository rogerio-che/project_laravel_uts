@if (Session::has('success'))
    <div class="alert alert-success mt-5" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-5" role="alert">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
@endif