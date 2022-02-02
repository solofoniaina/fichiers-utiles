<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>	Agence | page</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/leaflet/leaflet.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/leaflet/leaflet.label.css">
  <script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js" ></script> 
  <script src="<?php echo base_url(); ?>assets/leaflet/leaflet.geometryutil.js"></script>


</head>
<style type="text/css">
    #map{
      height: 400px;
    }
  </style>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<?php $this->load->view('template/sous_menu_admin') ?>
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite" align="center">
					
					<titre>Localisation des commandes</titre>
					<br><br>
					<div class="section_recherche">
            <form class="form form-inline">
              <input id="nom_a" type="text" class="form-control" name="nom_a" value="" placeholder="Nom de l'agence">
              <input id="coord_point_a" type="hidden" class="form-control" name="coord_point_a" value="" placeholder="coordonnées point" disabled=""> 
              <input id="coord_latlng_a" type="hidden" class="form-control" name="coord_latlng_a" value="" placeholder="coordonnées" disabled="">  
               <input id="id_agence" type="hidden">  
              <button onclick="ajouter_agence()" style="height: 40px;" id="search_btn" class="btn btn-default" type="button">Enregistrer</button>
            </form>
								
					</div>
          <div class="place_loading" align="center"><div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
					<div id="result" class="row">
              <div id="map" class="col-md-10"></div>
             <div class="col-md-2">
              <table class="table table hover">
                <?php 
                //COMMANDES PAR AGENCES
                  $cmd = array();
                  $commande = $this->Admin_model->tout_commande();
                    foreach ($commande as $key => $com) {
                      $cmd[$com['id_agence']][] = $com['id_vente'];
                    }

                  $array = array();
                  $agences = $this->Agence_model->select_all();
                  foreach ($agences as $key => $ag) {
                    $lat_long = explode(",", $ag['coord_latlng_a']);
                    $array[] = array("lat" => $lat_long[0], "lon" => $lat_long[1], "cmd" => count($cmd[$ag['id_agence']]), "id_agence" => $ag['id_agence'], "nom_a" => $ag['nom_a']);
                  ?>
                    <tr>
                      <td><a href="<?php echo base_url() ?>bord/commande_par_agence?p=<?php echo $ag['id_agence'] ?>" target="_blank"> <?php echo $ag['nom_a'] ?> <span class="badge"><?php echo count($cmd[$ag['id_agence']]) ?></span></a> </td>
                  </tr>

                  <?php
                  }
                 $geojson = json_encode($array);
                    
                  ?>
              </table>
             </div>
             <script>
                var firstPoint;
                var secondPoint;
                var firstLatLng;
                var firstPoint;

                var centrer = [-21.46342, 47.11029];

                    var map = L.map('map');
                    var tile_url = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
                    var layer = L.tileLayer(tile_url, {
                        attribution: 'OSM'
                    });
                    map.addLayer(layer);
                    map.setView(centrer, 16);
                  //ICON SARY
                  
                  var icona = L.icon({
                    iconUrl: '<?php echo base_url(); ?>assets/leaflet/images/tranokely.png',
                    iconSize: [25, 25],
                    iconAnchor: [18, 18],
                    popupAnchor: [0, -18],
                    labelAnchor: [14, 0] // as I want the label to appear 2px past the icon (18 + 2 - 6)
                  });

                  /*create array:*/
                  var mks = new Array();

                  /*Some Coordinates (here simulating somehow json string)*/
                  var items = <?php echo $geojson ?>;
                 // console.log(items);
                  /*pushing items into array each by each and then add markers*/
                  function itemWrap() {
                  for(i=0;i<items.length;i++){
                      var LamMarker = new L.marker([items[i].lat, items[i].lon], {
                            icon: icona
                          }).addTo(map).bindPopup(

                        ' <div class=row><div class=col-md-12><div class=media> <div class=media-body>('+items[i].cmd+') - '+items[i].nom_a+'<br><a href=<?php echo base_url() ?>bord/commande_par_agence?p='+items[i].id_agence+' target=_blank>Voir details</a></div></div></div></div></div>',{maxWidth:200}

                        ).openPopup();
                      }
                  }
                  /*Going through these marker-items again removing them*/
                  function markerDelAgain() {
                  for(i=0;i<mks.length;i++) {
                      map.removeLayer(mks[i]);
                      }  
                      //Vider le variable
                      mks = new Array();
                  }
                  itemWrap();
                </script>
					</div>

				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>

<!-- STYLE POUR LOADING -->
<style type="text/css">
.place_loading{
  background-color: transparent;
    height: 100px;
    width: 100%;
    z-index: 1;
    position: absolute;
    top: 280px;
}
  .lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-spinner div {
  transform-origin: 40px 40px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 37px;
  width: 6px;
  height: 18px;
  border-radius: 20%;
  background: #ec9349 ;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/agence.min.js" ></script>
</body>
</html>
<script type="text/javascript">
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>