jQuery( document ).ready(function($) {

	// map
    var bounds = new google.maps.LatLngBounds();
	var ApusThemerMap = {

		init: function() {
			$('.google-map-wrapper').each(function(){
				var $item = $(this);
				var id = $item.attr('id');
				var lat = $item.data('latitude');
				var lng = $item.data('longitude');
				var map = null;
                var fenway = new google.maps.LatLng(lat, lng);
                var mapOptions = {
                    center: fenway,
                    zoom: $item.data('zoom'),
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById(id), mapOptions);
                
                map.setOptions({styles: $item.data('style')});
                var marker_icon = '';
                if ($item.data('marker_icon')) {
                    var marker_icon = $item.data('marker_icon');
                }
                $('.google-map-item-wrapper', $item.parent()).each(function() {
                    ApusThemerMap.addMarkers($(this), map, marker_icon);
                });
                if ( $('.google-map-item-wrapper', $item.parent()).length > 1 ) {
                    map.fitBounds(bounds);
                }
			});
		},
        // add makers
		addMarkers: function( $item, map, marker_icon ) {
			var lat = $item.data('latitude');
			var lng = $item.data('longitude');
            var latlng = new google.maps.LatLng(lat, lng);

            bounds.extend(latlng);
            var marker_obj = {
                position: latlng,
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP
            };
            if (marker_icon) {
            	marker_obj.icon = marker_icon;
            }
            var marker = new google.maps.Marker(marker_obj);

            //map.fitBounds(bounds);
        },

	}

	ApusThemerMap.init();
});