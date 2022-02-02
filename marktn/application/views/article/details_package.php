<!DOCTYPE html>
<html lang="fr">
<?php $package = $this->Package_model->cepackage($id_package);
	$p = $package[0];

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
	<meta property="og:title" content="<?php echo $p['nom_p'] ?>" />
	<meta property="og:description"   content="<?php echo $p['nom_p'] ?> - Disponible sur Marketinona.com, une plateforme en ligne de mise en relation acheteurs et vendeurs à Madagascar, qui permet aux vendeurs d'exposer leurs produits, et aux acheteurs de passer les commandes via le site. Achetez directement sur le site et recevez votre commande chez vous." />

	<meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="<?php echo $p['nom_p'] ?> - Disponible sur Marketinona.com, une plateforme en ligne de mise en relation acheteurs et vendeurs à Madagascar, qui permet aux vendeurs d'exposer leurs produits, et aux acheteurs de passer les commandes via le site. Achetez directement sur le site et recevez votre commande chez vous." />
	
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	<?php echo $p['nom_p'] ?> | Produits dans le magasin de Marketinona</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css?2024">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/slide_pub.min.css?2">

	<script src="<?php echo base_url() ?>assets/js/modernAlert.min.js"></script>
	<script type="text/javascript">
		modernAlert();
	</script>
