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
					
					<titre>Paramètres de Base</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];
					 ?>
					<BR><br>
					<div class="resume" style="background-color: #ffa5f8; padding: 32px; font-size: 16px;}">
					<form method="POST" action="<?php echo base_url() ?>index.php/admin/update_parametres">
						<h5>Paramètres mis à jour le <?php echo $p['date_update'] ?> à <?php echo $p['heure_update'] ?></h5>
						<div class="row">
							<div class="col-md-3">
								<label>% Gain vente public</label>
								<input type="number" class="form-control" value="<?php echo $p['gain_public'] ?>" name="gain_public" id="gain_public">
							</div>
							<div class="col-md-3">
								<label>% Gain vente membre</label>
								<input type="number" class="form-control" value="<?php echo $p['gain_membre'] ?>" name="gain_membre" id="gain_membre">
							</div>
							<div class="col-md-3">
								<label>% Gain referral</label>
								<input type="number" class="form-control" value="<?php echo $p['gain_referral'] ?>" name="gain_referral" id="gain_referral">
							</div>
							<div class="col-md-3">
								<label>Gain referral free</label>
								<input type="number" class="form-control" value="<?php echo $p['gain_referral_free'] ?>" name="gain_referral_free" id="gain_referral_free">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label>% Notre commission</label>
								<input type="number" class="form-control" value="<?php echo $p['notre_commission'] ?>" name="notre_commission" id="notre_commission">
							</div>
							<div class="col-md-3">
								<label>Droit d'inscription (MGA)</label>
								<input type="number" class="form-control" value="<?php echo $p['droit_inscription'] ?>" name="droit_inscription" id="droit_inscription">
							</div>
							<div class="col-md-3">
								<label>Minimum de retrait (MGA)</label>
								<input type="number" class="form-control" value="<?php echo $p['minimum_retrait'] ?>" name="minimum_retrait" id="minimum_retrait">
							</div>
							<div class="col-md-3">
								<label>Bonus abonnement (MGA)</label>
								<input type="number" class="form-control" value="<?php echo $p['bonus_abonnement'] ?>" name="bonus_abonnement" id="bonus_abonnement">
							</div>
						</div>
						<button class="btn btn-danger">Enregistrer</button>
					</form>
					</div>
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