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

	<title>	Cybar | page</title>
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
					
					<titre>Les membres actifs</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];

						$total_droit = 0;
					//Membre_actifs
						$membre = $this->Admin_model->membre(1);
					?>
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th>Date insc</td>
							<th>Nom et Prénoms</th>
							<th>Invest</th>
							<td>Ventes</td>
							<td>Total gain</td>
							<td>Total retrait</td>
							<td>Retirable</td>
							
						</tr>
						<?php
						$invest = 0;
						$vente_total = 0;
						$gain_total = 0;
						$retrait_total = 0;
						$retirable_total = 0;
							foreach ($membre as $key => $m) {
								$total += $d['valeur_d'];
						?>
						<tr class="tr_1_<?php echo $value['id_membre'] ?>">
							<td><?php echo $m['date_m'] ?></td>
							<td><?php echo $m['nom_m']." ".$m['prenom_m'] ?></td>
							<?php if ($m['active_m']) {
								$droit = $p['droit_inscription'];
							}
							else
							{
								$droit = 0;
							}
								$invest += $droit;
							?>
							<td style="text-align: right;"><?php echo $droit ?> MGA</td>
							<td style="text-align: right;"><?php echo $vente = $this->MesFonctions->gain_vente_directe($m['id_membre']) ?> MGA</td>
							<?php $vente_total += $vente ?>
							<td style="text-align: right;"><?php echo $gain = $this->MesFonctions->total_gain($m['id_membre']) ?> MGA</td>
							<?php $gain_total += $gain ?>
							<td style="text-align: right;"><?php echo $retrait = $this->MesFonctions->retrait($m['id_membre']) ?> MGA</td>
							<?php $retrait_total += $retrait ?>
							<td style="text-align: right;"><?php echo $retirable = $gain-$retrait ?> MGA</td>
							<?php $retirable_total += $retirable ?>
						</tr>
						<?php } ?>
						<tr class="info">
							<th>TOTAL</th>
							<th style="text-align: right;"><?php echo count($membre) ?> Membres</th>
							<th style="text-align: right;"><?php echo $invest ?> MGA</th>
							<th style="text-align: right;"><?php echo $vente_total ?> MGA</th>
							<th style="text-align: right;"><?php echo $gain_total ?> MGA</th>
							<th style="text-align: right;"><?php echo $retrait_total ?> MGA</th>
							<th style="text-align: right;"><?php echo $retirable_total ?> MGA</th>
						</tr>
					</table>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?5" ></script>
</body>
</html>