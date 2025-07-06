@extends('layouts.website')
@section('title', 'Blog')
@section('styles')
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
    <link rel="stylesheet" href="https://unpkg.com/ol@9.2.4/ol.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection
@section('content')
    <section class="south-contact-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-heading">
                        <h6>Contact info</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="content-sidebar">
                        <!-- Office Hours -->
                        <div class="weekly-office-hours">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span>
                                    <span>09 AM - 19 PM</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>09
                                        AM - 14 PM</span></li>
                                <li class="d-flex align-items-center justify-content-between"><span>Sunday</span>
                                    <span>Closed</span>
                                </li>
                            </ul>
                        </div>
                        <!-- Address -->
                        <div class="address mt-30">
                            <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt=""> +971 5060
                                74002</h6>
                            <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                                contact@darstate.com</h6>
                            <h6><img src="{{ asset('assets/website/img/icons/location.png') }}" alt=""> Mayah Str.
                                no 8, b5, 56832,
                                AlAin , UAE</h6>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Area -->
                <div class="col-12 col-lg-8">
                    <div class="contact-form">
                        <form action="{{ route('contact.send') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="text" id="contact-name"
                                    placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="number" id="contact-number"
                                    placeholder="Your Phone">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="contact-email"
                                    placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class="btn south-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Maps -->

    <div class="map-area mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="leaflet-map" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/ol@9.2.4/dist/ol.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // OpenLayers Map
        window.addEventListener('load', function() {
            if (window.ol && window.ol.Map) {
                const fixedLocation = {
                    lat: 24.5344714,
                    lng: 56.0027159
                };
                const center = ol.proj.fromLonLat([fixedLocation.lng, fixedLocation.lat]);
                const mapOL = new ol.Map({
                    target: 'map',
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.OSM()
                        })
                    ],
                    view: new ol.View({
                        center: center,
                        zoom: 15
                    })
                });
                // Add marker for OpenLayers
                const marker = new ol.Feature({
                    geometry: new ol.geom.Point(center)
                });
                marker.setStyle(new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 1],
                        src: '/assets/admin/img/poi-apartment.svg',
                        scale: 0.9
                    })
                }));
                const vectorSource = new ol.source.Vector({
                    features: [marker]
                });
                const markerVectorLayer = new ol.layer.Vector({
                    source: vectorSource
                });
                mapOL.addLayer(markerVectorLayer);
                console.log('OpenLayers map initialized and marker added.');
            }
        });
        // Leaflet Map (in a separate container)
        window.addEventListener('load', function() {
            if (window.L && document.getElementById('leaflet-map')) {
                const leafletMap = L.map('leaflet-map').setView([25.5344714, 56.0027159], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(leafletMap);
                L.marker([25.5344714, 56.0027159]).addTo(leafletMap)
                    .bindPopup('Mayah Str. no 8, b5, 56832, AlAin, UAE').openPopup();
                console.log('Leaflet map initialized and marker added.');
            }
        });
    </script>
@endsection
