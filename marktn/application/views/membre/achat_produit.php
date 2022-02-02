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

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
	<?php $this->load->view('template/header') ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/article.min.css">
	<script src="<?php echo base_url() ?>assets/js/modernAlert.min.js"></script>
	<script type="text/javascript">
		modernAlert();
	</script>

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
					<titre>Mes commandes :</titre>
					<BR><br>
						<?php
						$achat = $this->Vente_model->achat_membre_article($id_membre);
						$somme = 0;
							foreach ($achat as $key => $pack) {
								//Localisation produit
								
								$dep 	= $this->Package_model->get_localisation($pack['id_package_v']);
								$frais = $this->Parametres_model->select_val($dep,$pack['id_agence']);
						?>

						<div class="row achat attente">
							<div class="col-md-6 produit">
								<h4><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo strtoupper($pack['nom_p']) ?></h4>
								<table class="table-bordered">
									<tr>
										<td>Date</td>
										<td><h5> : <?php echo $pack['date_v'] ?></h5></td>
									</tr>
									<tr>
										<td>Prix unitaire</td>
										<td><h5> : <?php echo $pack['prix_v'] ?> Ar</h5></td>
									</tr>
									<tr>
										<td>Quantité</td>
										<td><h5> : <?php echo $pack['nombre_v'] ?> Ar</h5></td>
									</tr>
									<tr>
										<td>Total</td>
										<td><h5> : <?php echo $montant = $pack['prix_v'] * $pack['nombre_v'] ?> Ar</h5></td>
									</tr>
									<tr>
										<td>Frais</td>
										<td><h5> : <?php echo $pack['frais_v'] ?> Ar</h5></td>
									</tr>
									<tr>
										<td>Total à payer</td>
										<td><h4> : <?php echo $fit = $montant + $pack['frais_v'] ?> Ar</h4></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
									</tr>
								</table>
								<div style="margin-top: 10px ">
									<?php $imgs = $this->Details_vente_model->details_achat_package_membre($id_membre, $pack['id_package_v'], $pack['date_v']);
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
								<h5>Destination : 
								<b>
									<?php 
									if ($pack['paye_v'] == 0) { 
									?>
									<a href="<?php echo base_url() ?>achat/carte?v=<?php echo  $pack['id_vente'] ?>&a=<?php echo  $pack['id_agence'] ?>"><?php echo  $pack['nom_a'] ?></a>
									<?php }else echo  $pack['nom_a'] ?>
								</b></h5>
							</div>
							<div class="col-md-6 vendeur">
								<?php
								$etat_paiement = "";
								$etat_livraison = "";
								$etat_reception = "";

								 if ($pack['paye_v'] == 1) { 
								 	$etat_paiement = "ok";

								 	?>
								
									<h3><span class="glyphicon glyphicon-user"></span> Vendeur</h3>
									<h5>Nom : <b><?php echo $pack['nom_m']. " " . $pack['prenom_m'] ?></b></h5>
									<h5>Tél : <b><?php echo $pack['telephone_m'] ?><b></h5>
									<h5>E-mail : <b><?php echo $pack['email_m'] ?></b></h5>
									<h5>Adresse : <b><?php echo $pack['adresse_m'] ?></b></h5>
									<?php if ($pack['livre_v'] == 1) {
									$etat_livraison = "ok";
										if ($pack['recu_v'] == 1) {
											$etat_reception = "ok";
										}
										else 
										{ ?>
										<button id="btn_action_<?php echo $pack['id_vente'] ?>" class="btn btn-warning" onclick="confirm('Efa voarainao marina ve ilay entana ?', 'Fanamafisana', produit_marquer_recu_client, <?php echo $pack['id_vente'] ?>, {ok:'Eny', cancel:'Tsia'});">Commande reçue</button>
									<?php } 
									}elseif ($pack['livre_v'] == 2) {
										$etat_livraison = "ko";
									} ?>
								
								<?php } else { ?>
									<h3><span class="glyphicon glyphicon-user"></span> Mode de paiement</h3>
									<h5><i>Effectuez le paiement par <b>MVola</b> au numéro suivant. N'oubliez pas la <b>"Description du transfert"</b> pour vérifier votre paiement.</i></h5>
									<br>
									<h5>Numéro : <b>034 78 343 34</b></h5>
									<h5>Au nom de : <b>Solofoniaina Josue<b></h5>
									<h5>Description du transfert : <b><?php echo $pack['id_vente'] ?></b></h5>
									<hr>
									<h4>#111*1*2*<b>0347834334</b>*<?php echo $fit ?>*<b><?php echo $pack['id_vente'] ?></b>#</h4>
								<?php } ?>

							<table class="table table-bordered">
								<tr>
									<td id="commande_paiement_<?php echo $pack['id_vente'] ?>"  class="commande <?php echo $etat_paiement ?>">Payé</td>
									<td id="commande_livraison_<?php echo $pack['id_vente'] ?>"  class="commande <?php echo $etat_livraison ?>">Vérifié</td>
									<td id="commande_reception_<?php echo $pack['id_vente'] ?>"  class="commande <?php echo $etat_reception ?>">Reçu </td>
								</tr>
								<tr>
									<td><?php echo ($pack['paye_date_v'] != "0000-00-00") ? $pack['paye_date_v'] : " " ?></td>
									<td><?php echo ($pack['livre_date_v'] != "0000-00-00") ? $pack['livre_date_v'] : " " ?></td>
									<td><?php echo ($pack['recu_date_v'] != "0000-00-00") ? $pack['recu_date_v'] : " " ?></td>
								</tr>
							</table>
								<?php 
								 if ($pack['paye_v'] == 1) { 
								 ?>
									<a class="btn btn-default" href="<?php echo base_url() ?>facture/impr/<?php echo $pack['id_vente'] ?>"><span><img src="<?php echo base_url() ?>assets/images/pdf.png"></span>Télécharger facture</a>
								<?php } ?>
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
	var base_url = "<?php echo base_url() ?>";
	var attente = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
</script>
	<script src="<?php echo base_url() ?>assets/js/membre.min.js" ></script>
	<script src="<?php echo base_url() ?>assets/js/article.min.js" ></script>
</html>