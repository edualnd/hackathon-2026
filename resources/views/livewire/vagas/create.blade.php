<div>
    @foreach ($escolas as $escola)
    <div>
        <h3>{{ $escola['nome'] }}</h3>

        <p><strong>id:</strong> {{ $escola['id'] }}</p>

    </div>

    <hr>
@endforeach
</div>
