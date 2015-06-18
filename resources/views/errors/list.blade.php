@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <b>Whoops! It looks like there was a problem:</b>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif