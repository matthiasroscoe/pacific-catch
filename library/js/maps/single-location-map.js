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
 * Find Us maps used on single-location template.
 */

if ( document.body.contains( document.getElementById('find-us-map') ) ) {
  
  var findUsMap;
  var mapEl = document.getElementById('find-us-map');

  function initMap() {
    var center = {
      lat: parseFloat(mapEl.getAttribute('data-lat')), 
      lng: parseFloat(mapEl.getAttribute('data-lng'))
    }
    console.log(center);

    findUsMap = new google.maps.Map(mapEl, {
      center: center,
      zoom: 11,
      styles: mapStyles,

      mapTypeControl: false,
      scaleControl: true,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: false,
    });
    
    var marker = new google.maps.Marker({
      position: center,
      map: findUsMap,
      icon: mapMarker
    })
  } 

}