<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/jpg" href="images/icon.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="../dist/MarkerCluster.css" />
  <link rel="stylesheet" href="../dist/MarkerCluster.Default.css" />
    <script type="text/javascript" src="geoJson/ataf.js"></script>
    <script type="text/javascript" src="geoJson/tram.js"></script>
    <script type="text/javascript" src="geoJson/BusStops.js"></script>
    <script src="https://unpkg.com/leaflet-knn@0.1.0/leaflet-knn.js"></script>
    <link rel="stylesheet" type="text/css" href="views/inc/style.css?v=28 ">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Pagina</title>
  </head>
  <div class="p-5 text-center bg-image head-div" >
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.65 ); border-radius: 25px;">
      <div class="d-flex justify-content-center align-items-center h-100" style="padding: 20px;">
        <div class="text-white">
          <h1 class="mb-3"
          style="
          font-size: 7vmin;">Fast Ticket</h1>
          <h4 class="mb-3"
          style="
          font-size:3vmin ;">Trova la biglietteria più vicina a te</h4>
          <a class="btn btn-outline-light btn-lg" href='#separator-bis' onclick="showSnackbar()" role="button"
          style="
          width: 10%;
          text-align: center;
          margin: auto;
          display: table-cell;
          vertical-align: middle;
          font-size: 2vmin;"

          >Informazioni</a>

        </div>
      </div>
    </div>
  </div>
  <div id="separator" style="height: 15px ;">
    <div id="snackbar">Itinerario verso la biglietteria più vicina mostrato in mappa al primo accesso</div>
  </div>
  <body>