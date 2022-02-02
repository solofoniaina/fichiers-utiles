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
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona." />
	<meta property="og:url" content="www.angelsfraternity.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.jerygasy.com" />
	<meta property="og:description"   content="marketinona." />
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
					<titre>Mes articles achetés :</titre>
					<BR><br>
					<table class="table table-hover">
						<tr class="danger">
							
							<th>Date</th>
							<th>Description</th>
							<th>prix</th>
							<th></th>
						</tr>
						<?php
						$achat = $this->Vente_model->achat_membre($id_membre);
						$somme = 0;
							foreach ($achat as $key => $pack) {
								$produit = $this->Details_vente_model->details_achat_package_membre($id_membre, $pack['id_package_v'], $pack['date_v']);
						?>
						<tr class="tr_<?php echo $key ?> warning">
							<td> <b><?php echo $pack['date_v'] ?></b> </td> 
							<td> <b><?php echo strtoupper($pack['nom_p']). " (" . count($produit) . " fichiers )" ?><b> </td> 
							<td><b><?php echo $pack['prix_v'] ?> MGA</b></td>
						</tr>
						<?php 
							foreach ($produit as $key => $prod) 
							{
						?>
							<tr class="tr_<?php echo $key ?>">
								<TD><a href="<?php echo base_url() ?>index.php/produit/download/<?php echo $id_package ?>/<?php echo urlencode($prod['lien_p']) ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-download"></span> Télécharger</a></TD>
								<td> <i><?php echo $prod['lien_p'] ?></i> </td> 
								
							</tr>
							<?php  
						} //FIN PROD dans PACK 

					} ?>

					</table>
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