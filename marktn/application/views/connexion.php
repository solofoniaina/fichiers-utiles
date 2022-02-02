<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:url" content="www.marketinona.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | connexion</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?2023">

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
						<form method="POST" action="<?php echo base_url() ?>connexion/se_connecter">
							<h3>CONNECTEZ-VOUS</h3>
							<?php echo $erreur ?>
							<div class="form-group">
								<label>Adresse e-mail / Téléphone</label>
								<input type="text" class="form-control" name="login" placeholder="034xxxxxxx ou xxxxxxxx@mail.com" required/>
							</div>
							<div class="form-group">
								<label>Mot de passe</label>
								<input type="password" class="form-control" name="password" placeholder="Mot de passe" required/>
							</div>
							<menu class="cl-effect-8" id="cl-effect-8">
						        <button type="submit">Connexion</a>
							</menu>
						</form>
						<a href="<?php echo base_url() ?>">Créer compte</a> | <a href="<?php echo base_url() ?>connexion/recuperation">Mot de passe oublié ?</a>
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