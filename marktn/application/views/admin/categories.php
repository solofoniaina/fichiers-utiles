<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Catégories produits</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin.min.css">
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

				<div class="col-md-9" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Catégories de produit</titre>
					<BR><br>
					<div class="row">
						<div id="result_recherche" class="col-md-8">
							<?php 
								$categ = $this->Categorie_model->get_categorie()
							?>
							<table class="table table-bordered">
								<?php 
									foreach ($categ as $key => $r) {

									?>
										<tr>
											<td><?php echo $r['nom_c'] ?></td>
											<td align="center">
												<button onclick="modif_categorie('<?php echo $r['id_categorie'] ?>','<?php echo $r['nom_c'] ?>')" class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
												<button onclick="supprimer_categorie('<?php echo $r['id_categorie'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
											</td>
										</tr>
									<?php
									}
									?>
							</table>
						</div>
						<div class="col-md-3">
							<div>
								<label>Catégories</label>
								<input class="form-control" type="text" id="nom_c" name="nom_c" required="">
								<input class="form-control" type="hidden" id="id_categorie" name="id_categorie" required="">
							</div>
							<br>
							<button onclick="ajouter_categorie()" class="btn btn-warning" type="button">Enregistrer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?5" ></script>
</body>
</html>