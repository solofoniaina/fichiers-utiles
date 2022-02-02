<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; 
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cybar, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<title>	Recapitulatif</title>
<?php $this->load->view('template/header') ?>
</head>

<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<?php $this->load->view('template/sous_menu') ?>
				</div>

				<div class="col-md-9" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Compte principal</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];
						
						$annee = array();
						$commandes = $this->Vente_model->mesventes($id_membre);
						foreach ($commandes as $key => $va) {
							//Date : 0000-00-00
							$mois = substr($va['date_v'], 5, 2);  
							$annee[substr($va['date_v'], 0, 4)] = substr($va['date_v'], 0, 4);
						}
					?>
					<BR><br>
					<div class="row section_recherche">
						<div class="col-md-3">
							<div style="margin-top: 23px;">
								<label>Année :</label>
								<select id="annee_select" onchange="cherche_comandes_periode()" class="form-control">
									<option value="">Toutes</option>
									<?php 
									foreach ($annee as $key => $a) {
									?>
										<option value="<?php echo $key ?>"><?php echo $key ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							
							<div style="margin-top: 23px;">
								<label>Mois :</label>
								<select id="mois_select" onchange="cherche_comandes_periode()" class="form-control">
									<option value="">Tous les mois</option>
									<option value="01">Janvier</option>
									<option value="02">Février</option>
									<option value="03">Mars</option>
									<option value="04">Avril</option>
									<option value="05">Mai</option>
									<option value="06">Juin</option>
									<option value="07">Juillet</option>
									<option value="08">Août</option>
									<option value="09">Septembre</option>
									<option value="10">Octobre</option>
									<option value="11">Novembre</option>
									<option value="12">Décembre </option>
								</select>
							</div>
						</div>
					</div>
					<div id="result_recherche" class="row" align="center">
						<!-- LISTE -->
						<div class="col-md-6">
							<table class="table table-bordered">
							<tr>
								<th>Description</th>
								<th>Prix</th>
								<th>Etat</th>
							</tr>
							<?php 
							$etat = "En attente";
							$ventes = array(0,0,0,0,0,0,0,0,0,0,0,0);
							$attente_ventes = 0;
							$verif_ventes = 0;
							$recu_ventes = 0;
							$ko_ventes = 0;
								foreach ($commandes as $key => $v) {
									$mois = substr($v['date_v'], 5, 2);  // bcd
									$occur = intval($mois)-1;//Le mois commence par "01", mais le tableau commence par "0"
									$ventes[$occur] = $ventes[$occur] + 1;
								?>
									<tr>
										<td><i><?php echo $v['date_v'] ?></i> - Commande <?php echo $v['nom_p'] ?></td>
										<td><?php echo $v['prix_v'] ?></td>
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
								?>
						</table>
						</div>
						<!-- DIAGRAMME -->
						<script type="text/javascript">
						$(function () {
						    $('#line_column').highcharts({
						    chart: {
						        type: 'line'
						    },
						    title: {
						        text: 'Mes commandes'
						    },
						    subtitle: {
						        text: 'Evolution commandes'
						    },
						    xAxis: {
						        categories: [
						            'Jan',
						            'Fev',
						            'Mar',
						            'Avr',
						            'Mai',
						            'Juin',
						            'Juil',
						            'Aout',
						            'Sep',
						            'Oct',
						            'Nov',
						            'Dec'
						        ],
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
						        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
						        data: [<?php echo implode(",", $ventes) ?>]

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
						<div class="col-md-6">
							<div id="line_column">
								
							</div>
							<div id="pie">
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<!-- STYLE POUR LOADING -->
<style type="text/css">
	.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  margin-top: 50px;
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
  background: #ec9349c4;
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
	var base_url = '<?php echo base_url() ?>';
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js?5" ></script>
	<script src="<?php echo base_url() ?>assets/js/highcharts/highcharts.js"></script>
</body>
</html>