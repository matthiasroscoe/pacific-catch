/**
 * Map Variables 
 */

var mapMarker = '/wp-content/themes/pacific-catch/library/images/compressed/icons/marker.png';
var mapStyles = [
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "landscape",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#fbf5e9"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.business",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "stylers": [
      {
        "color": "#dfe1e1"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#d0dae2"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]




/**
 * Init all locations map used on archive-locations template
 */
if ( document.body.contains( document.querySelector('.js-all-locations-map') ) ) {
  
  let locMap;
  var mapEl = document.querySelector('.js-all-locations-map');
  var mapData = JSON.parse(document.querySelector('.js-map-data').getAttribute('data-map'));

  function initMap() {

    const center = { // Centered over SF Bay Area
      lat: 37.609069, 
      lng: -122.217572,
    }
    
    // Setup map
    locMap = new google.maps.Map(mapEl, {
      center: center,
      zoom: 9,
      styles: mapStyles,

      mapTypeControl: false,
      scaleControl: true,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: false,
    });
    
    // Setup info windows
    const windows = [];
    for (let i = 0; i < mapData.length; i++) {
        windows[i] = new google.maps.InfoWindow({
            content: mapData[i].content
        })
    }

    // Setup map markers
    const markers = [];
    for (let i = 0; i < mapData.length; i++) {
        markers[i] = new google.maps.Marker({
          position: {
              lat: parseFloat(mapData[i].lat),
              lng: parseFloat(mapData[i].lng),
          },
          map: locMap,
          icon: mapMarker
        })
    }

    // Add windows to markers
    for (let i = 0; i < windows.length; i++) {
        markers[i].addListener('click', function() {
            // Close all open windows
            for (let i = 0; i < windows.length; i++) {
                windows[i].close();
            }
            // Open window
            windows[i].open(locMap, markers[i]);
        }) 
    }
    
  } 

}
