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

	<title>	demande</title>
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
					<titre>RETRAIT</titre>
							<BR><br>
					<?php
						$total_comm = $this->MesFonctions->total_gain($id_membre);
					?>
								
							
					<div class="resume" style="background-color: #ffa5f8; padding: 32px; font-size: 16px;
}">Pour envoyer une demande de retrait, vous devez enregistrer le numero de votre compte  Mvola<br>
						<br>
						<output id="output" style="color: #f00"><?php echo $error ?></output>
						<form id="form_demande" method="POST" action="<?php echo base_url() ?>retrait/demander">
						<label>Votre numéro de téléphone mobile money<required>*</required></label><br><i>Compte pour recevoir de l'argent</i>
						<input style="height:50px; width: 262px;font-size: 20px;" type="number" class="form-control" size="10" name="number1" id="number1" placeholder="034XXXXXXX" required>
						<label>Confirmation de votre numéro<required>*</required>:</label>
						<input style="height:50px; width: 262px;font-size: 20px;" type="number" class="form-control" size="10" name="number2" id="number2" placeholder="034XXXXXXX" required>
						<label>Mot de passe <required>*</required>:</label>
						<input style="height:50px; width: 262px;font-size: 20px;" type="password" class="form-control" size="10" name="password" id="password" placeholder="Votre mot de passe" required>
						L'administrateur fera la vérification avant le transfert d'argent vers votre compte.
				        <?php if ($this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm)) { ?>
				        	<button type="button" id="btn-submit" class="btn btn-md btn-success" href="<?php echo base_url() ?>index.php/retrait">Continuer</button>
				        </form>
					</div>
					<?php
					}
					?>
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