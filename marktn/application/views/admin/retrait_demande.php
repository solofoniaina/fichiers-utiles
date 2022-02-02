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
<style type="text/css">
	rouge{
		color:#6e0469;
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
					<!--PDP -->
					<?php $this->load->view('template/sous_menu_admin') ?>
					
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Demandes de retrait</titre>
					<?php 
						$demande = $this->Retrait_model->en_attente();
					?>
					<BR><br>
						<?php
							foreach ($demande as $key => $d) {
						?>
							<div class="media">
								<div class="media-body">
								<h4 class="media-heading"><?php echo $d['date_d'] ?>- <?php echo $d['nom_m']." ".$d['prenom_m'] ?></h4>
								<b>Total à retirer : <?php echo $d['valeur_d'] ?> MGA</b><br>
								<div style="font-size: 18px;color: #123">Référence : <rouge><?php echo $d['code_paiement_d'] ?></rouge><br>
								numero Mvola : <rouge><?php echo $d['numero_d'] ?></rouge></div><br><br><button onclick="payer_vanilla(<?php echo $d['id_demande_paiement'] ?>,<?php echo $key ?>)" id="btn-payer-<?php echo $key ?>" class="btn btn-success btn-sm">Payer Vanillapay</button>

								</div>
								<hr>
							</div>
						<?php }
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