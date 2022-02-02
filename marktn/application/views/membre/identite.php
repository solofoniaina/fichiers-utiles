<!DOCTYPE html>
<html lang="fr">
<?php 
$id_membre = $_SESSION['session_membre'];
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | mon identité</title>
<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css?201910101">
	<script src="<?php echo base_url() ?>assets/js/modernAlert.min.js"></script>
	<script type="text/javascript">
		modernAlert();
	</script>

</head>
<style type="text/css">
	#enreg_photo1, #enreg_photo2, #enreg_photo3{
		display: none;
	}
</style>
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
					<titre>Mombamomba anao :</titre>
					<BR><br>
					<div class="info-produit alert alert-info">
						Raha hivarotra eto amin'ny Marketinona ianao dia tsimaintsy mampiditra an'ireto zavatra manaraka ireto :<br>
						1- Sarin'ny Karapanondrom-pirenena (ambadika sy ambadika)<br>
						2- Sarinao mitazona ny karapanondronao<br>
						Marihina fa ireo rehetra ireo dia mijanona ho <b>Tsiambaratelo ho anay ihany</b> ary ianao ihany no mahita azy
					</div>

					<?php $this->load->view('membre/identite_corps'); ?>

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