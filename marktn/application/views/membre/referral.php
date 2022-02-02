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
				
					<!--sous menu -->
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Références</titre>
							<BR><br>
							<?php 
							$parr = $this->Membre_model->cemembre($m['id_parrain']);
							
							?>
							<div class="etat alert alert-warning" role="alert">
								<h5><?php if (count($parr)) { echo "Parrain :" . $parr[0]['prenom_m']." ".$parr[0]['nom_m']; } ?>
									
									&nbsp;&nbsp;&nbsp;&nbsp;Mon lien de parrainage : <input style="height: 35px; width: 340px;" type="text" value="<?php echo base_url() ?>share/up/<?php echo $this->MesFonctions->monId($id_membre) ?>">
								</h5>

								<?php  	$parametres = $this->Admin_model->get_parametres();
            							$p = $parametres[0];
            					?>
							</div>

							<?php if (!$m['active_m']) {
							?>
							<div class="etat alert alert-danger" role="alert">
								<h5><strong>Compte gratuit</strong> <a href="<?php echo base_url() ?>compte/activation" class="btn btn-sm btn-success">Passer en Premium ?</a> </h5>
							</div>
							<?php
							}
							?>
							
					
					<?php
						$ref = $this->Membre_model->referral($id_membre);
						 ?>
								
					<table class="table table-bordered">
						<tr>
							<th colspan="3" style="text-align:center">VOS REFERRALS</th>
							<TH>Statut</TH>
						</tr>
						<?php foreach ($ref as $key => $r) { ?>
						<tr>
							<td><?php echo $r['login_m'] ?></td>
							<td "><?php echo $r['email_m'] ?></td>
							<td><?php echo $r['telephone_m'] ?></td>
							<td>
								<?php if ($this->MesFonctions->no_expiree($r['active_m'])) {
								?>
									<label class="label label-xs label-success"><span class="glyphicon glyphicon-briefcase"></span></label>
								<?php
								}
								else
								{
								?>
									<label class="label label-xs label-danger"><span class="glyphicon glyphicon-globe"></label>
								<?php
								} ?>
							</td>
						</tr>
						<?php } ?>
						
					</table>
					<div>
						<img class="hidden-lg hidden-md" style="width: -webkit-fill-available;" src="<?php echo base_url() ?>assets/images/pub/marketinona_gain3.jpg">
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