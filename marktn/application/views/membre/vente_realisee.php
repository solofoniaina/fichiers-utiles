<!DOCTYPE html>
<html lang="fr">
<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();

$id_membre = $_SESSION['session_membre'];
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css?201910101">

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
					<titre>En attente de livraison :</titre>
					<BR><br>
						<div class="info-produit alert alert-info">
							Ces produits sont en attente de livraison au client
						</div>
						<?php
						$achat = $this->Vente_model->vente_membre_article_livre($id_membre);
						$somme = 0;
							foreach ($achat as $key => $pack) {
						?>
						
						<div class="row achat ok">
							<div class="col-md-6 produit">
								<h3><span class="glyphicon glyphicon-shopping-cart"></span> Momba ny entana</h3>
								<h5>Daty nividianana: <b><?php echo $pack['date_v'] ?></b></h5>
								<h5>Anaran'ny entana : <b><?php echo strtoupper($pack['nom_p']) ?><b></h5>
								<h5>Vidin'ny iray : <b><?php echo $pack['prix_v'] ?> Ariary</b></h5>
								<h5>Isan'ny novidina : <b><?php echo $pack['nombre_v'] ?></b></h5>
								<h5>Vola voaray : <b><?php echo $montant = $pack['prix_v'] * $pack['nombre_v'] ?> Ariary</b></h5>
								<div style="margin-top: 10px ">
									<?php $imgs = $this->Details_vente_model->details_achat_package_membre($pack['id_membre_acheteur'], $pack['id_package_v'], $pack['date_v']);
									foreach ($imgs as $key => $images) {
									 //IF IMAGE
											if ((strrpos($images['lien_p'],".jpg")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".png")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".bmp")== (strlen($images['lien_p'])-4)) ) {
										?>
										<img title="<?php echo $images['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $pack['id_package_v'] ?>/<?php echo $images['lien_p'] ?>" data-toggle="tooltip" data-placement="bottom" style="width: 120px" class=" img-rounded">
										<?php
											}//END IF IMAGE Debut VIDEO AUDIO
											elseif ((strrpos($images['lien_p'],".avi")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".mp4")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".flv")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".vob")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".wmv")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".3gp")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".ogg")== (strlen($images['lien_p'])-4)) ||(strrpos($images['lien_p'],".wma")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".mp3")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".kar")== (strlen($images['lien_p'])-4)) ) {
										?>
										<video controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $images['lien_p'] ?>" alt="télécharger" class="" style="height: auto; width: 50px; "></video>
										<?php
											}
										}
										?>
								</div>
							</div>
							<div class="col-md-6 vendeur">
									<h3><span class="glyphicon glyphicon-user"></span> Momba ny vola</h3>
								<?php if ($pack['retire_argent_v'] == 1) {
									?>
									<h5>Efa voarainao soa amantsara ny vola. <span class="glyphicon glyphicon-ok"></span> </h5>
								<?php }else { 
									?>
									<h5>Tsindrio ny bokotra eto ambany raha hangala ny vidin'ny entanao ianao.</h5>
									<button class="btn btn-warning">Horaisina ny vola</button>


								<?php } ?>
							</div>
							
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
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
</html>