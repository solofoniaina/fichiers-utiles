<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>	Membres | tableau de bord</title>
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
					
					<titre>Tableau de bord membres</titre>
					
					<BR><br>
					<?php
						$mb_active = $this->Bord_model->membre_active_annee('2021');
						$mb_noactive = $this->Bord_model->membre_noactive_annee('2021');

						$nb_active = count($mb_active);
						$nb_noactive = count($mb_noactive);

						//$a_0 = 0;$a_1 = 0;$a_2 = 0;$a_3 = 0;$a_4 = 0;$a_5 = 0;$a_6 = 0;$a_7 = 0;$a_8 = 0;$a_9 = 0;$a_10 = 0;$a_11 = 0;$a_12 = 0;
						$active = array(0,0,0,0,0,0,0,0,0,0,0,0);
						$abo = array(0,0,0,0,0,0,0,0,0,0,0,0);
						foreach ($mb_active as $key => $mba) {
							$mois = substr($mba['date_m'], 5, 2);  // bcd
							$occur = intval($mois)-1;//Le mois commence par "01", mais le tableau commence par "0"
							$active[$occur] = $active[$occur] + 1;

							$mois_abo = substr($mba['active_m'], 5, 2);  // bcd
							$occur_abo = intval($mois_abo)-1;//Le mois commence par "01", mais le tableau commence par "0"
							$abo[$occur_abo] = $abo[$occur_abo] + 1;
						}

					 ?>
					<script type="text/javascript">
						$(function () {
						    $('#container').highcharts({
						    chart: {
						        type: 'line'
						    },
						    title: {
						        text: 'Etat de membres par mois pour 2021'
						    },
						    subtitle: {
						        text: 'Inscription'
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
						        name: 'Inscrits',
						        data: [<?php echo implode(",", $active) ?>]

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
			    		text: 'Validation des emails de confirmation'
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
			    		name: 'Etat de validation de l\'email de confirmation',
			    		data: [
			    			['Non confirmé', <?php echo $nb_noactive ?>],
			    			{
			    				name: 'Confirmé',
			    				y: <?php echo $nb_active ?>,
			    				sliced: true,
			    				selected: true
			    			}
			    		]
			    	}]
			    });
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