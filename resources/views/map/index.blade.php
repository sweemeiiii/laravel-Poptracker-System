@extends('user_dashboard.layout')

@section('title', 'Store Locator')

@section('content')
<div class="container mt-5">
    <div class="alert alert-info small">
        Click on any of the store names below to view their location on the map:
    </div>

    <!-- Store List -->
    <div class="mb-4 small">
        <p class="mb-2 text-dark" style="font-size: 0.95rem; font-weight: bold;">
            Pop Mart Stores in Malaysia:
        </p>
        <ul class="list-unstyled">
            <li class="mb-2">
                <span class="store-entry">
                    <a href="#" class="store-link text-dark" data-lat="3.1502" data-lon="101.7138" data-name="Pop Mart Pavilion Kuala Lumpur">
                        🛍️ Pop Mart Pavilion Kuala Lumpur
                    </a>
                    <a href="https://www.google.com/maps?q=Pop+Mart+Pavilion+Kuala+Lumpur" target="_blank" class="map-link ms-2">
                        <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                    </a>
                </span>
            </li>
            <li class="mb-2">
                <span class="store-entry">
                    <a href="#" class="store-link text-dark" data-lat="3.0723" data-lon="101.6073" data-name="Pop Mart Sunway Pyramid">
                        🛍️ Pop Mart Sunway Pyramid
                    </a>
                    <a href="https://www.google.com/maps?q=Pop+Mart+Sunway+Pyramid" target="_blank" class="map-link ms-2">
                        <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                    </a>
                </span>
            </li>
            <li class="mb-2">
                <span class="store-entry">
                    <a href="#" class="store-link text-dark" data-lat="3.1189" data-lon="101.6770" data-name="Pop Mart Mid Valley Megamall">
                        🛍️ Pop Mart Mid Valley Megamall
                    </a>
                    <a href="https://www.google.com/maps?q=Pop+Mart+Mid+Valley+Megamall" target="_blank" class="map-link ms-2">
                        <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                    </a>
                </span>
            </li>
            <li class="mb-2">
                <span class="store-entry">
                    <a href="#" class="store-link text-dark" data-lat="3.1640" data-lon="101.6114" data-name="Pop Mart The Curve">
                        🛍️ Pop Mart The Curve
                    </a>
                    <a href="https://www.google.com/maps?q=Pop+Mart+The+Curve" target="_blank" class="map-link ms-2">
                        <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                    </a>
                </span>
            </li>
            <li class="mb-2">
                <span class="store-entry">
                    <a href="#" class="store-link text-dark" data-lat="2.9674" data-lon="101.7131" data-name="Pop Mart IOI City Mall">
                        🛍️ Pop Mart IOI City Mall
                    </a>
                    <a href="https://www.google.com/maps?q=Pop+Mart+IOI+City+Mall" target="_blank" class="map-link ms-2">
                        <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                    </a>
                </span>
            </li>
        </ul>
    </div>
    
    
        <!-- Map -->
        <div id="map" style="height: 400px; width: 100%;"></div>
    </div>
    
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Leaflet Control Geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom Styling -->
    <style>
        .store-link,
        .map-link {
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }
    
        .store-link:hover {
            color: #007bff;
            cursor: pointer;
        }
    
        .map-link {
            font-size: 0.9rem;
            color: #6c757d;
        }
    
        .map-link:hover {
            text-decoration: underline;
            color: #495057;
        }
    
        .store-entry {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    
    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var map = L.map('map').setView([3.1390, 101.6869], 11);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
    
            // Handle store click to focus map
            document.querySelectorAll('.store-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const lat = parseFloat(this.dataset.lat);
                    const lon = parseFloat(this.dataset.lon);
                    const name = this.dataset.name;
    
                    map.setView([lat, lon], 15);
                    L.popup()
                        .setLatLng([lat, lon])
                        .setContent(`<b>${name}</b>`)
                        .openOn(map);
                });
            });
        });
    </script>
    @endsection
    