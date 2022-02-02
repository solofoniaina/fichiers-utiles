<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="Vous trouvez ici des produits dans toute l'île. Commandez dès maintenant, nous sommes à votre disposition" />
	<meta property="og:url" content="<?php echo base_url() ?>article" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="article | Liste des fichiers à vendre" />
	<meta property="og:description"   content="Vous trouvez ici des produits dans toute l'île. Commandez dès maintenant, nous sommes à votre disposition" />
	<meta property="og:image" content="<?php echo base_url() ?>assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | Produits</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css?2024">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/slide_pub.min.css?2">

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
 	
 	.caption{
 		margin-top: -33px;
 	}
 </style>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<?php if (empty($_SESSION['session_membre'])) { ?>
		<!--div class="presentation row">
			<div class="col-md-2"></div>
			<div class="apropos col-md-8" style="text-align: justify;">
				<h3>Ireo entana amidy</h3>
				Hitanao ato avokoa ireo entana amidy amin'ny faritra maro manerana an'i Madagasikara, azonao atao ny mividy mivantana eto ary raisinao amin'ireo toerana Marketinona amin'ny faritra misy anao ny entana novidinao.

			</div>
			<div class="col-md-2"></div>
		</div-->
		<?php } ?>
		<div class="row section-gris" style="text-align: left;">
			<div class="col-md-5">
				<h3>LES PRODUITS DISPONIBLES</h3>
				<h5>Les produits que vous pouvez acheter directement sur le site.</h5>
			</div>
			<div class="col-md-7" align="right">
				<div style="margin-top: 23px;" class="form form-inline">
					<select style="" id="categorie" class="form-control">
			      		<?php $categorie = $this->Categorie_model->get_categorie();
			      		echo "<option value=''>Catégorie</option>";
							foreach ($categorie as $k => $categ) {
								$selected = "";
								if ($categ['id_categorie'] == $cat) {
									$selected = "selected";
								}
							echo "<option ".$selected." value='".$categ['id_categorie']."'>".$categ['nom_c']."</option>";
							}
						?>
			      	</select>
			      	<select id="etat" class="form-control">
			      		<option <?php echo ($etat == "") ? "selected" : "" ?> value="">Etat</option>
			      		<option <?php echo ($etat == 2) ? "selected" : "" ?> value="2">Neuf</option>
						<option <?php echo ($etat == 1) ? "selected" : "" ?> value="1">Occasion</option>
			      	</select>	
					<input type="text" class="form-control" name="key" id="key" value="<?php echo $s_key ?>" placeholder="Recherche ...">
					<button style="height: 40px;" class="btn btn-default" id="btn_search" onclick="search('<?php echo $id_agence ?>')">Chercher <span class="glyphicon glyphicon-search"></span></button>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="profils row">
				<div class="col-md-2 gauche-sticky">

					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-warning">
					    <div class="panel-heading" role="tab" id="headingOne">
					      <h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Localisation
					        </a>
					      </h4>
					    </div>
					    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					      <div style="padding: 0;" class="panel-body">
					      	<ul>
					      	<?php $localisation = $this->Package_model->getalllocalisation();
							foreach ($localisation as $key => $loca) {
							?>
								<li><a href="<?php echo base_url() ?>article/search?localisation=<?php echo $loca['id_agence'] ?>&key=<?php echo $s_key ?>"><?php echo $loca['nom_a'] ?></a></li>
							<?php
							}
							?>
							<li><a href="<?php echo base_url() ?>article/search?key=<?php echo $s_key ?>">Toerana rehetra</a></li>
							</ul>
					      </div>
					    </div>
					  </div>
					</div>

					<!-- SLIDE PUB CARRE -->
						<div align="center">
							<div class="contener_slideshow">
								<div class="contener_slide">
									<?php 
									$top_prod = $this->Package_model->top_produits(3);
									foreach ($top_prod as $kp => $top) {
										$phot = $this->Produit_model->produit_package($top['id_package']);
									?>
										<div class= "slid_<?php echo $kp+1 ?>">
											
												<a href="<?php echo base_url() ?>article/details/<?php echo $top['id_package'] ?>" onclick="details(<?php echo $top['id_package'] ?>)">
													<img src="<?php echo base_url() ?>assets/files/<?php echo $top['id_package'] ?>/<?php echo $phot[0]['lien_p'] ?>" alt="" class="" style="height: 150px; width: auto; ">
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
													<a href="<?php echo base_url() ?>article/search?cat=<?php echo $top['etat_p'] ?>"><?php echo $soratra ?></a>
													
												</div>
												<div class="titre_pub_carre">
													<?php echo $top['nom_p'] ?>
												</div>





										</div>
									<?php
									} ?>
								</div>
							</div>
						</div>
					<!-- FIN SLIDE PUB CARRE -->

				</div>
				<div class="col-md-10">

					<?php 
					if (empty($s_key) && empty($id_agence) && empty($etat) && empty($cat)) {
						$packages = $this->Package_model->toutpackage_article();
					}
					else
					{
						$packages = $this->Package_model->searchproduit($s_key,$id_agence,$etat,$cat);	
					}
					
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
								<div class="fond-caption"></div>
								<div class="caption">
									<h4><?php echo $packages[$j]['nom_p'] ?></h4>
									<h6>Stock : <?php echo $packages[$j]['stock_p'] ?></h6>
									<a href="<?php echo base_url() ?>article/search?localisation=<?php echo $packages[$j]['localisation_p'] ?>&key="><h5 style=""><?php echo $packages[$j]['nom_a'] ?></h5></a>
									<p><?php echo $packages[$j]['prix_p'] ?> MGA</p>
									<div style="margin-top: 23px;" class="input-group-btn">
										
										<a href="<?php echo base_url() ?>article/details/<?php echo $packages[$j]['id_package'] ?>"  class="btn btn-xs btn-warning type="button" id="bt_details" >Details</a>
										<!--button title="Ajouter au panier" class="btn btn-xs btn-success" onclick="ajouterpanier(<?php echo $packages[$j]['id_package'] ?>)"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter</button-->

										<?php if (!empty($_SESSION['session_superadmin'])) {
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
</script>
	<script src="<?php echo base_url() ?>assets/js/article.min.js" ></script>
<?php if (!empty($_SESSION['session_admin'])) 
{ ?>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?6" ></script>
<?php } ?>

</html>

<!-- Modal -->
<div class="modal fade" id="modalDescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="place_modal_description">
		<div class='modal-body' align="center">
			<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
		</div>
		<div class='modal-footer'>
		<button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
	</div>

      
    </div>
  </div>
</div>
