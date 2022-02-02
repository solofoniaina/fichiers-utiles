<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	PRODUITS | page</title>
	<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/progressbar.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/checkbox.min.css">
	<script src="<?php echo base_url() ?>assets/js/modernAlert.min.js"></script>
	<script type="text/javascript">
		modernAlert();
	</script>
</head>
<style type="text/css">
	.add_image{
		max-height: 95px;
    	opacity: 0.3;
    	transition: all 0.1s;
	}
	.add_image:hover{
		opacity: 0.5;
	}
	.form-control{
		border :1px solid #242221 !important;
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
					<titre>Mes produits :</titre> 
					<div class="row">
						<div class="info-produit alert alert-info">
							<span class="glyphicon glyphicon-minus"></span> Appuyer sur le bouton bleu pour ajouter du produit.<br>
							<span class="glyphicon glyphicon-minus"></span> La description du produit doit être clair<br>
							<span class="glyphicon glyphicon-minus"></span> Chaque produit doit avoir au moins une photo réélle
						</div>
						<div class="col-md-12" id="corps_produit_package">
							<br>
							<button type='button' class='btn btn-info' data-dismiss='modal' data-toggle="modal" data-target="#modalnewproduit">Ajouter produit <span class="glyphicon glyphicon-plus"></span></button>

							<a href="<?php echo base_url() ?>compte/id_corps" class='btn btn-warning' data-dismiss='modal' data-toggle="modal" data-target="#modal_standard">Vérifier identité <span class="glyphicon glyphicon-ok"></span></a>
							<br>
							<?php $packages = $this->Package_model->package_membre_article($id_membre);
								$somme = 0;
									foreach ($packages as $key => $pack) {

										$check_ouvert = "";
										
								?>
								
								<div class="row achat attente">
									<div class="col-md-6 produit">
										<button class="simple" onclick="prompt('Saisir la quantité à ajouter', 'Mise à jour stock :',ajouterstock,<?php echo $pack['id_package'] ?>)"><span class="glyphicon glyphicon-plus"></span></button>
										<h4><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo strtoupper($pack['nom_p']) ?> <?php
											if ( $pack['active_p']) {
										?>
										<span style="color: #05b502" class="glyphicon glyphicon-ok"></span>

										<?php
											}
										?></h4>
										<h6><i><?php echo $pack['nom_c'] ?></i></h6>
										<h5>Etat : <b><?php echo ($pack['etat_p'] == 1) ? "Occasion" : "Neuf" ?></b></h5>

										<h5>Prix : <b><?php echo $pack['prix_p'] ?> MGA</b></h5>
										<h5>Stock : <b id="place_stock<?php echo $pack['id_package'] ?>"><?php echo $pack['stock_p'] ?></b></h5>
										<div style="margin-top: 10px " class="article_<?php echo $pack['id_package'] ?>">
											<?php $imgs = $this->Produit_model->produit_package($pack['id_package']);
											foreach ($imgs as $key => $images) { ?>

												<img id="" onclick="apercu_image(<?php echo $pack['id_package'] ?>,'<?php echo $images['lien_p'] ?>')"  src="<?php echo base_url() ?>assets/files/<?php echo $pack['id_package'] ?>/<?php echo $images['lien_p'] ?>" data-toggle="modal" data-target="#modalapercuimage" style="max-height: 100px;max-width: 100px" class="img-rounded img_<?php echo $images['id_produit'] ?>">

												<?php } ?>
												<!-- AJOUTER PHOTOS -->
												<img  title="Hanampy sary" src="<?php echo base_url() ?>assets/images/add_image.png" data-placement="bottom" style="max-height: 50px" class="add_image" onclick="charger_modal_image(<?php echo $pack['id_package'] ?>)"  data-toggle="modal" data-target="#modalupdimage">
										</div>
									</div>
									<div class="col-md-6 vendeur">
										
										Localisation : <b><?php echo $pack['nom_a'] ?></b>
										<br>
										<?php echo $pack['description_p'] ?>
										<br>
										<button onclick="charger_modif_produit(<?php echo $pack['id_package'] ?>)" type='button' class='simple bleu' data-dismiss='modal' data-toggle="modal" data-target="#modalupdproduit">Modifier <span class="glyphicon glyphicon-edit"></span></button>
									</div>
									
								</div>

									<?php 
									}
									 ?>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>	
</body>



<!-- MODAL NOUVEAU PRODUIT -->
<div class="modal fade" id="modalnewproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form id="upload_produit_package1" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>package/insert_article">
    <div class="modal-content" id="place_modal_description">
    	<div class='modal-header'>
    		A propos de votre produit
    	</div>
		<div class='modal-body'>
			<output id="output"></output>
				<input type="hidden" name="id_membre_p" value="<?php echo $id_membre ?>">
				<div class="row">
					<div class="col-xs-6">
						<label>Nom du produit <required>*</required>:</label>
						<input class="form-control" type="text" id="nom_p" name="nom_p" value="" required/>
					</div>
					<div class="col-xs-3">
						<label>Prix<required>*</required>: </label> 
						<input class="form-control" type="number" id="prix_p" name="prix_p" value="" required/>
					</div>
					<div class="col-xs-3">
						<label>Qté stock :<required>*</required>: </label> 
						<input class="form-control" type="number" id="stock_p" name="stock_p" value="" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-4">
						<label>Localisation :</label> 
						<select class="form-control" id="localisation_p" name="localisation_p">
							<?php $localisation = $this->Agence_model->select_all();
							foreach ($localisation as $key => $ag) {
							echo "<option value='".$ag['id_agence']."'>".$ag['nom_a']."</option>";
							}
							?>
						</select>
					</div>
					<div class="col-xs-4">						
						<label>Catégorie :</label>
						<select id="categ_p" name="categ_p" class="form-control">

							<?php $categ = $this->Categorie_model->get_categorie();
								foreach ($categ as $key => $cat) {
								echo "<option value='".$cat['id_categorie']."'>".$cat['nom_c']."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-xs-4">						
						<label>Etat ?</label>
						<select id="etat_p" name="etat_p" class="form-control">
							<option value="2">Neuf</option>
							<option value="1">Occasion</option>
						</select>
					</div>
				</div>

				
				
				<label>Description <required>*</required> :</label><i>Ecrire la description de votre produit à vendre.</i>
				<textarea rows="5" class="form-control" id="description_p" name="description_p" onfocus="if (this.value == 'Asio fanazavana momba ny entana hamidinao' || this.value == 'Mombamomba') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Asio fanazavana momba ny entana hamidinao';}">
				</textarea>

		</div>
		<div class='modal-footer'>
			<input type="submit"  class="btn btn-success" value="Enregistrer" name="submit">
			<button type='button' class='btn btn-default' data-dismiss='modal' >Fermer</button>
		</div>
    </div>
	</form>
  </div>
</div>

<!-- MODAL MODIF PRODUIT -->
<div class="modal fade" id="modalupdproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">

  	<form id="upload_produit_package1" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>package/update_article">
    <div class="modal-content" id="place_modal_modif">
	<!-- CHARGEE PAR AJAX -->
    </div>
	</form>
  </div>
</div>
<!-- MODAL MODIF images -->
<div class="modal fade" id="modalupdimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">

  	<form id="upload_produit_package" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>produit/insert_image">
    <div class="modal-content" id="place_modal_image">
    	<!--CHARGEE PAR AJAX -->
    </div>
	</form>
  </div>
</div>

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
	<script src="<?php echo base_url() ?>assets/js/produit.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url() ?>tiny_mce/tiny_mce.min.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			height: "200px"
		});
	</script>
</html>