</head>
 <style type="text/css">
 	.etat_p{
	    height: 24px;
	    width: fit-content;
	    position: relative;
	    top: -148px;
	    left: -62px;
	    transition: all .2s;
	    padding-left: 5px;
	    padding-right: 5px;
 	}
 	.etat_p a{
 		color: #000;
 	}
 	.etat_p.nouveau{
 		background-color: #00edfaba;
 	}
 	.etat_p.occasion{
 		background-color: #f891009c;
 	}
 </style>
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
					<div class="col-md-12"> <!-- DEBUT CONTENU -->
						<h4><a href="<?php echo base_url() ?>article">Produits > </a><b><?php echo $p['nom_p']."</b>"  ?></h4 >
						<h6><i>Catégorie : <a href="<?php echo base_url() ?>article/search?cat=<?php echo $p['categ_p']  ?>"><?php echo $p['nom_c']  ?></a> - Stock : <?php echo $p['stock_p'] ?></i></h6>

						<div class="">
							<button style="border-radius : 6px !important;height: 28px; margin-top: -11px; padding: 0 10px 0 10px;" title="Ajouter au panier" class="btn btn-md btn-success" onclick="prompt('Saisir la quantité à commander', 'Qté disponible :'+<?php echo $p['stock_p'] ?>,ajouterpanier,<?php echo $id_package ?>)"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter au panier</button>
							<div class="fb-share-button" data-href="https://marketinona.com/share/prod/<?php echo $id_package ?>/<?php echo $this->MesFonctions->monId($id_membre) ?>" data-layout="button_count"  data-mobile-iframe="true" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fmarketinona.com%2Fshare%2Fprod%2F<?php echo $id_package ?>%2F<?php echo $this->MesFonctions->monId($id_membre) ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Partager</a></div>

							<hr>
							<input type="hidden" id="stock" value="<?php echo $p['stock_p'] ?>">
							<?php 
						$array = array();
						$array['id_package'] = $id_package;
						$this->load->view('template/images_produit', $array) ?>
						</div>
						<div class="description">
							<?php echo $p['description_p'] ?>
						</div>
					</div> <!-- FIN CONTENu -->
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="row section-gris" style="text-align: left;">
			<div class="col-md-5">
				<h3>A VOIR AUSSI</h3>
				<h5>Des produits qui pourront vous intéresser.</h5>
			</div>
			<div class="col-md-7" align="right">
				<div style="margin-top: 23px;" class="form form-inline">
					<select id="categorie" class="form-control">
			      		<?php $categorie = $this->Categorie_model->get_categorie();
			      		echo "<option value=''>Catégorie</option>";
							foreach ($categorie as $k => $categ) {
							echo "<option value='".$categ['id_categorie']."'>".$categ['nom_c']."</option>";
							}
						?>
			      	</select>
			      	<select id="etat" class="form-control">
			      		<option value="">Etat</option>
			      		<option value="2">Neuf</option>
						<option value="1">Occasion</option>
			      	</select>	
					<input type="text" class="form-control" name="key" id="key" value="" placeholder="Recherche ...">
					<button style="height: 40px;" class="btn btn-default" id="btn_search" onclick="search('')">Chercher <span class="glyphicon glyphicon-search"></span></button>
				</div>
			</div>
		</div>
		<!-- SUGGESTION BY CATEGORIE -->
		<div class="section">
			<div class="profils row">
				<div class="col-md-10">

					<?php 
						$packages = $this->Package_model->suggest_categorie($p['categ_p'],4);
					
					//var_dump($packages);
					$nombre = count($packages);
					$row = intval($nombre / 4);
					if ($nombre % 4) {
						$row += 1;
					}
					$nb = 0;
					$total = 0;
					for ($x=0; $x < $row ; $x++) { 


					 ?>
					<div class="row">
						<?php for ($j=$nb; $j < $nb+4; $j++) { 

							if (empty($packages[$j]['image_p'])) {
								$saryeto = "holder.jpg";
							}
							else
							{
								$saryeto = "membre/".$packages[$j]['id_membre_p']."/".$packages[$j]['image_p'];
							}

							$img = $this->Produit_model->produit_package($packages[$j]['id_package']);

							//if(count($prod))
							{
						?>

						<div id="<?php echo $j ?>"  class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<a href="<?php echo base_url() ?>article/details/<?php echo $packages[$j]['id_package'] ?>" id-produit="<?php echo $packages[$j]['id_package'] ?>" onclick="details(<?php echo $packages[$j]['id_package'] ?>)">
									<img src="<?php echo base_url() ?>assets/files/<?php echo $packages[$j]['id_package'] ?>/<?php echo $img[0]['lien_p'] ?>" alt="" class="" style="height: 150px; width: auto; ">

								</a>
								<?php if($packages[$j]['etat_p'] == 2)
									{
										$etat_class = "nouveau";
										$soratra = "Neuf";
									}
									else
									{
										$etat_class = "occasion";
										$soratra = "Occasion";
									}
								?>
								<div class="etat_p <?php echo $etat_class ?>">										
									<a href="<?php echo base_url() ?>article/search?cat=<?php echo $packages[$j]['etat_p'] ?>"><?php echo $soratra ?></a>
								</div>

								<div class="caption">
									<h4><?php echo $packages[$j]['nom_p'] ?></h4>
									<h6>Stock : <?php echo $packages[$j]['stock_p'] ?></h6>
									<a href="<?php echo base_url() ?>article/search?localisation=<?php echo $packages[$j]['localisation_p'] ?>&key="><h5 style=""><?php echo $packages[$j]['nom_a'] ?></h5></a>
									<p><?php echo $packages[$j]['prix_p'] ?> MGA</p>
									<div style="margin-top: 23px;" class="input-group-btn">
										
										<a href="<?php echo base_url() ?>article/details/<?php echo $packages[$j]['id_package'] ?>"  class="btn btn-xs btn-warning type="button" id="bt_details" >Details</a>
										<!--button title="Ajouter au panier" class="btn btn-xs btn-success" onclick="ajouterpanier(<?php echo $packages[$j]['id_package'] ?>)"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter</button-->

										<?php if (!empty($_SESSION['session_admin'])) {
										?>
											<button id="btn-suppr-admin<?php echo $j ?>" onclick="supprimer(<?php echo $packages[$j]['id_package'] ?>, <?php echo $j ?>)" class="btn btn-danger btn-xs">Suppr[<?php echo $packages[$j]['id_package'] ?>]</button>
										<?php
										}
										?>
									</div>
									
								</div>
							</div>
						</div>
						<?php
						} //FIN IF EXISTE PRODUIT
							if ($j == $nombre-1 ) {
								break;
							}
						}

						$nb += 4; ?>
						
					</div>
					<?php } //ROW ?>
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>

	</div>
	<?php $this->load->view('template/footer'); ?>
</body>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/spiner.min.css">
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
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
	
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
</html>
<!-- STYLE POUR LOADING -->

