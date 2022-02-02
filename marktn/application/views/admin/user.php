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
					<titre>Utilisateurs</titre>
					<BR><br>
					<div class="row">
						<div id="result_recherche" class="col-md-9">
							<?php 
								$user = $this->User_model->get()
							?>
							<table class="table table-bordered">
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Email</th>
									<th>Tél</th>
									<th>Rôles</th>
									<th>Password</th>
								</tr>
								<?php 
									foreach ($user as $key => $u) {
									?>
										<tr>
											<td><?php echo $u['nom_a'] ?></td>
											<td><?php echo $u['prenom_a'] ?></td>
											<td><?php echo $u['login_a'] ?></td>
											<td><?php echo $u['telephone_a'] ?></td>
											<td><?php echo $u['nom_r'] ?></td>
											<td><?php echo $u['password_a'] ?></td>
											<td align="center">
												<button onclick=modif_user("<?php echo $u['nom_a'] ?>","<?php echo $u['prenom_a'] ?>","<?php echo $u['login_a'] ?>","<?php echo $u['telephone_a'] ?>","<?php echo $u['role_a'] ?>","<?php echo $u['password_a'] ?>","<?php echo $u['id_admin'] ?>") class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
												<button onclick="supprimer_user('<?php echo $u['id_admin'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
											</td>
										</tr>
									<?php
									}
									?>
							</table>
						</div>
						<div class="col-md-3">
							<div>
								<label>Nom</label>
								<input class="form-control" type="text" id="nom_a" name="nom_a" required="">
								<input class="form-control" type="hidden" id="id_admin" name="id_admin" required="">
							</div>
							<div>
								<label>Prénom</label>
								<input class="form-control" type="text" id="prenom_a" name="prenom_a" required="">
							</div>
							<div>
								<label>Email</label>
								<input class="form-control" type="text" id="login_a" name="login_a" required="">
							</div>
							<div>
								<label>Téléphone</label>
								<input class="form-control" type="text" id="telephone_a" name="telephone_a" required="">
							</div>
							<div>
								<label>Rôle</label>
								<select class="form-control" id="role_a" name="role_a">
									<?php 
										$roles = $this->User_model->get_role();
										foreach ($roles as $key => $r) {
									?>
									<option value="<?php echo $r['id_role'] ?>"><?php echo $r['nom_r'] ?></option>

								<?php } ?>
								</select>
							</div>
							<div>
								<label>Mot de passe</label>
								<input class="form-control" type="text" id="password_a" name="password_a" required="">
							</div>
							<br>
							<button onclick="ajouter_user()" class="btn btn-warning" type="button">Enregistrer</button>
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