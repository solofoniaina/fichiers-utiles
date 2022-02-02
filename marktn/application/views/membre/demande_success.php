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

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Demande succes</title>
<?php $this->load->view('template/header') ?>

</head>

<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<input type="hidden" name="id_membre" value="<?php echo $id_membre ?>">
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
				
					<!--sous menu -->
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>DEMANDE ENVOYEE</titre>
							<BR><br>
					<div class="resume" style="background-color: #ffa5f8; padding: 32px; font-size: 16px;
}">Demande de retrait envoyée.<br>L'administrateur fera la vérification avant le transfert d'argent vers votre compte.<br>
Référence : <b><?php echo $code_paiement ?></b>
						<br>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>	
</body>

<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
</html>