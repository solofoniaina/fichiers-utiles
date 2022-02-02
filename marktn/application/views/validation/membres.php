<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>	Validation | membre</title>
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
					
					<titre>Vérification membres</titre>
					<br><br>
					<div class="row section_recherche">
						<div class="col-md-6">
							<div style="margin-top: 23px;">
								<input id="user_srch" type="text" class="form-control" name="key" value="" placeholder="Recherche utilisateur"> 	
							</div>
						</div>
						<div class="col-md-6">
							<div style="margin-top: 23px;" class="input-group">
								<input id="produit_srch" type="text" class="form-control" name="key" value="" placeholder="Recherche produits">
								<span class="input-group-btn">
									<button onclick="chercher_user_produit()" style="height: 40px;" id="search_btn" class="btn btn-default" type="button">Chercher</button>
								</span>
							</div>
						</div>
					</div>
					<div id="result_recherche" align="center">
					   <!-- PAR DEFAUT PRODUIT NON VALIDE mais MEMBRE VALIDE-->
             <table class="table table-hover">
                <tr class="danger">
                  
                  <th></th>
                  <th>Nom</th>
                  <th>Prénoms</th>
                </tr>
                <?php
                $user = $this->Validation_model->user_validation(1); //2: cin validé
                $somme = 0;
                  foreach ($user as $key => $us) {

                    $check_ouvert = "";
                    if ($us['valid_cin'] == 2) {
                      $check_ouvert = "checked";
                    }
                ?>
                <tr id="tr_<?php echo $us['id_membre'] ?>" id="<?php echo $key ?>" class="warning">
                  <td><?php echo $key + 1 ?></td>
                  <td> <b><?php echo strtoupper($us['nom_m']) ?><b> </td> 
                  <td><?php echo $us['prenom_m'] ?></td>
                  <td><a href="<?php echo base_url() ?>validation/id_apercu/<?php echo $us['id_membre'] ?>" class='btn btn-warning' data-dismiss='modal' data-toggle="modal" data-target="#modal_standard"> <span class="glyphicon glyphicon-user"></span></a></td>
                </tr>
                <?php } ?>
                </table>
                <!-- Fin produit non valide -->

					</div>
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
  margin-top: 50px;
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
  background: #ec9349c4;
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
<!-- MODAL standard -->
<div class="modal fade" id="modal_standard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">

    <form id="upload_produit_package1" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>package/update_article">
    <div class="modal-content" id="" align="center">
    <div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
  </form>
  </div>
</div>
<script src="<?php echo base_url() ?>assets/js/apercu_image.min.js" ></script>
<script src="<?php echo base_url() ?>assets/js/validation.min.js" ></script>
<script type="text/javascript">
	var base_url = '<?php echo base_url() ?>';
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
