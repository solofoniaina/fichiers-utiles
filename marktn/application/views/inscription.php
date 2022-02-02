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
	<meta property="og:image" content="<?php echo base_url() ?>assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<title>	marketinona | Accueil</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/accueil.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?2023">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bg.min.css">

</head>
<style type="text/css">

</style>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
	
		<div class="tete_accueil" style="margin-bottom: 20px">
			<div class="row">

				<div class="col-md-6 hidden-xs hidden-sm" align="center" style="padding-top: 150px;letter-spacing: 2px;">
					<h1>Marketinona</h1>
					<h4 style="color: #676363;letter-spacing: 2px;">Tous les magasins en un clic</h4>
					<br>
					<menu class="cl-effect-8" id="cl-effect-8">
				        <a class="" href="<?php echo base_url() ?>article">Aller au magasin</a>
					</menu>
				</div>
				<div class="col-md-5">
					<div class="formulaire_accueil">
						<form id="form_inscription" method="POST" action="<?php echo base_url() ?>inscription/s_inscrire">
							<h3>Inscrivez-vous ici  <a class="hidden-md hidden-lg" href="<?php echo base_url() ?>connexion">J'ai un compte</a></h3>
							<?php if (empty($error)) {
								$error = '';
								$nom_m 			= "";
								$prenom_m 		= "";						
								$login_m 		= "";					
								$password_m 	= "";					
								$password_m1 	= "";
								$telephone_m 	= "";
								$email_m 		= "";
								$adresse_m 		= "";						} ?>
							<output id="output"><?php echo $error; ?></output>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Nom <required>*</required></label>
									<input type="text" class="form_accueil form-control" name="nom_m" id="nom_m" placeholder="Votre nom de famille" value="<?php echo $nom_m ?>" required/>
								</div>
								<div class="col-md-6 form-group">
									<label>Prénoms <required>*</required></label>
									<input type="text" class="form_accueil form-control" name="prenom_m" id="prenom_m" placeholder="Prénom (s)" value="<?php echo $prenom_m ?>" required/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Pseudo<required>*</required></label>
									<input type="text" class="form_accueil form-control" name="login_m" id="login_m" placeholder="Ex: GAMER" value="<?php echo $login_m ?>" required/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Numero téléphone</label>
									<input type="text" class="form_accueil form-control" name="telephone_m" id="telephone_m" value="<?php echo $telephone_m ?>" placeholder="Téléphone">
								</div>
								<div class="col-md-6 form-group">
									<label>Email <required>*</required></label>
									<input type="email" class="form_accueil form-control" name="email_m" id="email_m" placeholder="Adresse e-mail" value="<?php echo $email_m ?>" required/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Créer un mot de passe <required>*</required> </label>
									<input type="password" class="form_accueil form-control" name="password_m1" id="password_m1" placeholder="Mot de passe" value="<?php echo $password_m1 ?>" required/>
								</div>
								<div class="col-md-6 form-group">
									<label>Confirmation <required>*</required> </label>
									<input type="password" class="form_accueil form-control" name="password_m" id="password_m" placeholder="Confirmation" value="<?php echo $password_m ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label>Adresse <required>*</required></label>
								<textarea class="form-control" name="adresse_m" id="adresse_m" onfocus="if (this.value == 'Ajouter votre adresse' || this.value == 'Adresse') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Ajouter votre adresse';}" required><?php echo $adresse ?></textarea>
							</div>
							<div>En poursuivant, vous avez déjà lu et accepté <a href="<?php echo base_url() ?>cgu" target="_blank">les conditions générales d'utilisation</a> du site.</div>
						    <button type="button" class="btn btn-info" id="btn-submit-insc">Je m'inscris</button>
						    <a class="hidden-xs hidden-sm btn-default btn" href="<?php echo base_url() ?>connexion">Se connecter</a>
						</form>
					</div>
				</div>
				<div class="col-md-1">
				</div>
			</div>
		</div>
		



	</div>
	<?php $this->load->view('template/footer'); ?>
</body>
<script src="<?php echo base_url() ?>assets/js/inscription.min.js"></script>
<!--link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">	
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script-->

</html>