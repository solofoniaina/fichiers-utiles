<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>	Cybar | page</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/checkbox.min.css">


</head>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<?php $this->load->view('template/sous_menu_admin') ?>
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Tous les produits</titre>
					<br><br>

					<table class="table table-hover">
						<tr class="danger">
							
							<th></th>
							<th>Nom</th>
							<th>prix</th>
							<th>Details</th>
							<th>Localisation</th>
						</tr>
						<?php
						$package = $this->Admin_model->toutpackage_article();
						$somme = 0;
							foreach ($package as $key => $pack) {
								$produit = $this->Admin_model->produit_package($pack['id_package']);
								$check_ouvert = "";
								if ( $pack['active_p']) {
									$check_ouvert = "checked";
								}
						?>
						<tr id="<?php echo $key ?>" class="warning">
							<td><?php echo $key + 1 ?></td>
							<td> <b><?php echo strtoupper($pack['nom_p']) ?><b> </td> 
							<td><b><?php echo $pack['prix_p'] ?> MGA</b></td>
							<td><?php echo $pack['description_p'] ?></td>
							<td><?php echo $pack['nom_localisation'] ?></td>
							<td>
								<button onclick="charger_modif_produit(<?php echo $pack['id_package'] ?>)" type='button' class='simple bleu' data-dismiss='modal' data-toggle="modal" data-target="#modalupdproduit"> <span class="glyphicon glyphicon-edit"> Modifier</span></button>

								<input type="checkbox" <?php echo $check_ouvert ?> name="ouvert_<?php echo $ligne_ue->id_ue ?>" id="ouvert_<?php echo $pack['id_package'] ?>">
				
								<label onclick="active('<?php echo $pack["id_package"] ?>')" for="ouvert_<?php echo $pack['id_package'] ?>">
									<span class="ui"></span>
								</label>
							</td>
						</tr>
						<tr>
							<td colspan="5">
						<?php  
							$array = array();
							$array['id_package'] = $pack['id_package'];
							$this->load->view('template/images_produit', $array);
							 //FIN PROD dans PACK 
						?>
							</td>
						</tr>

					<?php } ?>

					</table>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?6" ></script>
</body>
</html>


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
<script src="<?php echo base_url() ?>assets/js/validation.min.js" ></script>
<!-- MODAL MODIF PRODUIT -->
<div class="modal fade" id="modalupdproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">

  	<form id="upload_produit_package1" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>admin/update_article">
    <div class="modal-content" id="place_modal_modif">
	<!-- CHARGEE PAR AJAX -->
    </div>
	</form>
  </div>
</div>
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
	var base_url = '<?php echo base_url() ?>';
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>tiny_mce/tiny_mce.min.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			height: "200px"
		});
	</script>