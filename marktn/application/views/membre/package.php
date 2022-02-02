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

	<title>	Dossier packages | page</title>
<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/progressbar.min.css">

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
					<titre>Mes dossiers :</titre> 
					<div class="row">
						<div class="info-produit alert alert-info">
							<span class="glyphicon glyphicon-minus"></span> Avant d'ajouter des fichiers, vous devez les mettre dans un <b>dossier</b>.<br>
							<i><b>Un dossier</b> est comme un <b>paquet</b> de biscuits. Il contient un ou plusieurs fichiers à vendre ensemble.<br> <u>Exemple</u> : Un dossier <b>"Cours Anglais"</b> peut contenir <b>deux vidéos</b> (Partie1.mp4 et Partie2.mp4) et <b>un document</b> guide.pdf. </i><br>
							<span class="glyphicon glyphicon-minus"></span> Puis Cliquer sur l'image du dossier pour l'ouvrir ou ajouter des fichiers dedans.
						</div>
						<div class="col-md-8" id="corps_produit_package">
							<br>
							<?php $packages = $this->Package_model->package_membre($id_membre);
								//var_dump($packages);
								$nombre = count($packages);
							
							if(!$nombre){
							?>
							<div class="well well-lg holder_text">
								Vous n'avez pas encore de dossiers, ni de fichiers à vendre.
								<br>
								Vous pouvez ajouter gratuitement à l'aide de ce formulaire simple.
							</div>
							<?php
							}
								$row = intval($nombre / 2);
								if ($nombre % 2) {
									$row += 1;
								}
							$nb = 0;
							$total = 0;
							for ($x=0; $x < $row ; $x++) { 


							 ?>
							<div class="row">
								<?php for ($j=$nb; $j < $nb+2; $j++) { 

									if (empty($packages[$j]['image_p'])) {
										$saryeto = "holder.jpg";
									}
									else
									{
										$saryeto = "membre/".$id_membre."/".$packages[$j]['image_p'];
									}
								?>
									<div  class="col-md-6">
										<div class="thumbnail" align="center">
											<a title="Clic pour Ouvrir" href="<?php echo base_url() ?>index.php/magasin/packages/<?php echo $packages[$j]['id_package'] ?>">
												<img src="<?php echo base_url() ?>assets/images/<?php echo $saryeto ?>" alt="Ouvrir" class="" style="height: 150px; width: auto; opacity:0.5;">
												<img class="hidden-xs img-folder" style="" src="<?php echo base_url() ?>assets/images/folder.PNG" alt="Ouvrir">
											</a>
											<div class="caption">
												<h4><?php echo $packages[$j]['nom_p'] ?></h4>
												<p><?php echo $packages[$j]['prix_p'] ?> MGA</p>
												<p><?php echo $packages[$j]['description_p'] ?> </p>
												<div style="margin-top: 23px;" class="input-group-btn">
													
													<a href="<?php echo base_url() ?>index.php/package/upd/<?php echo $packages[$j]['id_package'] ?>" class="btn btn-xs btn-warning type="button"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
													<a href="<?php echo base_url() ?>index.php/package/del/<?php echo $packages[$j]['id_package'] ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
													
													</span>
												</div>
											</div>
										</div>
									</div>
								<?php
									if ($j == $nombre-1 ) {
										break;
									}
								}

								$nb += 2; ?>
								
							</div>
							<?php } //ROW ?>
						</div>
						<div class=" formulaire col-md-4" style="padding: 20px;border: solid 3px #de8e8e;">
							<br>
							<b style="color: #de8e8e">AJOUTER VOS DOSSIERS</b>
							<hr>
							<?php 
							//POUR MODIF
								$prod_upd = $this->Package_model->cepackage($id_package);
							?>
							<form id="upload_produit_package" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>index.php/package/insert">
								<input type="hidden" name="id_membre_p" value="<?php echo $id_membre ?>">
								<input type="hidden" name="id_package" value="<?php echo $id_package ?>">
								
								<label>Nom dossier <required>*</required>:</label>
								<input class="form-control" type="text" id="nom_p" name="nom_p" value="<?php echo $prod_upd[0]['nom_p'] ?>" required/>
								<label>Prix (en Ariary) <required>*</required>: </label> <i>Prix de l'ensemble de fichiers dans ce dossier</i>
								<input class="form-control" type="number" id="prix_p" name="prix_p" value="<?php echo $prod_upd[0]['prix_p'] ?>" required/>
								<label>Description <required>*</required> :</label><i>Ecrire une petite description de ce que vous êtes en train de vendre</i>
								<textarea class="form-control" id="description_p" name="description_p" onfocus="if (this.value == 'Ajouter une petite description à votre package' || this.value == 'Description') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Ajouter une petite description à votre package';}">
								<?php echo $prod_upd[0]['description_p'] ?>
								</textarea>

								<?php 
									if (empty($prod_upd[0]['image_p'])) {
										$saryeto = "holder.jpg";
									}
									else
									{
										$saryeto = "membre/".$id_membre."/".$prod_upd[0]['image_p'];
									}

								 ?>
								 <label style="border: solid 1px; padding: 3px; cursor: cell;" class="input affiche" for="input" id="input-label"><?php echo (empty($id_package)) ? 'Ajouter image' : 'Changer image' ?></label> <i>Choisir une image pour illustration </i>
								<div class="photo-place">
									<img for="input" alt="votre photo" id="new-image" src="<?php echo base_url() ?>assets/images/<?php echo $saryeto ?>" class="photo-service no_image" style="height: 120px;width: 120px;border-radius: 2px">
								</div>
					        	<input style="display: none;" type='file' id="input" name="image_p" onchange="readURL(this);" />
								<br>
								<input type="submit"  class="btn btn-<?php echo (empty($id_package)) ? 'success' : 'warning' ?>" value="<?php echo (empty($id_package)) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
							</form>
							<!-- PROGRESS BAR -->
							<div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
    						<div id="output"><!-- error or success results --></div>
    						<!-- FIN PROGRESS BAR -->

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
	<script src="<?php echo base_url() ?>assets/js/produit.min.js" ></script>
</html>
