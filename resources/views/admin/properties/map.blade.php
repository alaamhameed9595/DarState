@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/ol.css">
    <style>
        #map {
            width: 100%;
            height: 600px;
        }

        .ol-popup {
            position: absolute;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            bottom: 12px;
            left: -50px;
            min-width: 200px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }

        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 grid-margin ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Map View</h4>
                        <div id="map" style="width: 100%; height: 500px;"></div>
                        @if (empty($properties) || count($properties) === 0)
                            <div class="alert alert-warning mt-3">No properties found for the selected filters.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/ol@v9.2.4/dist/ol.js"></script>
    <script>
        // The map will only reflect the initial backend data, not live search results
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.ol) {
                document.getElementById('map').innerHTML =
                    '<div class="text-red-600 p-4">Failed to load map library.</div>';
                return;
            }
            // Properties data from backend
            const properties = @json($properties ?? []);
            console.log('Loaded properties:', properties); // Debug log
            // Center map on first property or Abu Dhabi
            const center = properties.length > 0 && properties[0].longitude && properties[0].latitude ?
                ol.proj.fromLonLat([properties[0].longitude, properties[0].latitude]) :
                ol.proj.fromLonLat([56.00271590, 25.53447140]);
            const map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: center,
                    zoom: 11
                })
            });
            // --- Property Markers ---
            function addMarker(prop) {
                const marker = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([prop.longitude, prop.latitude]))
                });
                let iconType = prop.type ? prop.type.replace(/[^a-z0-9]/gi, '_').toLowerCase() : 'other';
                let iconPath = `/assets/admin/img/poi-${iconType}.svg`; // Fixed path
                marker.setStyle(new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 1],
                        src: iconPath,
                        scale: 0.8
                    })
                }));
                const vectorSource = new ol.source.Vector({
                    features: [marker]
                });
                const markerVectorLayer = new ol.layer.Vector({
                    source: vectorSource
                });
                map.addLayer(markerVectorLayer);
                map.on('singleclick', function(evt) {
                    map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                        if (feature === marker) {
                            const coord = feature.getGeometry().getCoordinates();
                            const showUrl = `/properties/${prop.id}`;
                            const content =
                                `<div style='min-width:180px'><a href="${showUrl}" target="_blank"><strong>${prop.price}</strong></a><br>${prop.address || ''}</div>`;
                            const overlay = new ol.Overlay({
                                element: document.createElement('div'),
                                positioning: 'bottom-center',
                                stopEvent: false
                            });
                            overlay.getElement().innerHTML = content;
                            overlay.setPosition(coord);
                            map.addOverlay(overlay);
                            setTimeout(() => map.removeOverlay(overlay), 3500);
                        }
                    });
                });
            }
            // Add all markers initially
            let markerCount = 0;
            properties.forEach(function(prop) {
                if (prop.longitude && prop.latitude) {
                    addMarker(prop);
                    markerCount++;
                }
            });
            console.log('Markers added:', markerCount); // Debug log
            // --- Heatmap of Popular Areas (Demo Data) ---
            // Replace with your real data: [{longitude, latitude, weight}]
            const heatmapData = (window.heatmapPoints || [{
                    longitude: 56.0027,
                    latitude: 25.5344,
                    weight: 0.8
                },
                {
                    longitude: 56.0127,
                    latitude: 25.5444,
                    weight: 0.6
                },
                {
                    longitude: 56.0227,
                    latitude: 25.5244,
                    weight: 0.9
                }
            ]);
            const heatFeatures = heatmapData.map(function(p) {
                return new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([p.longitude, p.latitude])),
                    weight: p.weight
                });
            });
            const heatmapLayer = new ol.layer.Heatmap({
                source: new ol.source.Vector({
                    features: heatFeatures
                }),
                blur: 25,
                radius: 18,
                weight: 'weight'
            });
            map.addLayer(heatmapLayer);

            // --- Nearby Amenities Layer (Overpass API) ---
            function fetchAmenities() {
                // Example: fetch schools, hospitals, malls within map bounds
                const extent = map.getView().calculateExtent(map.getSize());
                const sw = ol.proj.toLonLat([extent[0], extent[1]]);
                const ne = ol.proj.toLonLat([extent[2], extent[3]]);
                const bbox = `${sw[1]},${sw[0]},${ne[1]},${ne[0]}`;
                const query = `
            [out:json][timeout:25];
            (
              node["amenity"~"school|hospital|university|college|clinic|mall"](${bbox});
              way["amenity"~"school|hospital|university|college|clinic|mall"](${bbox});
              relation["amenity"~"school|hospital|university|college|clinic|mall"](${bbox});
            );
            out center;
        `;
                fetch('https://overpass-api.de/api/interpreter', {
                        method: 'POST',
                        body: query,
                        headers: {
                            'Content-Type': 'text/plain'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.elements) return;
                        data.elements.forEach(function(el) {
                            let lon = el.lon || (el.center && el.center.lon);
                            let lat = el.lat || (el.center && el.center.lat);
                            if (lon && lat) {
                                const amenity = el.tags && el.tags.amenity;
                                const marker = new ol.Feature({
                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat]))
                                });
                                marker.setStyle(new ol.style.Style({
                                    image: new ol.style.Icon({
                                        anchor: [0.5, 1],
                                        src: `/assets/admin/images/poi-${amenity ? amenity.replace(/[^a-z0-9]/gi, '_') : 'other'}.svg`,
                                        scale: 0.7
                                    })
                                }));
                                const vectorSource = new ol.source.Vector({
                                    features: [marker]
                                });
                                const markerVectorLayer = new ol.layer.Vector({
                                    source: vectorSource
                                });
                                map.addLayer(markerVectorLayer);
                            }
                        });
                    });
            }
            // Fetch amenities on map moveend
            //map.on('moveend', fetchAmenities);
            // Initial fetch
            // fetchAmenities();
        });
    </script>
@endsection
