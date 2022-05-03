<?php include ("views\\inc\\head.php"); ?>	

<style type="text/css">
	.box{
		padding: 20px;
	}
	.box-up{
		border-radius: 20px;
		background: #FFFFFF;
		box-shadow: 0px 4px 20px rgba(12, 0, 28, 0.25);
	}
	.img-wrap{
		max-height: 96px;
	}
	.div-img{
		height: 96px;
	}
	.p-wrap{
		margin: auto; 
		font-size: 2vm;
	}
</style>

<body style="border:0; margin: 0;">

</div>
<div id="map" style="border-radius: 25px!important;">
	<div class = "leaflet-top leaflet-left" style="pointer-events: auto">
	 <button id = "buttonPosition" onclick ="backToPosition()" title="Riposiziona" >
	 	<img src="images/geolocation.jpg" width="30" height="30">
	 </button>
	</div>

	<div class="leaflet-top leaflet-left" style="pointer-events: auto;">
		<button id="cancelRoute" onclick ="removeRoute()" title="Cancella itinerario"> Cancel </button>
	</div>
</div>
<div id="separator-bis" style="height: 30px ;">
	<p class="text"style="text-align: center; margin-top: 10px;"> Informazioni per l'utilizzo del sito: </p>
</div>

<div class="row" style="width: 96%; margin:auto; margin-bottom: 50px;">
  <div class="col-md-3" >
  	<div class="box-up">
	    <div class="box">
	      <div class="div-img"><img src="images/Riposiziona.png" class="rounded mx-auto d-block img-fluid img-wrap"></div>
	        <p class="p-wrap">Con questo bottone è possibile centrare e raggiungere la propria posizione sulla mappa</p>   
	    </div>
	</div>
  </div>
  <div class="col-md-3" >
  	<div class="box-up">
	    <div class="box">
	      <div class="div-img"><img src="images/Layers.png" class="rounded mx-auto d-block img-fluid img-wrap"></div>
	        <p class="p-wrap">Con questo bottone è possibile selezionare cosa mostrare sulla mappa tra biglietterie, tram e bus</p>   
	    </div>
	</div>
  </div>
  <div class="col-md-3" >
  	<div class="box-up">
	    <div class="box">
	      <div class="div-img"><img src="images/cancel.png" class="rounded mx-auto d-block img-fluid img-wrap"></div>
	        <p class="p-wrap">Con questo bottone è possibile cancellare l'itinerario mostrato sulla mappa</p>   
	    </div>
	</div>
  </div>
  <div class="col-md-3" >
  	<div class="box-up">
	    <div class="box">
	      <div class="div-img"><img src="images/direction.png" class="rounded mx-auto d-block img-fluid img-wrap"></div>
	        <p class="p-wrap">Cliccando su un elemento della mappa sarà possibile cliccare il bottone "Portami Qui" per avviare la navigazione</p>   
	    </div>
	</div>
  </div>
</div>





<?php include ("views\\inc\\footer.php"); ?>	

<script type="text/javascript">

var mymap = L.map('map', {
	center: [43.78, 11.23],
	zoom: 14
});


//Mappa base OpenstreetMap
	var baseMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    minZoom: 5,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibmljY28xMCIsImEiOiJja3Z3bHE0azQwOWp6MnBsYzRkNGVtZnY3In0.2q6gnypL02uH5WNFbCxRnA'
}).addTo(mymap);

var ticketIcon = L.icon({
	iconUrl: "images/ticket.jpg",
	iconSize: [30, 30],
    iconAnchor: [25, 40],
	popupAnchor: [0, -30],
});

var tramIcon = L.icon({
	iconUrl: "images/tram.jpg",
	iconSize: [30, 30],
    iconAnchor: [25, 40],
	popupAnchor: [0, -30],
});

var stopsIcon = L.icon({
	iconUrl: "images/stops.png",
	iconSize: [30, 30],
    iconAnchor: [25, 40],
	popupAnchor: [0, -30],
});

var myicon = L.icon({
	iconUrl: "images/icon.jpg",
	iconSize: [50, 50],
	iconAnchor: [25, 40],
	popupAnchor: [0, -30],
});


//Costruzione popup per Tram , Ticket, stops
function onEachFeatureTicket(feature, layer) {

    if (feature.properties && feature.properties.ARC_Street) {
        layer.bindPopup(feature.properties.ARC_Street +" "+ feature.properties.CODICE +" "+ feature.properties.TIPOCIV+" "+ feature.properties.ESPONEN+" "+feature.properties.postal_cod+ "<br />"+feature.properties.city + "<br /> "+ feature.properties.type +"<br /> Chiuso: "+ feature.properties.giorni_chi + "<br />"  + "<br />" + "<button type='button' class='btn btn-outline-primary' id = 'getDirection' onclick = 'createRoute(["+feature.geometry.coordinates+"])'>Portami Qui</button>" );
    }
}

