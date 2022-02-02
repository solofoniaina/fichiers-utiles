<!DOCTYPE html>
<html lang="fr">
<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();
if (empty($_SESSION['session_membre'])) {
	if (empty($_SESSION['session_acheteur'])) {
		$id_membre = "";
	}
	else
	{
		$id_membre = $_SESSION['session_acheteur'];
	}
}
else
{
	$id_membre = $_SESSION['session_membre'];
}
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Mes commandes réalisés</title>
<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css">

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
					<titre>Kaomandy vaovao :</titre>
					<BR><br>
						<?php
						$achat = $this->Vente_model->nouveau_commandes_recu_membre_article($id_membre);
						$somme = 0;

							foreach ($achat as $key => $pack) {
						?>

						<div class="row achat attente">
							<div class="col-md-6 produit">
								<h3><span class="glyphicon glyphicon-shopping-cart"></span> Momba ny entana</h3>
								<h5>Daty : <b><?php echo $pack['date_v'] ?></b></h5>
								<h5>Anaran'ny entana : <b><?php echo strtoupper($pack['nom_p']) ?><b></h5>
								<h5>Vidin'ny iray : <b><?php echo $pack['prix_v'] ?> Ariary</b></h5>
								<h5>Isany : <b><?php echo $pack['nombre_v'] ?></b></h5>
								<h5>Totaliny : <b><?php echo $montant = $pack['prix_v'] * $pack['nombre_v'] ?> Ariary</b></h5>
								<div style="margin-top: 10px ">
									<?php $imgs = $this->Details_vente_model->details_achat_package_membre($pack['id_membre_v'], $pack['id_package_v'], $pack['date_v']);
									foreach ($imgs as $key => $images) {
									 //IF IMAGE
											if ((strrpos($images['lien_p'],".jpg")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".png")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".bmp")== (strlen($images['lien_p'])-4)) ) {
										?>
										<img id="" onclick="apercu_image(<?php echo $pack['id_package_v'] ?>,'<?php echo $images['lien_p'] ?>')"  src="<?php echo base_url() ?>assets/files/<?php echo $pack['id_package_v'] ?>/<?php echo $images['lien_p'] ?>" data-toggle="modal" data-target="#modalapercuimage" style="max-height: 100px;max-width: 100px" class=" img-rounded">
										<?php
											}
										}
										?>
								</div>
								
							</div>
							<div class="col-md-6 vendeur">
								<?php
								$etat_paiement = "";
								$etat_livraison = "";
								$etat_reception = "";

								 if ($pack['paye_v'] == 1) { 
								 	$etat_paiement = "ok";

								 	?>
								
									<h3><span class="glyphicon glyphicon-user"></span> Ny mpividy</h3>
									<h5>Anarana : <b><?php echo $pack['nom_m']. " " . $pack['prenom_m'] ?></b></h5>
									<h5>Adiresy : <b><?php echo  $pack['nom_a'] ?></b></h5>
									<!--h5>Finday : <b><?php echo $pack['telephone_m'] ?><b></h5>
									<h5>Mailaka : <b><?php echo $pack['email_m'] ?></b></h5>
									<h5>Adiresy : <b><?php echo $pack['adresse_m'] ?></b></h5-->
										<?php if ($pack['livre_v'] == 1) {
										$etat_livraison = "ok";
										}
									 } else { ?>
									<h3><span class="glyphicon glyphicon-user"></span> Fandefasana entana</h3>
									<h5>Aterinao eny amin'ny agence akaiky anao indrindra ny entana.</h5>
									<br>
									<h5>Eo ihany no andraisanao ny vidiny rehefa voamarina ny entanao</h5>
									
								<?php } ?>
								<span id="commande_paiement" class="commande <?php echo $etat_paiement ?>">voaloa vola</span>
								<span id="commande_livraison" class="commande <?php echo $etat_livraison ?>">nalefa</span>
								<span id="commande_reception" class="commande <?php echo $etat_reception ?>">voaray</span>
							</div>
							
						</div>

						<?php 
						}
						if(count($achat) == 0)
						{
						 ?>
						 <div class="row achat attente" align="center">-- Il n'y a pas de nouvelle commande --</div>
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

<!-- STYLE POUR LOADING -->
<style type="text/css">
	.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-spinner div {
  transform-origin: 40px 40px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 37px;
  width: 6px;
  height: 18px;
  border-radius: 20%;
  background: #fff;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
<!-- MODAL apercu image -->
<div style="background-color: #000000e0 !important;" class="modal fade" id="modalapercuimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div style="    background-color: #1d1d1d00 !important;" class="modal-content" id="">
    	<div style="background-color: #1d1d1d00 !important; border: 0 !important;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
		<div class='modal-body' id="place_image" align="center">
			<!-- image chargée by ajax -->
		</div>
    </div>
  </div>
</div>
<script src="<?php echo base_url() ?>assets/js/apercu_image.min.js" ></script>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/article.min.js" ></script>
</html>