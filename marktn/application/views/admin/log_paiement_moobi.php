<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cybar, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="Cybar." />
	<meta property="og:url" content="www.angelsfraternity.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.angelsfraternity.com" />
	<meta property="og:description"   content="Cybar." />
	<meta property="og:image" content="assets/images/logo.png"/>

	<title>	Admin | page</title>
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
					
					<titre>Les nouveaux paiements VIA MOOBIPAY</titre>
					<?php 
						$log = $this->Admin_model->paiement_moobi();

					?>
					<BR><br>

					<table class="table table-bordered">
						<tr>
							<th>Date</td>
							<th>Orderid</th>
							<th>Montant</th>
							<th>Etat</th>
							<th>Type</th>
							
						</tr>
						<?php
							$somme = 0;
							foreach ($log as $key => $l) {
								$somme += $l['amount'];
						?>
						<tr id="tr_<?php echo $key ?>">
							<td><?php echo $l['daty'] ?></td>
							<td><?php echo $l['order_id'] ?></td>
							<td><?php echo $l['amount'] ?></td>
							<td><?php echo $l['status'] ?></td>
							<td style="background-color: <?php echo $l['type'] ? "#f6f300" : "#17f600" ?>;"><?php echo $l['type'] ? 'Achat' : 'Inscription' ?></td>
						</tr>
						<?php } ?>
						<tr>
							<th>TOTAL</th>
							<th colspan="2"><?php echo $somme ?></td>
							
						</tr>
					</table>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?7" ></script>
</body>
</html>