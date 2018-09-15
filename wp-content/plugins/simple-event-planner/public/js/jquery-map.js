jQuery(window).load(function () {
    setTimeout(function () {
        jQuery('.cs-map-' + event_map.map_dynmaic_no).animate({
            'height': '" ' + event_map.map_height + '"'
        }, 400)
    }, 400)
});
function initialize() {
    var styles = [
        {
            'featureType': 'water',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': 10
                }
            ]
        },
        {
            'featureType': 'landscape',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': 0
                }
            ]
        },
        {
            'featureType': 'road.highway',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': ''
                },
                {
                    'lightness': -10
                }
            ]
        },
        {
            'featureType': 'road.arterial',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': -10
                }
            ]
        },
        {
            'featureType': 'road.local',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': 16
                }
            ]
        },
        {
            'featureType': 'poi',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': -20
                }
            ]
        },
        {
            'featureType': 'poi.park',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': event_map.map_color
                },
                {
                    'lightness': -1
                }
            ]
        },
        {
            'elementType': 'labels.text.stroke',
            'stylers': [
                {
                    'visibility': 'on'
                },
                {
                    'color': '#d8d8d8'
                },
                {
                    'lightness': 30
                }
            ]
        },
        {
            'elementType': 'labels.text.fill',
            'stylers': [
                {
                    'saturation': 36
                },
                {
                    'color': '#000000'
                },
                {
                    'lightness': 5
                }
            ]
        },
        {
            'elementType': 'labels.icon',
            'stylers': [
                {
                    'visibility': 'on'
                }
            ]
        },
        {
            'featureType': 'transit',
            'elementType': 'geometry',
            'stylers': [
                {
                    'color': '#828282'
                },
                {
                    'lightness': 19
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.fill',
            'stylers': [
                {
                    'color': '#fefefe'
                },
                {
                    'lightness': 20
                }
            ]
        },
        {
            'featureType': 'administrative',
            'elementType': 'geometry.stroke',
            'stylers': [
                {
                    'color': '#fefefe'
                },
                {
                    'lightness': 17
                },
                {
                    'weight': 1.2
                }
            ]
        }
    ];
    var styledMap = new google.maps.StyledMapType(styles,
            {name: 'Styled Map'});

    var myLatlng = new google.maps.LatLng(event_map.map_lat, event_map.map_lon);
    var map_type = event_map.map_type;
    var mapOptions = {
        zoom: parseInt(event_map.map_zoom),
        scrollwheel: event_map.map_scrollwheel,
        draggable: event_map.map_draggable,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.map_type,
        disableDefaultUI: event_map.map_controls,
    }
    var map = new google.maps.Map(document.getElementById('map_canvas' + event_map.map_dynmaic_no), mapOptions);

    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    var infowindow = new google.maps.InfoWindow({
        content: event_map.map_info,
        maxWidth: event_map.map_info_width,
        maxHeight: event_map.map_info_height,
    });

    if ("1" === event_map.map_show_marker || "true" === event_map.map_show_marker) {
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: '',
            animation: google.maps.Animation.DROP,
            icon: '',
            shadow: ''
        });
    }

    if (infowindow.content != '') {
        infowindow.open(map, marker);
        map.panBy(1, -60);
        google.maps.event.addListener(marker, 'click', function (event) {
            infowindow.open(map, marker);
        });
    }

}

google.maps.event.addDomListener(window, 'load', initialize);