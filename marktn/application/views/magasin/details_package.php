<!DOCTYPE html>
<html lang="fr">
<?php $package = $this->Package_model->cepackage($id_package);
	$p = $package[0];

	$prod = $this->Produit_model->produit_package($id_package);
	$nombre = count($prod);

	if (empty($p['image_p'])) {
		$saryeto = "logo.png";
	}
	else
	{
		$saryeto = "membre/".$p['id_membre_p']."/".$p['image_p'];
	}

 ?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<meta property="og:locale" content="fr_FR" />
	<meta property="og:url" content="https://marketinona.com/share/prod/<?php echo $id_package ?>/<?php echo $this->MesFonctions->monId($p['id_membre_p']) ?>" />
	<meta property="og:image" content="http://marketinona.com/assets/images/<?php echo $saryeto ?>"/>
	<meta property="og:type" content="article" /> 
	<meta property="og:title" content="<?php echo $p['nom_p']." (".$nombre." fichiers ) "  ?>" />
	<meta property="og:description"   content="<?php echo $p['description_p'] ?> - Disponible sur Marketinona.com, une application de vente de fichiers numériques en ligne, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement MVola, la vente et l'achat deviennent plus facile et accessible par tout le monde.
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. " />

	<meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une application de vente de fichiers numériques en ligne à Madagascar, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement VanillaPay, la vente et l'achat deviennent plus facile et accessible par tout le monde. Le paiement se fait par mobile money : Mvola, Orange Money, Airtel Money et aussi par un compte VanillaPay. 
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. 
	Vous n'êtes pas obligé de vous inscrire sur le site quand vous achetez des fichiers, mais si vous voulez que les fichiers achetés soient enregistrés dans votre espace membre, vous devez vous inscrire" />
	
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	<?php echo $p['nom_p']." (".$nombre." fichiers ) "  ?> | <?php echo $p['description_p'] ?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magasin.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">

</head>

<body>
	<!-- Facebook sdk -->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v11.0" nonce="eFGNC8qt"></script>


	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->

		<div class="presentation row">
			<div class="col-md-2"></div>
			<div class="col-md-8" style="background-color: #fff; padding: 20px">
				<div class="row">
					<div class="col-md-12">
				<h3><a href="<?php echo base_url() ?>magasin">Magasin > </a><b><?php echo $p['nom_p']."</b> (".$nombre." fichiers ) "  ?></h3>
				<?php foreach ($prod as $key => $produits) {
				?>
					<?php //IF IMAGE
						if ((strrpos($produits['lien_p'],".jpg")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".png")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".bmp")== (strlen($produits['lien_p'])-4)) ) {
					?>
					<img title="<?php echo $produits['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/images/image.PNG" data-toggle="tooltip" data-placement="bottom" class="img-details-package img-rounded">
					<?php
						}//END IF IMAGE Debut VIDEO AUDIO
						elseif ((strrpos($produits['lien_p'],".avi")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".mp4")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".flv")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".vob")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".wmv")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".3gp")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".ogg")== (strlen($produits['lien_p'])-4)) ||(strrpos($produits['lien_p'],".wma")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".mp3")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".kar")== (strlen($produits['lien_p'])-4)) ) {
					?>
					<img title="<?php echo $produits['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/images/video.PNG" data-toggle="tooltip" data-placement="bottom" class="img-details-package img-rounded">
					<?php
						}//ENDIF VIDEO DOCUMENTS
						elseif ((strrpos($produits['lien_p'],".pdf")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".doc")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".docx")== (strlen($produits['lien_p'])-5)) || (strrpos($produits['lien_p'],".ppt")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".pptx")== (strlen($produits['lien_p'])-5)) || (strrpos($produits['lien_p'],".xls")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".xlsx")== (strlen($produits['lien_p'])-5)) ||(strrpos($produits['lien_p'],".rtf")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".txt")== (strlen($produits['lien_p'])-4)) ) {
						?>
						<img title="<?php echo $produits['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/images/doc.PNG" data-toggle="tooltip" data-placement="bottom" class="img-details-package img-rounded">
						<?php
							}//ENDIF DOCUMENTS ZIP RAR
							elseif ((strrpos($produits['lien_p'],".rar")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".tar")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".zip")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".77z")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".gz")== (strlen($produits['lien_p'])-3)) ) {
							?>
							<img title="<?php echo $produits['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/images/rar.PNG" data-toggle="tooltip" data-placement="bottom" class="img-details-package img-rounded">
							<?php
								}//ENDIF DOCUMENTS  AUTRE
								else
								{
							?>
							<img title="<?php echo $produits['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/images/autre.PNG" data-toggle="tooltip" data-placement="bottom" class="img-details-package img-rounded">
							<?php
								}//ENDIF AUTRE 
							?>

				<?php
				} //Fin foreach $prod
				?>
					</div> <!-- FIN CONTENu -->
				</div>
				<div class="description">
					<button title="Ajouter au panier" class="btn btn-md btn-success" onclick="ajouterpanier(<?php echo $id_package ?>)"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter au panier</button>

					<div class="fb-share-button" data-href="https://marketinona.com/share/prod/<?php echo $id_package ?>/<?php echo $this->MesFonctions->monId($id_membre) ?>" data-layout="button_count"  data-mobile-iframe="true" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fmarketinona.com%2Fshare%2Fprod%2F<?php echo $id_package ?>%2F<?php echo $this->MesFonctions->monId($id_membre) ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Partager</a></div>

					<hr>
					<?php echo $p['description_p'] ?>
					<?php if (!empty($_SESSION['session_membre'])) {

					$id_membre = $_SESSION['session_membre']; 
					?>
					<hr>
					Lien de partage : <input style="height: 35px; width: 340px;" type="text" value="<?php echo base_url() ?>share/prod/<?php echo $id_package ?>/<?php echo $this->MesFonctions->monId($id_membre) ?>">
				<?php } ?>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="row section-gris" style="text-align: left;">
			<div class="col-md-5">
				<a class="lien_blanc" href="<?php echo base_url() ?>index.php/magasin">
					<h3>LES FICHIERS DISPONIBLES</h3>
					Retourner à la liste de dossiers / fichiers
				</a>
			</div>
			<div class="col-md-7">
				<form action="<?php echo base_url() ?>index.php/magasin/search">
					<div style="margin-top: 23px;" class="input-group">
						<input type="text" class="form-control" name="key" placeholder="Recherche ...">
						<span class="input-group-btn">
							<button style="height: 40px;" class="btn btn-default" type="submit">Chercher <span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</form>
			</div>
			
		</div>

	</div>
	<?php $this->load->view('template/footer'); ?>
</body>

<!--link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">	
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script-->

</html>
<script type="text/javascript">
	var base_url = '<?php echo base_url() ?>';
	$("._49vh _2pi7").html("Partager ce fichier");
</script>
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>

</html>
<!-- STYLE POUR LOADING -->

