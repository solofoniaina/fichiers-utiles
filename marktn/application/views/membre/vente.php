<!DOCTYPE html>
<html lang="fr">
<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();
$id_membre = $_SESSION['session_membre']; ?>
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
					<titre>Resumé des ventes :</titre>
					<BR><br>
					<?php 
					$parametres = $this->Admin_model->get_parametres();
		            $p = $parametres[0];
		            ?>
					<table class="table table-hover">
						<tr class="warning">
							
							<th>Date</th>
							<th>Description</th>
							<th>prix sur le site</th>
							<th>Ma part (<?php echo 100 - $p['notre_commission'] ?>%)</th>
						</tr>
						<?php


						$ventes = $this->Vente_model->vente_membre($id_membre);
						$somme = 0;
							foreach ($ventes as $key => $pack) {
								$produit = $this->Details_vente_model->details_achat_package_membre($pack['id_membre_v'], $pack['id_package_v'], $pack['date_v']);
						?>
						<tr class="tr_<?php echo $key ?> success">
							<td> <?php echo $pack['date_v'] ?> </td> 
							<td> <?php echo $pack['nom_p']. " (" . count($produit) . " fichiers )" ?> </td> 
							<td><?php echo $pack['prix_v'] ?> MGA</td>
							<td><?php echo $part = $pack['prix_v'] - ($pack['prix_v'] * $p['notre_commission'] / 100) ?> MGA</td>
						</tr>
						<?php  
						 $somme += $pack['prix_v'];
						 $somme_part += $part;
					} ?>
						<tr>
							<td colspan="2"><b><b><span class="glyphicon glyphicon-plus"></span> TOTAL VENTE</b></td>
							<TD><b><?php echo $somme ?> MGA<b></TD>
							<TD><b><?php echo $somme_part ?> MGA<b></TD>
						</tr>

					</table>
					<div align="center" style="background-color: #f991f4;padding: 6px;margin-bottom: 5px;text-transform: capitalize;">
						<h4><?php echo $lettre->Conversion($somme_part) ?> Ariary - <i><?php echo $soratra->Avadika($somme_part) ?> Ariary</i> </h4>
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
	<script src="<?php echo base_url() ?>assets/js/magasin.min.js" ></script>
</html>