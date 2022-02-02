<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | Récuperation mot de passe</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">

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
					
					<div class="formulaire login">
						<form method="POST" action="<?php echo base_url() ?>connexion/recuperer">
							<h3>RECUPERATION DE COMPTE</h3>
							<?php echo $erreur ?>
							<div class="form-group">
								<label>Saisir votre adresse e-mail :</label>
								<input type="text" class="form-control" name="email" placeholder="EX: xxxxxxx@mail.com">
							</div>
							<menu class="cl-effect-8" id="cl-effect-8">
						        <button type="submit">Envoyer le mail de récuperation</a>
							</menu>
						</form>
						<a href="<?php echo base_url() ?>">Créer compte</a> | <a href="<?php echo base_url() ?>inscription">Connexion ?</a>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>
</body>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">	
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>
</html>