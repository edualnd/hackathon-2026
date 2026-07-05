<div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div id="map" style="height:500px;" wire:ignore></div>

    <div id="card-escola" class="mt-4 p-4 border rounded shadow">
        <p>Clique em uma escola.</p>
    </div>

</div>

<script>
    document.addEventListener('livewire:init', () => {

        const escolas = @json($escolas);

        const map = L.map('map').setView([-23.6205, -45.4132], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        if ("geolocation" in navigator) {

            navigator.geolocation.getCurrentPosition(

                function(position) {

                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    map.setView([lat, lng], 14);

                    // marcador azul da localização
                    L.circleMarker([lat, lng], {
                            radius: 8,
                            fillColor: "#2563eb",
                            color: "#ffffff",
                            weight: 3,
                            opacity: 1,
                            fillOpacity: 1
                        })
                        .addTo(map)
                        .bindPopup("Você está aqui.");

                },

                function(error) {
                    console.log("Localização não permitida.");
                },

                {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 60000
                }

            );

        }

        const card = document.getElementById('card-escola');

        escolas.forEach(escola => {

            if (!escola.lat || !escola.lng) {
                return;
            }

            const marker = L.marker([
                escola.lat,
                escola.lng
            ]).addTo(map);

            marker.on('click', () => {

                let vagas = '';

                escola.vagas.forEach(vaga => {
                    vagas += `<li>${vaga.serie}: ${vaga.qtd}</li>`;
                });

                card.innerHTML = `
                <h2>${escola.nome}</h2>

                <p><strong>Tipo:</strong> ${escola.tipo}</p>
                <p><strong>Região:</strong> ${escola.regiao}</p>
                <p><strong>Bairro:</strong> ${escola.bairro}</p>
                <p><strong>Endereço:</strong> ${escola.endereco}</p>
                <p><strong>Telefone:</strong> ${escola.telefone ?? ''}</p>
                <p><strong>Email:</strong> ${escola.email ?? ''}</p>
                <p><strong>Integral:</strong> ${escola.integral ? 'Sim' : 'Não'}</p>

                <h3>Vagas</h3>

                <ul>
                    ${vagas}
                </ul>
            `;
            });

        });

    });
</script>
