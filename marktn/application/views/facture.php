<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:url" content="www.angelsfraternity.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:image" content="<?php echo base_url() ?>assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Marketinona | page</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
			<img src="<?php echo base_url() ?>assets/images/logo.png" title="logo Marketinona" alt="logo Marketinona" style="height: 70px">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<!--PDP -->
					<div class="photo-place">
						<img alt="votre photo" id="new-image" src="<?php echo base_url() ?>assets/images/user/user.jpg" class="photo-profil no_image" style="height: 120px;width: 120px;border-radius: 10px">
					</div>
		        		<label class="input affiche" for="input" id="input-label" style="border: 1px dashed #ccc; cursor: pointer; padding: 5px; margin-top: 5px; margin-bottom: 20px">Changer photo</label> <button style="display: none;width: 211px; border: 1px dashed #000; height: 40px;" name="submit_photo" type="submit" id="enreg_photo" class="btn btn-success">ENREGISTRER LE PROJET</button>
					<input style="display: none; " type='file' id="input" name="photos" onchange="readURL(this);" />
					<h4>RABIALAHY</h4>
					<H4>Solofoniaina</H4>
					<!--sous menu -->
					<ul id="menu-accordeon">
					   
					   <li><a href="profil.html#">Profil</a></li>
					   <li><a href="#">Mon compte</a>
					      <ul>
					         <li><a href="page.html">AGATE</a></li>
					         <li><a href="page.html">TOPAZE</a></li>
					         <li><a href="page.html">BERYL</a></li>
					         <li><a href="page.html">SAPHIR</a></li>
					         <li><a href="page.html">EMERAUDE</a></li>
					         <li><a href="page.html">RUBIS</a></li>
					         <li><a href="page.html">DIAMANT</a></li>
					         <li><a href="page.html">1 ETOILE</a></li>
					         <li><a href="page.html">2 ETOILES</a></li>
					         <li><a href="page.html">3 ETOILES</a></li>
					         <li><a href="page.html">4 ETOILES</a></li>
					         <li><a href="page.html">5 ETOILES</a></li>
					      </ul>
					   </li>
					</ul>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px">
					<titre>Votre compte sur AGATE</titre> (1€=4000MGA)
					<BR><br>
					<H4>Pour avoir un compte sur AGATE, vous devez payer le droit d'adhesion de 5€ ou <relief> 20 000 MGA </relief> payable via MVOLA.<br></H4>
					<h4>Transférer l'argent vers le numero ci-dessous, en précisant la référence de votre paiement:</h4>
					<div class="reference_paiement">
						<p><span class="glyphicon glyphicon-qrcode"> </span> Réf paiement : 1597</p>
						<p><span class="glyphicon glyphicon-user"> </span> Déstinataire : 034 00 000 00</p>
						<p><span class="glyphicon glyphicon-euro"> </span> Montant : 20 000 MGA</p>

					</div>

					<div class="alert alert-warning" role="alert">
						La référence de paiement est obligatoire, pour que nous puissons identifier votre adhésion.
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
	
</body>
<script type="text/javascript" src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#menu-accordeon>li').click(function(){
        $(this).toggleClass('active');
        $(this).siblings().removeClass('active');
    })   
});
</script>
</html>