<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | Créer mot de passe</title>
	<?php $this->load->view('template/header') ?>

</head>

<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete">
			<div class="row">
				<div class="col-md-4" align="center"></div>
				<div class="col-md-4">
					<img class="hidden-xs hidden-sm" src="<?php echo base_url() ?>assets/images/logo.png" title="logo marketinona" alt="logo marketinona" style="height: 170px">
					<div class="formulaire login">
						<form method="POST" action="<?php echo base_url() ?>compte/changer_mdp">
							<h3>CHANGER MOT DE PASSE</h3>
							<output style="color:#f90000;"><?php echo $erreur ?></output>
							<div class="form-group">
								<label>Mot de passe actuel</label>
								<input type="password" class="form-control" name="password0" placeholder="Mot de passe actuel">
							</div>
							<div class="form-group">
								<label>Nouveau mot de passe</label>
								<input type="password" class="form-control" name="password1" placeholder="Mot de passe">
							</div>
							<div class="form-group">
								<label>Confirmation</label>
								<input type="password" class="form-control" name="password" placeholder="Confirmation">
							</div>
							<menu class="cl-effect-8" id="cl-effect-8">
						        <button type="submit">Enregistrer</a>
							</menu>
						</form>
						<a href="<?php echo base_url() ?>">Créer compte</a> | <a href="<?php echo base_url() ?>connexion">Connexion ?</a>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>
</body>
</html>