function onEachFeatureTram(feature, layer) {

    if (feature.properties && feature.properties.pk_id_tram) {
        layer.bindPopup("Fermata: "+feature.properties.nome_ferma+"<br />"+ feature.properties.nome +"  <br />Id tram: "+ feature.properties.pk_id_tram + "<br />"  + "<br />"+ "<button type='button' class='btn btn-outline-primary' id = 'getDirection' onclick = 'createRoute(["+feature.geometry.coordinates+"])'>Portami Qui</button>");
    }
}

function onEachFeatureStops(feature, layer) {

    if (feature.properties && feature.properties.stop_id) {
        layer.bindPopup("Fermata: "+feature.properties.stop_name+"<br />"+ "Bus: "+feature.properties.route_short_name +"<br />"+ "Direzione: "+feature.properties.route_long_name+ "<br />"  + "<br />"+ "<button type='button' class='btn btn-outline-primary' id = 'getDirection' onclick = 'createRoute(["+feature.geometry.coordinates+"])'>Portami Qui</button>");
    }
}

//Layer di Shop, Tram, Stops
var shopMap = L.geoJson(atafLayer, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, {icon: ticketIcon});
	},
	onEachFeature: onEachFeatureTicket
});

var shopCluster = L.markerClusterGroup();
shopCluster.addLayer(shopMap);


var tramMap = L.geoJson(tramLayer, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, {icon: tramIcon});
	},
	onEachFeature: onEachFeatureTram
});

var stopsMap = L.geoJson(stopsLayer, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, {icon: stopsIcon});
	},
	onEachFeature: onEachFeatureStops
});

var stopsCluster = L.markerClusterGroup();
stopsCluster.addLayer(stopsMap);
	
var mapLayer = {
	"Open Street Map" : baseMap
}

var overlayMap = {
	"biglietterie" : shopCluster,
	"fermate tram" : tramMap,
	"fermate bus" : stopsCluster
}

var controls = L.control.layers(mapLayer, overlayMap).addTo(mymap);




//Geolocalizzazione
if (!navigator.geolocation){
	console.log("Browser does not support geolocation");
}else {
	setInterval(() => {
		navigator.geolocation.getCurrentPosition(getPosition)
	}, 3000);
}

var marker, circle;
check = true


function getPosition(position){
	var lat = (position.coords.latitude) ;
	var lng = (position.coords.longitude);
	var accuracy = position.coords.accuracy;

	if (check){
		marker = L.marker([lat,lng], {icon: myicon}).bindPopup("I’m here!").openPopup().addTo(mymap);
		check= false;

	}
	else{
		marker.slideTo(	[lat, lng], {
		duration: 2700
});
	}

};

function backToPosition(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position){
			var lat = (position.coords.latitude) ;
			var lng = (position.coords.longitude);
			var latlng = L.latLng(lat, lng);
			mymap.flyTo([lat,lng], 16);
		})
	}
}
backToPosition()

//Routing

var Route,latUser,lngUser;

function createRoute(coordinates) {

	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position){
			latUser = (position.coords.latitude) ;
			lngUser = (position.coords.longitude);
			WaitAndRoute();
		})
	}else console.log("geolocation does not work");


    lat = coordinates[1];	
	lng = coordinates[0];

	function WaitAndRoute(){
		if(Route){
			mymap.removeControl(Route);
		}

		Route = L.Routing.control({
		    waypoints: [
		        L.latLng(latUser, lngUser),
		        L.latLng(lat, lng)
		    ],
		    routeWhileDragging: true,
		    show: true
		}).addTo(mymap);

		mymap.closePopup();

	}
};

function getNearest(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position){
			var latUser = (position.coords.latitude) ;
			var lngUser = (position.coords.longitude);
			var shop = L.geoJson(atafLayer);
			shopIndex = leafletKnn(shop);
			var nearestResult = shopIndex.nearest([lngUser,latUser], 1)[0];
			lng = nearestResult.lon;
			lat = nearestResult.lat;
			createRoute([lng, lat])
			
		})
	}
}
getNearest()

function removeRoute(){
	if(Route){
		mymap.removeControl(Route);
	}else
		console.log("No Route");
}

function showSnackbar() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5500);
}


</script>
