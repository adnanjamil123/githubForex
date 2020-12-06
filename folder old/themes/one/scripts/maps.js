
function getMapOptions() {
	var myOptions = { 
		zoom: 16, 
		center: new google.maps.LatLng(0, 0), 
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	} 
	return myOptions;
}

function createMap(mapLayer,locations) {
	var map = new google.maps.Map(document.getElementById(mapLayer),getMapOptions()); 
	setMarkers(map, locations);

}

function setMarkers(map, locations) { 
	var image = new google.maps.MarkerImage('/themes/one/images/mapPin.png',	new google.maps.Size(58, 35)); 
/*
var shadow = new google.maps.MarkerImage('images/beachflag_shadow.png', 
	new google.maps.Size(37, 32), 
	new google.maps.Point(0,0), 
	new google.maps.Point(0, 32)); 
  var shape = { 
	coord: [1, 1, 1, 20, 18, 20, 18 , 1], 
	type: 'poly' 
  }; 
  */
	var bounds = new google.maps.LatLngBounds(); 
	for (var i = 0; i < locations.length; i++) { 
		var loc = locations[i]; 
		var myLatLng = new google.maps.LatLng(loc[1], loc[2]); 
		var zoomLevel = map.getZoom();
		var marker = new google.maps.Marker({ 
			position: myLatLng, 
			map: map, 
			//shadow: shadow, 
			icon: image, 
			//shape: shape, 
			title: loc[0]
			//zIndex: loc[3] 
		}); 
		bounds.extend(myLatLng); 
	} 
	map.fitBounds(bounds); 
	
	google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomChangeBoundsListener = google.maps.event.addListener(map, 'bounds_changed', function(event) {
				//alert(this.getZoom());
				var myMapOptions = getMapOptions();
				if (this.getZoom() > 20) // Change max/min zoom here
					this.setZoom(myMapOptions["zoom"]);
					
				google.maps.event.removeListener(zoomChangeBoundsListener);
			});
	});	
} 
