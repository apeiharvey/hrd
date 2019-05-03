<!--Mengambil KEY API MAP-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY')}}&callback=initMap"> </script>
<!--Fungsi Menampilkan map-->

<script type="text/javascript">
	function initMap() {
      var uluru = {lat: -6.1905156, lng: 106.7435614};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
      });

      var contentString = '<div id="content">'+
          '<div id="siteNotice">'+
          '</div>'+
          '<h4 id="firstHeading" class="firstHeading">{{$place_name}}</h4>'+
          '<div id="bodyContent">'+
          '<p>{{$address}}</p>'+
          '</div>'+
          '</div>';

      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });

      var image = "{{asset('images/'.$view_path.'/office-building.png')}}";
      
      var marker = new google.maps.Marker({
        position: uluru,
        map: map,
        title: 'Kawanlama',
        icon: image
      });
      infowindow.open(map,marker);
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });

    }

</script>