<!DOCTYPE html>
<html lang="fr">
<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();
if (empty($_SESSION['session_membre'])) {
	if (empty($_SESSION['session_acheteur'])) {
		$id_membre = "";
	}
	else
	{
		$id_membre = $_SESSION['session_acheteur'];
	}
}
else
{
	$id_membre = $_SESSION['session_membre'];
}
?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona." />
	<meta property="og:url" content="<?php echo base_url() ?>achat/produit" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="Mes produits" />
	<meta property="og:description"   content="marketinona." />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css?201910101">


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
					<?php $this->load->view('template/sous_menu_admin') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<?php $achat = $this->Admin_model->commande_par_agence($id_agence); ?>
					<titre><?php echo count($achat) ?> Commande(s) pour <?php echo $this->Agence_model->id_to_name($id_agence) ?> :</titre>
					<BR><br>
						<?php
						
							foreach ($achat as $key => $pack) {
								if ($pack['paye_v']) {
									if ($pack['livre_v']) {
										$etat = "attente";
									}
									else $etat = "ok";
								}
								else $etat = "nok";
						?>

						<div class="row achat <?php echo $etat ?>">
							<div class="col-md-6 produit">
								<h4 style="color: #fff">Réf : <?php echo $pack['id_vente'] ?></h4>
								<h3><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo strtoupper($pack['nom_p']) ?></h3>
								<h5>Date : <b><?php echo $pack['date_v'] ?></b></h5>
								<h5>Prix unitaire : <b><?php echo $pack['prix_v'] ?> Ariary</b></h5>
								<h5>Quantité : <b><?php echo $pack['nombre_v'] ?></b></h5>
								<h5>Total : <b><?php echo $montant = $pack['prix_v'] * $pack['nombre_v'] ?> Ariary</b></h5>
								<div style="margin-top: 10px ">
									<?php $imgs = $this->Details_vente_model->details_achat_package_membre($pack['id_membre_acheteur'], $pack['id_package_v'], $pack['date_v']);
									foreach ($imgs as $key => $images) {
									 //IF IMAGE
											if ((strrpos($images['lien_p'],".jpg")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".png")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".bmp")== (strlen($images['lien_p'])-4)) ) {
										?>
										<img id="" onclick="apercu_image(<?php echo $pack['id_package_v'] ?>,'<?php echo $images['lien_p'] ?>')"  src="<?php echo base_url() ?>assets/files/<?php echo $pack['id_package_v'] ?>/<?php echo $images['lien_p'] ?>" data-toggle="modal" data-target="#modalapercuimage" style="max-height: 100px;max-width: 100px" class=" img-rounded">
										<?php
											}
										}
										?>
								</div>
							</div>
							<div class="col-md-6 vendeur">
								
								
								<h3><span class="glyphicon glyphicon-user"></span> Vendeur</h3>
								<h5>Nom : <b><?php echo $pack['nom_m']. " " . $pack['prenom_m'] ?></b></h5>
								<h5>Tél : <b><?php echo $pack['telephone_m'] ?><b></h5>
								<h5>E-mail : <b><?php echo $pack['email_m'] ?></b></h5>
								<h5>Adresse : <b><?php echo $pack['adresse_m'] ?></b></h5>
								<hr>
								<?php 
								$etat_paiement = "";
								$etat_livraison = "";
								$etat_reception = "";
								$cet_acheteur = $this->Membre_model->cemembre($pack['id_membre_acheteur']);
								$ach = $cet_acheteur[0];
								?>
								<h3><span class="glyphicon glyphicon-user"></span> Acheteur</h3>
								<h5>Nom : <b><?php echo $ach['nom_m']. " " . $ach['prenom_m'] ?></b></h5>
								<h5>t2L : <b><?php echo $ach['telephone_m'] ?><b></h5>
								<?php if ($pack['paye_v'] == 0) { ?>
									<button id="btn_action_<?php echo $pack['id_vente'] ?>" class="btn btn-warning" onclick="produit_marquer_payer(<?php echo $pack['id_vente'] ?>)">Marquer Payé</button>
								<?php }
								else
								{
									$etat_paiement = "ok";
									if ($pack['livre_v'] == 0) {  ?>
									<button id="btn_action_<?php echo $pack['id_vente'] ?>" class="btn btn-default" onclick="produit_marquer_livrer(<?php echo $pack['id_vente'] ?>)">Valider commande</button>
									<button id="btn_action2_<?php echo $pack['id_vente'] ?>" class="btn btn-danger" onclick="produit_marquer_rejeter(<?php echo $pack['id_vente'] ?>)">Rejeter</button>
								<?php }elseif ($pack['livre_v'] == 1) {
									$etat_livraison = "ok";
									if ($pack['recu_v'] == 1)
									{
										$etat_reception = "ok";
									}
									}
									else
									{
										$etat_livraison = "ko";
									}
								} ?>
								<table class="table table-bordered">
									<tr>
										<td id="commande_paiement_<?php echo $pack['id_vente'] ?>" class="commande <?php echo $etat_paiement ?>">Payé</td>
										<td id="commande_livraison_<?php echo $pack['id_vente'] ?>" class="commande <?php echo $etat_livraison ?>">Vérifié</td>
										<td id="commande_reception_<?php echo $pack['id_vente'] ?>" class="commande <?php echo $etat_reception ?>">Reçu </td>
									</tr>
									<tr>
										<td><?php echo ($pack['paye_date_v'] != "0000-00-00") ? $pack['paye_date_v'] : " " ?></td>
										<td><?php echo ($pack['livre_date_v'] != "0000-00-00") ? $pack['livre_date_v'] : " " ?></td>
										<td><?php echo ($pack['recu_date_v'] != "0000-00-00") ? $pack['recu_date_v'] : " " ?></td>
									</tr>
								</table>
							</div>
							
						</div>

							<?php 
							}
							 ?>
				</div>
				<div class="col-md-1"></div>
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


<script type="text/javascript">
	var base_url = '<?php echo base_url() ?>';
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/article.min.js" ></script>
</html>