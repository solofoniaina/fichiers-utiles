<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; 
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];
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
					<!--PDP -->
					<div class="photo-place">
						<img alt="votre photo" id="new-image" src="<?php echo base_url() ?>assets/images/user/user.jpg" class="photo-profil no_image" style="height: 120px;width: 120px;border-radius: 10px">
					</div>
		        		<label class="input affiche" for="input" id="input-label" style="border: 1px dashed #ccc; cursor: pointer; padding: 5px; margin-top: 5px; margin-bottom: 20px">Changer photo</label> <button style="display: none;width: 211px; border: 1px dashed #000; height: 40px;" name="submit_photo" type="submit" id="enreg_photo" class="btn btn-success">ENREGISTRER PHOTO</button>
					<input style="display: none; " type='file' id="input" name="photos" onchange="readURL(this);" />
					<h4><?php echo $m['nom_m'] ?></h4>
					<H4><?php echo $m['prenom_m'] ?></H4>
					<!--sous menu -->
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>RECAPITULATIFS DE VOS COMPTES</titre> (en ARIARY)
							<BR><br>
							<div class="etat alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h5>Parrain : RABIALAHY Solofoniaina (RABL)</h5>
							</div>

							<?php if ($m['active_m']) {
							?>
							<div class="etat alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h5>Compte activé. Dépot : 20 000 MGA</h5>
							</div>
							<?php
							}else{
							?>
							<div class="etat alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h5><strong>Compte desactivé</strong> <a href="<?php echo base_url() ?>index.php/compte/activation" class="btn btn-sm btn-success">Activer maintenant ?</a> </h5>
							</div>
						<?php } ?>
							
					
					<?php
						$total_gain_dispo = 0;
						if ($m['active_m']) {
							 	?>
								
								<table class="table table-bordered">
									<tr>
										<th colspan="2" style="text-align:center">VOS GAINS</th>
									</tr>
									<tr>
										<td>Commission ventes articles par public</td>
										<td>5000 Ar</td>
									</tr>
									<tr>
										<td>Commission ventes articles par referrals</td>
										<td>5000 Ar</td>
									</tr>
									<tr>
										<td>Commission ventes tickets</td>
										<td>40000 Ar</td>
									</tr>
									<TR  class="info">
										<th>TOTAL DE VOS GAINS</th>
										<th>845000</th>
									</TR>
									
									<tr>
										<th colspan="2" style="text-align:center">VOS DEPENSES ET RETRAITS</th>
									</tr>
									<tr>
										<td>Retrait 2021-12-05</td>
										<td>40000 Ar</td>
									</tr>
									<tr>
										<td>Retrait 2021-05-05</td>
										<td>3000 Ar</td>
									</tr>
									<tr>
										<td>Achat article 2021-05-05</td>
										<td>5000 Ar</td>
									</tr>
									<TR  class="danger">
										<th>TOTAL DE VOS DEPENSES</th>
										<th>845000</th>
									</TR>
								</table>
							<?php
					}
					?>
					<div class="resume" style="background-color: #ffa5f8; padding: 32px; font-size: 16px;
}"><b>Somme disponible (MGA) : <?php echo $total_gain_dispo * 4000 ?></b>
						<br>
						L'administrateur fera la vérification avant le transfert d'argent vers votre compte Mobile Money.
				        <button class="btn btn-md btn-success" href="<?php echo base_url() ?>index.php/connexion">Retirer</button>
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
</html>