@if ($errors->any())
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ms-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif