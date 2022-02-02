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

	<title>	Cybar | page</title>
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
					
					<titre>Liste de paiements effectués</titre>
					<?php 
						$demande = $this->Retrait_model->payee();
						if (count($demande)) {
					?>
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th>Date</td>
							<th>Nom et Prénoms</th>
							<th>Montant</th>
							<td>Numero</td>
							<td>Réference</td>
							
						</tr>
						<?php
						$total = 0;
							foreach ($demande as $key => $d) {
								$total += $d['valeur_d'];
						?>
						<tr class="tr_1_<?php echo $value['id_membre'] ?>">
							<td><?php echo $d['date_d'] ?></td>
							<td><?php echo $d['nom_m']." ".$d['prenom_m'] ?></td>
							<td style="text-align: right;"><?php echo $d['valeur_d'] ?> MGA</td>
							<td><?php echo $d['numero_d'] ?></td>
							<td><?php echo $d['code_paiement_d'] ?></td>
						</tr>
						<?php } ?>
						<tr class="info">
							<th colspan="2">TOTAL</th>
							<th style="text-align: right;"><?php echo $total ?> MGA</th>
						</tr>
					</table>
					<?php
						}
					?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?5" ></script>
</body>
</html>