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

	<title>	Recapitulatif</title>
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
					
					<titre>Recapitulatif</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];
						$total_prix = 0;
						$nos_gains = 0;
						$ventes_gains = 0;
						$reduction_gain = 0;
						//RETRAITS
						$total_encours = 0;
						$total_ok = 0;

						$ventes = $this->Admin_model->toutvente();
						foreach ($ventes as $key => $v) {
							$total_prix += $v['prix_v'];
							$gains = $this->MesFonctions->nos_commissions($v['id_membre_v'], $v['id_parrain_v'], $v['prix_v'], $p);
							$nos_gains += $gains['nous'];
							$ventes_gains += $gains['parrain'];
							$reduction_gain += $gains['membre'];

						}

						$retrait_no = $this->Admin_model->retrait(0);
						foreach ($retrait_no as $key => $r) {
							$total_encours += $r['valeur_d'];
						}

						$retrait_yes = $this->Admin_model->retrait(1);
						foreach ($retrait_yes as $key => $r) {
							$total_ok += $r['valeur_d'];
						}
					?>
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th colspan="2">Sans Parrain</td>
							<th colspan="2">Avec Parrain</th>
							<th colspan="2">Ventes Réel</th>
							<th>Com. ventes</th>
							<th>Reduction ventes</th>
							<th>Retrait en c</th>
							<th>Retrait OK</th>

							
						</tr>
						<?php
						?>
						<tr class="tr_1_<?php echo $value['id_membre'] ?>">
							<td  colspan="2"><?php echo $sans_parrain = $this->Admin_model->membre_sans_parrain() ?></td>
							<td  colspan="2"><?php echo $avec_parrain = $this->Admin_model->membre_avec_parrain() ?></td>
							<td colspan="2"><?php echo $total_prix ?></td>
							<td><?php echo $ventes_gains ?></td>
							<td><?php echo $reduction_gain ?></td>
							<td><?php echo $retrait_encours = count($retrait_no) ?></td>
							<td><?php echo $retrait_ok = count($retrait_yes) ?></td>
							
						</tr>
						<tr class="info">
							<th style="text-align: right;background-color: #00f948"><?php echo $somme_sp = $sans_parrain * $p['droit_inscription'] ?> MGA</th>
							<th style="text-align: right;background-color: #ec9400"><?php echo $somme_sp_cli = 0 ?> MGA</th>
							<th style="text-align: right;background-color: #00f948"><?php echo $somme_ap = $avec_parrain * ($p['gain_referral'] * 2 * $p['droit_inscription'] / 100) ?> MGA</th>
							<th style="text-align: right;background-color: #ec9400"><?php echo $somme_ap_cli = $avec_parrain * ($p['gain_referral'] * 2 * $p['droit_inscription'] / 100) ?> MGA</th>
							<th style="text-align: right;background-color: #00f948"><?php echo $nos_gains ?> MGA</th>
							<th  style="text-align: center;background-color: #ec9400"><?php echo $gains_cli = $total_prix * (100 - $p['notre_commission']) /100 ?> MGA</th>
							<th colspan="2"  style="text-align: center;background-color: #ec9400"><?php echo $autres_comm = $ventes_gains + $reduction_gain ?> MGA</th>
							<th  style="text-align: center;background-color: ##f57878"><?php echo $total_encours ?> MGA</th>
							<th colspan="2"  style="text-align: center;background-color: ##f57878"><?php echo $total_ok ?> MGA</th>
						</tr>
						<tr class="success">
							<th colspan="3" style="text-align: center;background-color: #00f948">DISP = <?php echo $tout = $somme_sp + $somme_ap + $nos_gains ?> MGA</th>
							<th colspan="5" style="text-align: center;background-color: #ec9400">CLIENT = <?php echo $tout_cli = $somme_sp_cli + $somme_ap_cli + $gains_cli + $autres_comm ?> MGA</th>
							<th colspan="2" style="text-align: center;background-color: ##f57878"><?php echo $tout_retrait = $total_encours + $total_ok ?> MGA</th>
							
						</tr>
						<tr class="danger">
							<th colspan="5" style="text-align: center;background-color: #cccc">CUMUL = <?php echo $cumul = $tout + $tout_cli ?> MGA</th>
							<th colspan="5" style="text-align: center;background-color: #cccc">CAISSE = <?php echo $cumul - $tout_retrait ?> MGA</th>
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