<div>



    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div id="map" class="relative isolate z-0 h-[80dvh] w-full rounded-2xl sm:h-[400px] lg:h-[520px]" wire:ignore></div>

    

</div>

<script>
    document.addEventListener('livewire:init', () => {

        const escolas = @json($escolas);

        const map = L.map('map').setView([-23.6205, -45.4132], 12);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            subdomains: 'abcd'
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
        const markerShadow = 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png';

        const greenIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            shadowUrl: markerShadow,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const yellowIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-gold.png',
            shadowUrl: markerShadow,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: markerShadow,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Grupo dedicado aos marcadores das escolas, separado dos tiles e do
        // marcador de localização, para poder limpar e redesenhar sem afetar o resto do mapa.
        // OBS: precisa ser featureGroup (não layerGroup) porque só featureGroup
        // tem o método getBounds(), usado pelo fitBounds mais abaixo.
        const marcadoresLayer = L.featureGroup().addTo(map);

        function desenharMarcadores(escolas) {

            console.log('[mapa] desenharMarcadores chamado com', escolas.length, 'escola(s)', escolas);

            marcadoresLayer.clearLayers(); // 1. limpa os marcadores da rodada anterior

            let desenhados = 0;

            escolas.forEach(escola => {

                if (!escola.lat || !escola.lng) {
                    console.warn('[mapa] escola sem lat/lng, ignorada:', escola.nome, escola);
                    return;
                }

                desenhados++;

                const totalVagas = escola.vagas.reduce((total, vaga) => {
                    return total + Number(vaga.qtd);
                }, 0);

                let icon = redIcon;
                if (totalVagas > 30) {
                    icon = greenIcon;
                } else if (totalVagas > 27) {
                    icon = yellowIcon;
                }

                const marker = L.marker([escola.lat, escola.lng], { icon })
                    .addTo(marcadoresLayer); // 2. adiciona no grupo, não direto no map

                marker.bindTooltip(`<strong>${escola.nome}</strong><br>${totalVagas} vagas`);

                marker.on('click', () => {
                    Livewire.dispatch('escolaSelecionada', { escola_id: escola.id });
                });

            });

            console.log('[mapa]', desenhados, 'marcador(es) desenhado(s) de', escolas.length, 'escola(s) recebida(s)');

            // 3. reenquadra o mapa nos resultados atuais
            if (desenhados > 0) {
                map.fitBounds(marcadoresLayer.getBounds(), { padding: [40, 40], maxZoom: 15 });
                console.log('[mapa] fitBounds aplicado');
            } else {
                console.warn('[mapa] nenhum marcador válido — fitBounds NÃO foi chamado');
            }
        }

        // Desenho inicial, com a lista de escolas carregada no primeiro render.
        desenharMarcadores(escolas);

        // Sempre que o Mapa.php despachar novas escolas (filtro mudou), redesenha e reenquadra.
        console.log('[mapa] registrando listener escolas-atualizadas');
        Livewire.on('escolas-atualizadas', (data) => {
            console.log('[mapa] evento escolas-atualizadas recebido', data);
            desenharMarcadores(data.escolas);
        });
    });
</script>
