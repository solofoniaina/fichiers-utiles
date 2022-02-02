<?php  $lati_longi = explode(",",$coord_latlng_a);
      
 ?>

<div id="map" class="col-md-10"></div>
             <div class="col-md-2">
              <b>LISTE AGENCES</b>
              <table class="table table hover">
                <?php 
                $array = array();
                  $agences = $this->Agence_model->select_all();
                  foreach ($agences as $key => $ag) {
                    $lat_long = explode(",", $ag['coord_latlng_a']);
                    $array[] = array("lat" => $lat_long[0], "lon" => $lat_long[1], "nom" => $ag['nom_a'], "ident" => $ag['id_agence']);
                  ?>
                    <tr id="tr_<?php echo $ag['id_agence'] ?>">
                      <td><?php echo $ag['nom_a'] ?></td>
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

                coord_latlng_a

                var centrer = [<?php echo $lati_longi[0] ?>,<?php echo $lati_longi[1] ?>];

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
                  var mks2 = new Array();
                  /*Nom provisoire pour la modification*/
                  var prov_name = "";

                  /*Some Coordinates (here simulating somehow json string)*/
                  var items = <?php echo $geojson ?>;
                 // console.log(items);
                  /*pushing items into array each by each and then add markers*/
                  function itemWrap() {
                    for(i=0;i<items.length;i++){
                      //Array provisoire pour stocker le marker et son nom
                      var markera_array = new Array();
                      //  Le marker
                      var marker_exist = new L.marker([items[i].lat, items[i].lon], {
                              icon: icona
                            });
                      //Push dans l'array provisoire le marker et son nom et son ID
                      markera_array.push(marker_exist);
                      markera_array.push(items[i].nom);
                      markera_array.push(items[i].ident);
                      //Push dans mks2 les markers avec leur nom correspondant
                      mks2.push(markera_array);
                      
                    }

                    for(x=0;x<mks2.length;x++){
                        mks2[x][0].addTo(map).bindPopup(

                      ' <div class=row><div class=col-md-12> <div class=media-body> <h4 class=media-heading></h4> <input id=nom_a type=text class=form-control name=nom_a placeholder="Nom agence" value='+ mks2[x][1]+'><br><button onclick=agence_modif('+mks2[x][2]+',"'+mks2[x][1]+'") class=btn btn-success>Modifier</button> <button onclick=markerDel('+x+','+mks2[x][2]+') class=btn btn-success>Supprimer</button></div></div></div></div></div>',{maxWidth:200}

                      ).openPopup();;
                    }

                  }
                  /*Effacer ce marker */
                  function markerDel(x,ident) {
                      supprimerAgence(ident);
                      map.removeLayer(mks2[x][0]);

                  }
                  /*Going through these marker-items again removing them*/
                  function markerDelAgain() {
                  for(i=0;i<mks.length;i++) {
                      map.removeLayer(mks[i]);
                      /*Pour la modification
                        if ($("#id_agence").val() != "") {
                          map.removeLayer(mks2[$("#id_agence").val()][0]);
                        }*/
                      }  
                      //Vider le variable
                      mks = new Array();
                  }
                  itemWrap();
                  /*
                  CURRENT POSITION
                  lc = L.control.locate({
                      strings: {
                          title: "Show me where I am, yo!"
                      }
                  }).addTo(map);
                  */
                  
                  map.on('click', function(e) {
                      markerDelAgain();
                      secondLatLng = e.latlng;
                      secondPoint = e.layerPoint;

                      $("#coord_point_a").val(e.layerPoint);
                      $("#coord_latlng_a").val(e.latlng);

                      //ENVOYER LES COORD AU SERVEUR POUR TRAITEMENT
                      // + RECUPERATION DES COORDONNEES DU POINT PLUS PROCHE
                       var mark = new L.marker(e.latlng);
                      mks.push(mark);
                      mks[0].addTo(map).bindPopup(

                    ' <div class=row><div class=col-md-12> <div class=media-body> <h4 class=media-heading></h4> <input id=nom_a type=text class=form-control name=nom_a placeholder="Nom agence" value='+prov_name+'><br><button onclick=ajouter_agence() class=btn btn-success>Enregistrer</button> <button onclick=markerDelAgain() class=btn btn-success>Annuler</button></div></div></div></div></div>',{maxWidth:200}

                    ).openPopup();
                    });
                
                </script>