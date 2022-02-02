<!DOCTYPE html>
<html lang="fr">
<?php 
if (empty($sESSION['session_membre'])) {
	if (empty($sESSION['session_acheteur'])) {
		$id_membre = "";
	}
	else
	{
		$id_membre = $sESSION['session_acheteur'];
	}
}
else
{
	$id_membre = $sESSION['session_membre'];
}
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Localisation</title>
<?php $this->load->view('template/header') ?>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/leaflet/leaflet.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/leaflet/leaflet.label.css">
	<!--link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/leaflet/L.Control.Locate.min.css"-->
	<script src="<?php echo base_url(); ?>bootstrap/jquery/1.12.4/jquery.min.js" ></script>	
	<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js" ></script>	
	<!--script src="<?php echo base_url(); ?>assets/leaflet/leaflet-src.js"></script>
	<script src="<?php echo base_url(); ?>assets/leaflet/L.Control.Locate.min.js"></script-->
	<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.geometryutil.js"></script>
	

</head>
	<style type="text/css">

		#map{
			height: 500px;
			width: 100%;
		}
	</style>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<input type="hidden" name="id_membre" value="<?php echo $id_membre ?>">
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<!--sous menu -->
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Toerana andraisana ny entana :</titre>
					<BR><br>

						<div class="row achat attente">
						<?php 

							$array = array();
							$agences = $this->Agence_model->select_all();
							foreach ($agences as $key => $ag) {
								$exp_point = explode(",", $ag['coord_point_a']);
								$exp_latlng = explode(",", $ag['coord_latlng_a']);
								$array[] = array("pointa" => $exp_point[0],"pointb" => $exp_point[1], "latlnga" =>  $exp_latlng[0],  "latlngb" =>  $exp_latlng[1],  "id_agence" =>  $ag['id_agence'],  "nom_a" =>  $ag['nom_a']);
							}
							$json = json_encode($array);
						?>
						<form id="enreg_coord" method="POST" action="<?php echo base_url() ?>achat/location_livraison">
							<input type="hidden" value="" name="newlatlng" id="newlatlng" required>
							<input type="hidden" value="" name="newpoint" id="newpoint" required>
							<input type="hidden" value="" name="id_agence" id="id_agence" required>
						</form>

							<div class="col-md-12" id="map"></div>
								<!--Debut CARTE------------------------------------------------------------------------>	
								<script type="text/javascript">
									var firstPoint;
									var secondPoint;
									var secondLatLng;

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
									/*
									CURRENT POSITION
									lc = L.control.locate({
									    strings: {
									        title: "Show me where I am, yo!"
									    }
									}).addTo(map);
									*/
									var items = <?php echo $json ?>;
									var agcs = new Array();
					                 // console.log(items);
					                  /*pushing items into array each by each and then add markers*/
					                  function itemWrap() {
					                  for(i=0;i<items.length;i++){
					                      var agc = L.marker([items[i].latlnga, items[i].latlngb], {
					                            icon: icona
					                          });
					                      agcs.push(agc);
					                      agcs[i].addTo(map).bindPopup(

					                        ' <div class=row><div class=col-md-12><div class=media> <div class=media-body>'+items[i].nom_a+'</div></div></div></div></div>',{maxWidth:200}

					                        );
					                      }
					                  }
					                  itemWrap();


									var proche_a;var proche_b;
									var dist = 1000000000;
									var id_loca = "";

									/*create array for markers & polyline*/
                  					var mks = new Array();
                  					var polys = new Array();

									map.on('click', function(e) {
										markerDelAgain();

										secondLatLng = e.latlng;
										secondPoint = e.layerPoint;

										for(i=0;i<items.length;i++){

											
											distprov = L.GeometryUtil.length([map.latLngToLayerPoint([items[i].latlnga, items[i].latlngb]), e.layerPoint]);

											if (distprov < dist) {
												dist = distprov;
												proche_a = items[i].latlnga;
												proche_b = items[i].latlngb;
												id_agence = items[i].id_agence;
											}
					                    }
					                    $("#newlatlng").val(secondLatLng);
					                    $("#newpoint").val(secondPoint);
					                    $("#id_agence").val(id_agence);

					                    var marker = L.marker(secondLatLng);
										mks.push(marker);
                      					mks[0].addTo(map).bindPopup(

										'	<div class=row><div class=col-md-12> <div class=media-body> <h4 class=media-heading></h4>Hamafisina ity toerana ity ?<br><button onclick=enregistrer_coord() class=btn btn-success>Eny</button> <button onclick=markerDelAgain() class=btn btn-success>Tsia</button></div></div></div></div></div>',{maxWidth:200}

										).openPopup();


									if (proche_a && secondLatLng) {
										// draw the line between points
										var poly = L.polyline([[proche_a,proche_b], secondLatLng], {
										  color: 'red'
										}).addTo(map);
										polys.push(poly);
										polys[0].addTo(map);
									}
									// Averina 100000000 ny dist refa tafapetraka ny point sy ligne
									dist = 1000000000;

									})

									

								/*Going through these marker-items again removing them*/
				                  function markerDelAgain() {
				                  for(i=0;i<mks.length;i++) {
				                      map.removeLayer(mks[i]);
				                      map.removeLayer(polys[i]);
				                      }  
				                      //Vider le variable
				                      mks = new Array();
				                      polys = new Array();
				                  }

				
								function enregistrer_coord()
								{
									$("#enreg_coord").submit();
								}
								</script>
								
					<!--Fin CARTE------------------------------------------------------------------------>

						</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>	
	<?php $this->load->view('template/footer'); ?>
</body>

<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
</html>