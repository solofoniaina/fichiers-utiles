<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="" />
	<meta property="og:url" content="<?php echo base_url() ?>magasin" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="Magasin | Liste des fichiers à vendre" />
	<meta property="og:description"   content="Vous trouvez ici des dossiers à vendre qui contiennent chacun un ou plusieurs fichiers. Un module de cours comprend par exemple 3 fichiers vidéos et 2 fichiers pdfs." />
	<meta property="og:image" content="<?php echo base_url() ?>assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | Magasin</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magasin.min.css?2024">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">

</head>

<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->

		<div class="presentation row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h3>Notre Magasin</h3>
				Vous trouvez ici des paquets (dossiers) qui contiennent chacun un ou plusieurs fichiers. <br> Un module de cours comprend par exemple 3 fichiers vidéos et 2 fichiers pdfs. <br>
				En cliquant sur le bouton "Ajouter", le dossier est ajouté dans votre panier avec tous les fichiers qu'il contient. <br>
				Les prix affichés sont des prix de l'ensemble de fichiers que contiennent les dossiers.
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="row section-gris" style="text-align: left;">
			<div class="col-md-5">
				<h3>LES FICHIERS DISPONIBLES</h3>
				<h5>Les fichiers / dossiers suivants sont téléchargeables directement sur le site après paiement par Mvola</h5>
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
		<div class="section" style=";">
			<div class="profils row">
				<div class="col-md-12">

					<?php 
					if (empty($critere)) {
						$packages = $this->Package_model->toutpackage_avec_prod();
					}
					else
					{
						$packages = $this->Package_model->searchpackage_avec_prod($critere);	
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

							$prod = $this->Produit_model->produit_package($packages[$j]['id_package']);

							//if(count($prod))
							{
						?>

						<div id="<?php echo $j ?>"  class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<a data-toggle="modal" data-target="#modalDescription" id-produit="<?php echo $packages[$j]['id_package'] ?>" onclick="details(<?php echo $packages[$j]['id_package'] ?>)">
									<img src="<?php echo base_url() ?>assets/images/<?php echo $saryeto ?>" alt="Intègre" class="" style="height: 150px; width: auto; ">
								</a>
								<div class="caption">
									<h4><?php echo $packages[$j]['nom_p'] ?></h4>
									<h5><?php echo count($prod) ?> Fichier(s)</h5>
									<p><?php echo $packages[$j]['prix_p'] ?> MGA</p>
									<div style="margin-top: 23px;" class="input-group-btn">
										
										<a href="<?php echo base_url() ?>index.php/magasin/details/<?php echo $packages[$j]['id_package'] ?>"  class="btn btn-xs btn-warning type="button" id="bt_details" >Détails</a>
										<button title="Ajouter au panier" class="btn btn-xs btn-success" onclick="ajouterpanier(<?php echo $packages[$j]['id_package'] ?>)"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter</button>

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
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
<?php if (!empty($_SESSION['session_admin'])) 
{ ?>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?6" ></script>
<?php } ?>

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
  background: #f741a1;
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

<