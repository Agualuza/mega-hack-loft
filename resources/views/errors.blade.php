@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <ui>{{ $error }}</ui>
            @endforeach
        </ul>
    </div>
@endif