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

	<title>marketinona | page</title>
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
					<?php $package = $this->Package_model->cepackage($id_package);
						$p = $package[0];

						$produits = $this->Produit_model->produit_package($id_package);
						$nombre = count($produits);

					 ?>
					<a href="<?php echo base_url() ?>index.php/magasin/mes_packages"><span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span>  </a><titre><b><?php echo $p['nom_p']."</b> <i class='hidden-xs'>(".$nombre." fichiers ) </i>"  ?></titre>
					<div class="row">
						<div class="info-produit alert alert-info">
							Dans ce dossier <b><?php echo $p['nom_p'] ?></b>, vous pouvez ajouter plusieurs fichiers différents. 
						</div>
						<div class="col-md-8" id="corps_produit_package">
							<br>
							<?php 
							if(!$nombre){
							?>
							<div class="well well-lg holder_text">
								Ce dossier est vide.
								<br>
								Vous pouvez ajouter gratuitement des fichiers dans ce dossier.
							</div>
							<?php
							}
								//var_dump($produits);
								
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

								$saryeto = "holder.jpg";

								?>
									<div  class="col-sm-6 col-md-6">
										<div title="<?php echo $produits[$j]['lien_p'] ?>" class="thumbnail" align="center">
										<?php //IF IMAGE
											if ((strrpos($produits[$j]['lien_p'],".jpg")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".png")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".bmp")== (strlen($produits[$j]['lien_p'])-4)) ) {
										?>
										<img controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>" class="" style="height: 150px; width: auto; ">
										<?php
											}//END IF IMAGE Debut VIDEO AUDIO
											elseif ((strrpos($produits[$j]['lien_p'],".avi")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".mp4")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".flv")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".vob")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".wmv")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".3gp")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".ogg")== (strlen($produits[$j]['lien_p'])-4)) ||(strrpos($produits[$j]['lien_p'],".wma")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".mp3")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".kar")== (strlen($produits[$j]['lien_p'])-4)) ) {
										?>
										<video controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>" alt="télécharger" class="" style="height: 150px; width: auto; "></video>
										<?php
											}//ENDIF VIDEO DOCUMENTS
											elseif ((strrpos($produits[$j]['lien_p'],".pdf")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".doc")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".docx")== (strlen($produits[$j]['lien_p'])-5)) || (strrpos($produits[$j]['lien_p'],".ppt")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".pptx")== (strlen($produits[$j]['lien_p'])-5)) || (strrpos($produits[$j]['lien_p'],".xls")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".xlsx")== (strlen($produits[$j]['lien_p'])-5)) ||(strrpos($produits[$j]['lien_p'],".rtf")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".txt")== (strlen($produits[$j]['lien_p'])-4)) ) {
											?>
											<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/doc.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
											<?php
												}//ENDIF DOCUMENTS ZIP RAR
												elseif ((strrpos($produits[$j]['lien_p'],".rar")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".tar")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".zip")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".77z")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".gz")== (strlen($produits[$j]['lien_p'])-3)) ) {
												?>
												<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/rar.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
												<?php
													}//ENDIF DOCUMENTS  AUTRE
													else
													{
												?>
												<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/autre.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
												<?php
													}//ENDIF AUTRE 
												?>
											<div class="caption">
												<div style="margin-top: 23px;" class="input-group-btn">
													
													<!--a href="<?php echo base_url() ?>index.php/produit/upd/<?php echo $produits[$j]['id_produit'] ?>" class="btn btn-xs btn-warning type="button">modifier</a-->
													<a href="<?php echo base_url() ?>index.php/produit/del/<?php echo $id_package ?>/<?php echo $produits[$j]['id_produit'] ?>" class="btn btn-xs btn-danger">supprimer</a>

													<a href="<?php echo base_url() ?>index.php/produit/download/<?php echo $id_package ?>/<?php echo urlencode($produits[$j]['lien_p']) ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-download"></span> </a>
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
						<div class="formulaire col-md-4" style="padding: 20px;border: solid 3px #de8e8e;">
							<br>
							<b style="color: #de8e8e">AJOUTER VOS FICHIERS ICI</b>
							<hr>
							<?php 
							//POUR MODIF
								$prod_upd = $this->Produit_model->ceproduit($id_produit);
							?>
							<form id="upload_produit_package" enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>index.php/produit/insert">
								<input type="hidden" name="id_package_p" value="<?php echo $id_package ?>">
								<input type="hidden" name="id_produit" value="<?php echo $id_produit ?>">
								<?php if (empty($id_produit)) { //SI PAS MODIF ?>
								
								<label>Ajouter votre fichier dans ce dossier  <required>*</required> :</label> La taille max du fichier est de 125 M
								<input style=" " type='file' id="lien_p" name="lien_p" />

								<?php } ?>

								<!--label>Nom du fichier / Titre <required>*</required> :</label-->
								<input class="form-control" type="hidden" id="nom_p" name="nom_p" value="<?php echo $prod_upd[0]['nom_p'] ?>" >
								<br>
								<input type="submit" class="btn btn-<?php echo (empty($id_produit)) ? 'success' : 'warning' ?>" value="<?php echo (empty($id_produit)) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
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
	<?php $this->load->view('template/footer'); ?>
</body>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/produit.min.js" ></script>
</html>
