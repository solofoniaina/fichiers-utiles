<?php
$achat = $this->Admin_model->search_achat_article_paye_livre(1,1,0,$user,$produit);
$somme = 0;
	foreach ($achat as $key => $pack) {
?>

<div class="row achat ok" align="left">
	<div class="col-md-6 produit">
		<h5 style="color: #fff">Réf : <?php echo $pack['id_vente'] ?></h5>
		<h5><span class="glyphicon glyphicon-shopping-cart"></span> <b><?php echo strtoupper($pack['nom_p']) ?></b></h5>
		<h5>Date : 	<?php echo $pack['date_v'] ?></b></h5>
		<h5>PU : <b><?php echo $pack['prix_v'] ?></b></h5>
		<h5>Qté : <b><?php echo $pack['nombre_v'] ?></b></h5>
		<table class="table table-bordered">
			<tr>
				<td class="cell header" colspan="2">Prix</td>
				<td class="cell header">frais</td>
			</tr>
			<tr>
				<td class="cell" colspan="2">
					<?php echo $montant = $pack['prix_v'] * $pack['nombre_v'] ?>
				</td>
				<td class="cell" rowspan="3"><?php echo $pack['frais_v'] ?></td>
			</tr>
			<tr>
				<td class="cell header">Client (<?php echo 100 - $pack['com_appliquee'] ?> %)</td>
				<td class="cell header">Comm. (<?php echo $pack['com_appliquee'] ?> %)</td>
			</tr>
			<tr>
				<td class="cell"><?php echo $cli = $montant * (100 - $pack['com_appliquee']) / 100 ?></td>
				<td class="cell"><?php echo $montant - $cli ?></td>
			</tr>
		</table>
		<div style="margin-top: 10px ">
			<?php $imgs = $this->Details_vente_model->details_achat_package_membre($pack['id_membre_acheteur'], $pack['id_package_v'], $pack['date_v']);
			foreach ($imgs as $key => $images) {
			 //IF IMAGE
					if ((strrpos($images['lien_p'],".jpg")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".png")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".bmp")== (strlen($images['lien_p'])-4)) ) {
				?>
				<img title="<?php echo $images['lien_p'] ?>" controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $pack['id_package_v'] ?>/<?php echo $images['lien_p'] ?>" data-toggle="tooltip" data-placement="bottom" style="width: 120px" class=" img-rounded">
				<?php
					}//END IF IMAGE Debut VIDEO AUDIO
					elseif ((strrpos($images['lien_p'],".avi")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".mp4")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".flv")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".vob")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".wmv")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".3gp")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".ogg")== (strlen($images['lien_p'])-4)) ||(strrpos($images['lien_p'],".wma")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".mp3")== (strlen($images['lien_p'])-4)) || (strrpos($images['lien_p'],".kar")== (strlen($images['lien_p'])-4)) ) {
				?>
				<video controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $images['lien_p'] ?>" alt="télécharger" class="" style="height: auto; width: 50px; "></video>
				<?php
					}
				}
				?>
		</div>
	</div>
	<div class="col-md-6 vendeur">
		<h5><span class="glyphicon glyphicon-user"></span> <u>Vendeur</u></h5>
		<h5>Nom : <b><?php echo $pack['nom_m']. " " . $pack['prenom_m'] ?></b></h5>
		<h5>Tél : <b><?php echo $pack['telephone_m'] ?><b></h5>
		<h5>E-mail : <b><?php echo $pack['email_m'] ?></b></h5>
		<h5>Adresse : <b><?php echo $pack['adresse_m'] ?></b></h5>
		<hr>
		<?php 
		$etat_paiement = "ok";
		$etat_livraison = "ok";
		$etat_reception = "";

		$cet_acheteur = $this->Membre_model->cemembre($pack['id_membre_acheteur']);
		$ach = $cet_acheteur[0];
		?>
		<h5><span class="glyphicon glyphicon-user"></span> <u>Acheteur</u></h5>
		<h5>Nom : <b><?php echo $ach['nom_m']. " " . $ach['prenom_m'] ?></b></h5>
		<h5>Tél : <b><?php echo $ach['telephone_m'] ?><b></h5>
		<?php if ($pack['recu_v'] == 0) {  ?>
			<button id="btn_action_<?php echo $pack['id_vente'] ?>" class="btn btn-default" onclick="produit_marquer_recu(<?php echo $pack['id_vente'] ?>)">Produit reçu</button>
		<?php }else{
			$etat_reception = "ok";
			} ?>

		<table class="table table-bordered">
			<tr>
				<td id="commande_paiement"  class="commande <?php echo $etat_paiement ?>">Payé</td>
				<td id="commande_livraison"  class="commande <?php echo $etat_livraison ?>">Vérifié</td>
				<td id="commande_reception"  class="commande <?php echo $etat_reception ?>">Reçu </td>
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