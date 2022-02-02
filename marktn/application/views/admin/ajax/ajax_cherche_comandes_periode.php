					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];
						
						$commandes = $this->Admin_model->vente_periode($annee, $mois);
					?>
						<div class="col-md-7">
							<table class="table table-bordered">
							<tr>
								<th>Description</th>
								<th>Prix</th>
								<th>frais</th>
								<th>Vendeur</th>
								<th>Com.</th>
								<th>Etat</th>
							</tr>
							<?php 
							
							$ventes = array(0,0,0,0,0,0,0,0,0,0,0,0);
							$verif_ventes = 0;
							$recu_ventes = 0;
							$ko_ventes = 0;
							$attente_ventes = 0;
							$produit = array();
								foreach ($commandes as $key => $v) {
									$etat = "En attente";
									$class = "";
									if (!isset($produit[$v['id_package_v']]['nombre'])) {
										$produit[$v['id_package_v']]['nombre'] = 1;
										$produit[$v['id_package_v']]['nom'] = $v['nom_p'];
									}
									else
									{
										$produit[$v['id_package_v']]['nombre'] += 1;
									}
									$mois = substr($v['date_v'], 5, 2);  // bcd
									$occur = intval($mois)-1;//Le mois commence par "01", mais le tableau commence par "0"
									$ventes[$occur] = $ventes[$occur] + 1;
								?>
									<tr>
										<td><i><?php echo $v['date_v'] ?></i> - Commande <?php echo $v['nom_p'] ?></td>
										<td><?php echo $v['prix_v'] ?></td>
										<td align="right"><?php echo $v['frais_v'] ?></td>
										<td align="right"><?php echo $v['prix_v'] * (100 - $v['com_appliquee']) / 100 ?></td>
										<td align="right"><?php echo $v['prix_v'] * $v['com_appliquee'] / 100 ?></td>
								<?php
									if ($v['livre_v'] == 1) {
										$etat = "Vérifié";
										$class = "jaune";
										
										if ($v['recu_v'] == 1) {
											$etat = "Reçu";
											$class = "vert";
											$recu_ventes += 1;
										}else
										{
											$verif_ventes += 1;
										}
									}
									elseif($v['livre_v'] == 2)
									{
										$etat = "Retour";
										$class = "rouge";
										$ko_ventes += 1;
									}
									else
									{
										$attente_ventes += 1;
									}
									
								?>
										<td class="<?php echo $class ?>" align="right"><?php echo $etat ?> </td>
									</tr>
								<?php
								}

								$nom_prod = array();
								$nombre_prod = array();
								foreach ($produit as $k => $prd) {
									$nom_prod[] = $prd['nom'];
									$nombre_prod[] = $prd['nombre'];
								}
								?>
						</table>
						</div>
						<!-- DIAGRAMME -->
						<script type="text/javascript">
						$(function () {
						    $('#line_column').highcharts({
						    chart: {
						        type: 'column'
						    },
						    title: {
						        text: 'Les commandes'
						    },
						    subtitle: {
						        text: 'Produits commandés'
						    },
						    xAxis: {
						        categories: ['<?php echo implode("','", $nom_prod) ?>'],
						        crosshair: true
						    },
						    yAxis: {
						        min: 0,
						        title: {
						            text: 'Nombre'
						        }
						    },
						    tooltip: {
						        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						        pointFormat: '<tr><td style="padding:0"><b>{point.y} commandes</b></td></tr>',
						        footerFormat: '</table>',
						        shared: true,
						        useHTML: true
						    },
						    plotOptions: {
						        column: {
						            pointPadding: 0.2,
						            borderWidth: 0
						        }
						    },
						    series: [{
						        name: 'Commandes',
						        data: [<?php echo implode(",", $nombre_prod) ?>]

						    }]
						});
							/* PIE LIVRAISON */
							$('#pie').highcharts({
							    	credits:{
							    		enabled: true
							    	},
							    	chart:{
							    		plotBackgroundColor: null,
							    		plotBorderWidth: null,
							    		plotShadow: false
							    	},
							    	title:{
							    		text: 'Etat des commandes'
							    	},
							    	tooltip:{
							    		pointFormat: '<b>{point.name}</b>:{point.percentage:1f} %'
							    	},
							    	plotOptions:{
							    		pie:{
							    			allowPointSelect: true,
							    			cursor: 'pointer',
							    			dataLabels: {
							    				enabled: false
							    			},
							    			showInLegend: true,
							    			
							    			dataLabels: {
							    				enabled: true,
							    				color: '#000',
							    				connectorColor: '#000',
							    				format: '<b>{point.name}</b>'
							    			}
							    			
							    		}
							    	},
							    	series: [{
							    		type: 'pie',
							    		name: 'Etat de livraison',
							    		data: [
							    			['En attente', <?php echo $attente_ventes ?>],
							    			{
							    				name: 'Vérifié',
							    				y: <?php echo $verif_ventes ?>,
							    				sliced: false,
							    				selected: false
							    			},
							    			{
							    				name: 'Reçu',
							    				y: <?php echo $recu_ventes ?>,
							    				sliced: true,
							    				selected: true
							    			}
							    			,
							    			{
							    				name: 'Retour',
							    				y: <?php echo $ko_ventes ?>,
							    				sliced: false,
							    				selected: false
							    			}
							    		]
							    	}]
							    });
							/*FIN*/
							});
							</script>
						<div class="col-md-5">
							<div id="line_column">
								
							</div>
							<div id="pie">
								
							</div>
						</div>