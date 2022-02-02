<!DOCTYPE html>
<html lang="fr">
<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();
$id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
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
					<titre>Paiement MVOLA :</titre>
					<BR><br>
					<div align="center" style="background-color: #f5cef3;padding: 37px;margin-bottom: 5px;text-align: justify;">
						<?php  	$parametres = $this->Admin_model->get_parametres();
    							$p = $parametres[0];
    					?>
						<p>
							
							Pour payer l' abonnement de 1 mois ( <b><?php echo $p['droit_inscription'] ?> MGA</b>), envoyer l'argent par <b>MVOLA</b> au numero : <br>
							<h3>034 78 343 34</h3>
							<H3>Au nom de : "Solofoniaina Josue"</H3>
							<h3>Description du transfert : "<?php echo $_SESSION['session_membre'] ?> "</h3>
							Il ne faut pas oublier la "<b>description du transfert</b>" pour validation de votre paiement de notre côté.<br>
							Votre prochain paiement sera le <?php echo date('d/m/Y', strtotime(date('Y-m-d').' +1 month')) ?> .<br>
							La validation de votre paiement peut prendre 1 heure.
							
						 </p>
					</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>	
</body>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
</html>