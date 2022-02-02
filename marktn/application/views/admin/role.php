<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Role</title>
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
					<titre>Rôles de l'utilisateur</titre>
					<BR><br>
					<div class="row">
						<div id="result_recherche" class="col-md-8">
							<?php 
								$roles = $this->User_model->get_role()
							?>
							<table class="table table-bordered">
								<tr>
									<th>Rôles</th>
									<th></th>
								</tr>
								<?php 
									foreach ($roles as $key => $r) {

									?>
										<tr>
											<td><?php echo $r['nom_r'] ?></td>
											<td align="center">
												<button onclick="modif_role('<?php echo $r['id_role'] ?>','<?php echo $r['nom_r'] ?>')" class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
												<button onclick="supprimer_role('<?php echo $r['id_role'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
											</td>
										</tr>
									<?php
									}
									?>
							</table>
						</div>
						<div class="col-md-3">
							<div>
								<label>Rôle</label>
								<input class="form-control" type="text" id="nom_r" name="nom_r" required="">
								<input class="form-control" type="hidden" id="id_role" name="id_role" required="">
							</div>
							<br>
							<button onclick="ajouter_role()" class="btn btn-warning" type="button">Enregistrer</button>
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