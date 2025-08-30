window.initMap = function () {
    const $mapEl = $('#singleMap');

    if (!$mapEl.length) return;

    const myLatLng = {
        lat: parseFloat($mapEl.data('latitude')),
        lng: parseFloat($mapEl.data('longitude'))
    };

    const single_map = new google.maps.Map(document.getElementById('singleMap'), {
        zoom: 12,
        center: myLatLng,
        scrollwheel: false,
        zoomControl: false,
        fullscreenControl: true,
        mapTypeControl: false,
        scaleControl: false,
        panControl: false,
        navigationControl: false,
        streetViewControl: true,
        styles: [
            { featureType: "all", elementType: "labels.text", stylers: [{ color: "#878787" }] },
            { featureType: "all", elementType: "labels.text.stroke", stylers: [{ visibility: "off" }] },
            { featureType: "landscape", elementType: "all", stylers: [{ color: "#f9f5ed" }] },
            { featureType: "road.highway", elementType: "all", stylers: [{ color: "#f5f5f5" }] },
            { featureType: "road.highway", elementType: "geometry.stroke", stylers: [{ color: "#c9c9c9" }] },
            { featureType: "water", elementType: "all", stylers: [{ color: "#aee0f4" }] }
        ]
    });

    const marker = new google.maps.Marker({
        position: myLatLng,
        map: single_map,
        icon: 'images/marker.png',
        draggable: false
    });

    // InfoWindow for main marker
    if ($(".mapC_vis").length > 0) {
        const infoTitle = $mapEl.data('infotitle');
        const infoText = $mapEl.data('infotext');
        const infoWindow = new google.maps.InfoWindow({
            content: `<div class='info-window-content'><h1>${infoTitle}</h1><p>${infoText}</p></div>`
        });

        marker.addListener('click', () => {
            infoWindow.open(single_map, marker);
        });
    }

    // Scroll Control
    $('.scrollContorl').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass("enabledsroll");
        single_map.setOptions({ scrollwheel: $(this).hasClass("enabledsroll") });
    });

    // Zoom Control
    const zoomControlDiv = document.createElement('div');
    ZoomControl(zoomControlDiv, single_map);

    function ZoomControl(controlDiv, map) {
        controlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(controlDiv);
        controlDiv.style.padding = '5px';

        const wrapper = document.createElement('div');
        controlDiv.appendChild(wrapper);

        const zoomInBtn = document.createElement('div');
        zoomInBtn.className = "mapzoom-in";
        wrapper.appendChild(zoomInBtn);

        const zoomOutBtn = document.createElement('div');
        zoomOutBtn.className = "mapzoom-out";
        wrapper.appendChild(zoomOutBtn);

        google.maps.event.addDomListener(zoomInBtn, 'click', () => map.setZoom(map.getZoom() + 1));
        google.maps.event.addDomListener(zoomOutBtn, 'click', () => map.setZoom(map.getZoom() - 1));
    }

    // SearchBox for alternate marker (optional)
    if ($(".mapC_vis2").length > 0 && document.getElementById('pac-input')) {
        const input = document.getElementById('pac-input');
        const searchBox = new google.maps.places.SearchBox(input);

        single_map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        single_map.addListener('bounds_changed', () => {
            searchBox.setBounds(single_map.getBounds());
        });

        const infowindow = new google.maps.InfoWindow({});
        let markers = [];

        searchBox.addListener('places_changed', () => {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            markers.forEach(m => m.setMap(null));
            markers = [];

            const bounds = new google.maps.LatLngBounds();

            places.forEach(place => {
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(31, 31),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                const newMarker = new google.maps.Marker({
                    map: single_map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                });

                newMarker.addListener('click', () => {
                    let content = `<h1>${place.name}</h1><p>${place.formatted_address}</p>`;
                    if (place.formatted_phone_number) {
                        content += `<p>Phone: ${place.formatted_phone_number}</p>`;
                    }
                    infowindow.setContent(content);
                    infowindow.open(single_map, newMarker);
                });

                markers.push(newMarker);
                if (place.geometry.viewport) bounds.union(place.geometry.viewport);
                else bounds.extend(place.geometry.location);
            });

            single_map.fitBounds(bounds);
            single_map.setZoom(12);
        });
    }

    // Modal handling
    $(".single-map-item").on("click", function (e) {
        e.preventDefault();
        google.maps.event.trigger(single_map, 'resize');
        $(".map-modal-wrap").fadeIn(400);
        single_map.setZoom(12);

        const newLat = $(this).data("newlatitude");
        const newLng = $(this).data("newlongitude");
        const newTitle = $(this).parents(".geodir-category-listing").find(".geodir-category-content h3 a").text();
        const newAddress = $(this).text();
        const latlng = new google.maps.LatLng(newLat, newLng);

        marker.setPosition(latlng);
        single_map.panTo(latlng);
        $(".map-modal-container h3 span").text(newTitle);

        const infoWindow = new google.maps.InfoWindow({
            content: `<div class='info-window-content'><h1>${newTitle}</h1><p>${newAddress}</p></div>`
        });

        marker.addListener('click', () => {
            infoWindow.open(single_map, marker);
        });
    });

    $(".map-modal-close, .map-modal-wrap-overlay").on("click", function () {
        $(".map-modal-wrap").fadeOut(400);
        single_map.setZoom(14);
        single_map.getStreetView().setVisible(false);
    });
};