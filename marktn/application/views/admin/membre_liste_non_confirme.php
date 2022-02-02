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
					
					<titre>Les membres non actifs</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];

						$total_droit = 0;
					//Membre_non_confirmé
						$membre = $this->Membre_model->tout_membre_non_confirme();
					?>
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th>Date insc</td>
							<th>Nom et Prénoms</th>
							
						</tr>
						<?php
						$invest = 0;
						$vente_total = 0;
						$gain_total = 0;
						$retrait_total = 0;
						$retirable_total = 0;
							foreach ($membre as $key => $m) {
						?>
						<tr class="tr_1_<?php echo $value['id_membre'] ?>">
							<td><?php echo $m['date_m'] ?></td>
							<td><?php echo $m['nom_m']." ".$m['prenom_m'] ?></td>
						
						</tr>
						<?php } ?>
						<tr class="info">
							<th>TOTAL</th>
							<th style="text-align: right;"><?php echo count($membre) ?> Membres</th>
						</tr>
					</table>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" >
					<div>
						<label>DEBUT</label>
						<input type="number" name="debut" id="debut">
						<label>LIMIT</label>
						<input type="number" name="limit" id="limit" value="50">
						<button id="btn-sendmail" onclick="mail_confirmation_gros()" class="btn btn-warning btn-lg">ENVOYER MAIL DE CONFIRMATION</button>
					</div>
					<div id="output"></div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?7" ></script>
</body>
</html>