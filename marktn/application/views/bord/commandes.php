<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>	Commandes | tableau de bord</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">


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
					<?php $this->load->view('template/sous_menu_admin') ?>
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Tableau de bord commandes</titre>
					
					<BR><br>
					<?php
						$tout_v = $this->Bord_model->toutvente();

						$nb_toutventes = count($tout_v);
						$nb_okventes = 0; // PRODUITS PAYES
						$nb_livreventes = 0; //PRODUITS LIVRES

						//$a_0 = 0;$a_1 = 0;$a_2 = 0;$a_3 = 0;$a_4 = 0;$a_5 = 0;$a_6 = 0;$a_7 = 0;$a_8 = 0;$a_9 = 0;$a_10 = 0;$a_11 = 0;$a_12 = 0;
						$ventes = array(0,0,0,0,0,0,0,0,0,0,0,0);
						$okventes = array(0,0,0,0,0,0,0,0,0,0,0,0);
						foreach ($tout_v as $key => $v) {
							$mois = substr($v['date_v'], 5, 2);  // bcd
							$occur = intval($mois)-1;//Le mois commence par "01", mais le tableau commence par "0"
							$ventes[$occur] = $ventes[$occur] + 1;

							//TEST PAIEMENT
							if ($v['paye_v']) {
								$okventes[$occur] =$okventes[$occur] + 1;
								$nb_okventes ++;
								//TEST LIVRAISON
								if ($v['recu_v']) {
									$nb_livreventes ++;
								}
							}
						}

						$nb_nokventes = $nb_toutventes - $nb_okventes;
						$nb_nolivreventes = $nb_okventes - $nb_livreventes;

					 ?>
					<script type="text/javascript">
						$(function () {
						    $('#container').highcharts({
						    chart: {
						        type: 'column'
						    },
						    title: {
						        text: 'Commande par mois pour l\'année 2021'
						    },
						    subtitle: {
						        text: 'Tous les commandes et commandes payés'
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
						        pointFormat: '<tr><td style="color:{series.color};padding:0"> </td></tr>',
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

						    }, {
						        name: 'Réalisés',
						        data: [<?php echo implode(",", $okventes) ?>]

						    }]
						});

				/* PIE TYPE */

					    $('#pie_type').highcharts({
					    	credits:{
					    		enabled: true
					    	},
					    	chart:{
					    		plotBackgroundColor: null,
					    		plotBorderWidth: null,
					    		plotShadow: false
					    	},
					    	title:{
					    		text: 'Paiement des commandes'
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
					    		name: 'Etat des commandes',
					    		data: [
					    			['Non payés', <?php echo $nb_nokventes ?>],
					    			{
					    				name: 'Payés',
					    				y: <?php echo $nb_okventes ?>,
					    				sliced: false,
					    				selected: false
					    			}
					    		]
					    	}]
					    });
					/* PIE LIVRAISON */
					$('#pie_loca').highcharts({
			    	credits:{
			    		enabled: true
			    	},
			    	chart:{
			    		plotBackgroundColor: null,
			    		plotBorderWidth: null,
			    		plotShadow: false
			    	},
			    	title:{
			    		text: 'Livraison des produits'
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
			    			['Non livrés', <?php echo $nb_nolivreventes ?>],
			    			{
			    				name: 'Livrés',
			    				y: <?php echo $nb_livreventes ?>,
			    				sliced: false,
			    				selected: true
			    			}
			    		]
			    	}]
			    });
					/*FIN*/
					});

				/* PIE type */
				</script>
				<div id="container"></div>
				<div class="row">
					<div class="col-md-6" id="pie_type"></div>
					<div class="col-md-6" id="pie_loca"></div>
				</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php echo base_url() ?>assets/js/highcharts/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts/modules/exporting.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bord.min.js?7" ></script>
</body>
</html>