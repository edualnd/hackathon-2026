<x-guest-layout>
    @foreach ($escolas as $escola)
    <div>
        <h3>{{ $escola['nome'] }}</h3>

        <p><strong>Tipo:</strong> {{ $escola['tipo'] }}</p>
        <p><strong>Região:</strong> {{ $escola['regiao'] }}</p>
        <p><strong>Bairro:</strong> {{ $escola['bairro'] }}</p>
        <p><strong>Endereço:</strong> {{ $escola['endereco'] }}</p>
        <p><strong>Telefone:</strong> {{ $escola['telefone'] }}</p>
        <p><strong>Email:</strong> {{ $escola['email'] }}</p>
        <p><strong>Integral:</strong> {{ $escola['integral'] ? 'Sim' : 'Não' }}</p>
        <p><strong>Latitude:</strong> {{ $escola['lat'] }}</p>
        <p><strong>Longitude:</strong> {{ $escola['lng'] }}</p>
    </div>

    <hr>
@endforeach
</x-guest-layout>