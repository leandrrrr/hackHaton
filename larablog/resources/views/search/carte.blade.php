<x-app-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <p class="title">
                Recherche par département
            </p>
        </div>
    </section>
    <head>
        <!-- Métadonnées de la page -->
        <meta charset="UTF-8">
        <title>Carte des départements de France</title>
        <!-- Liens vers les fichiers CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <!-- Style CSS interne -->
        <style>
            #map { height: 900px; }
        </style>
    </head>
    <body>
    <!-- Contenu principal de la page -->
    <div id="map"></div> <!-- Div pour afficher la carte -->

    <!-- Chargement des scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialisation de la carte avec Leaflet
        var map = L.map('map').setView([46.603354, 1.888334], 6);

        // Ajout de la couche de tuiles OpenStreetMap à la carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Charger les données géographiques des départements de France depuis un fichier GeoJSON
        fetch('https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/departements-version-simplifiee.geojson')
            .then(response => response.json())
            .then(data => {
                // Ajout des données géographiques à la carte
                L.geoJSON(data, {
                    // Ajouter un événement de clic à chaque département
                    onEachFeature: function (feature, layer) {
                        layer.on('click', function (e) {
                            var codeDepartement = feature.properties.code;
                            // Redirection vers une nouvelle URL avec le code du département
                            window.location.href = '/departement/' + codeDepartement;
                        });
                    }
                }).addTo(map);
            });
    </script>
    </body>
</x-app-layout>
