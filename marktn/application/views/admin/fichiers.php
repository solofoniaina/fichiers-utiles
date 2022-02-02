<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cybar, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="Cybar." />
	<meta property="og:url" content="www.angelsfraternity.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.angelsfraternity.com" />
	<meta property="og:description"   content="Cybar." />
	<meta property="og:image" content="assets/images/logo.png"/>

	<title>	FICHIERS</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">


</head>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<?php $this->load->view('template/sous_menu_admin') ?>
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Tous les fichiers</titre>
					<br><br>
					<div class="row section_recherche">
						<div class="col-md-6">
							<div style="margin-top: 23px;">
								<input onkeyup="chercher_fichier()" id="search" type="text" class="form-control" name="key" value="" placeholder="Chercher fichier"> 	
							</div>
						</div>
					</div>
					<div id="result_recherche">
						<table class="table table-hover">
							<tr class="danger">
								
								<th></th>
								<th>Nom</th>
								<th>prix</th>
								<th>Details</th>
							</tr>
							<?php
							$package = $this->Admin_model->tout_package();
							$somme = 0;
								foreach ($package as $key => $pack) {
									$produit = $this->Admin_model->produit_package($pack['id_package']);
							?>
							<tr id="<?php echo $key ?>" class="warning">
								<td><?php echo $key + 1 ?></td>
								<td> <b><?php echo strtoupper($pack['nom_p']). " (" . count($produit) . " fichiers )" ?><b> </td> 
								<td><b><?php echo $pack['prix_p'] ?> MGA</b></td>
								<td><?php echo $pack['description_p'] ?></td>
								<td>
									<?php if ($pack['active_p']) {
									?>
										<button id="btn-suppr-admin<?php echo $key ?>" onclick="supprimer(<?php echo $pack['id_package'] ?>, <?php echo $key ?>)" class="btn btn-success btn-xs">Suppr</button>
									<?php
									}
									?>
								</td>
							</tr>
							<?php 
								foreach ($produit as $key => $prod) 
								{
							?>
								<tr class="tr_<?php echo $key ?>">
									<td></td>
									<TD colspan="4"><a href="<?php echo base_url() ?>index.php/produit/download/<?php echo $pack['id_package'] ?>/<?php echo urlencode($prod['lien_p']) ?>" class="btn btn-xs btn-warning" ><span class="glyphicon glyphicon-download"></span></a> <i><?php echo $prod['lien_p'] ?></i></TD>
									
								</tr>
								<?php  
							} //FIN PROD dans PACK 

						} ?>

						</table>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?6" ></script>
</body>
</html>