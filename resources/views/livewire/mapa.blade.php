<x-guest-layout>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div id="map" style="height: 500px"></div>
    <div id="card-escola" class="mt-4 p-4 border rounded shadow">
        <p>Clique em uma escola no mapa.</p>
    </div>
    <script>
        const map = L.map('map').setView([-23.6205, -45.4132], 12);
        const escolas = @json($escolas);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const card = document.getElementById('card-escola');

        escolas.forEach(escola => {

            const marker = L.marker([
                escola.lat,
                escola.lng
            ]).addTo(map);

            marker.on('click', () => {
                const vagas = escola.vagas
                    .map(vaga => `<li>${vaga.serie}: ${vaga.qtd}</li>`)
                    .join('');
                card.innerHTML = `
            <h2>${escola.nome}</h2>

            <p><strong>Tipo:</strong> ${escola.tipo}</p>
            <p><strong>Região:</strong> ${escola.regiao}</p>
            <p><strong>Bairro:</strong> ${escola.bairro}</p>
            <p><strong>Endereço:</strong> ${escola.endereco}</p>
            <p><strong>Telefone:</strong> ${escola.telefone}</p>
            <p><strong>Email:</strong> ${escola.email}</p>
            <p><strong>Integral:</strong> ${escola.integral ? 'Sim' : 'Não'}</p>

            <h3>Vagas</h3>
    <ul>
        ${vagas}
    </ul>
        `;
            })
        });
    </script>


</x-guest-layout>
