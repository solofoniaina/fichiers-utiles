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

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Compte principal</titre>
					<?php 
						$parametres = $this->Admin_model->get_parametres();
						$p = $parametres[0];
						
						$ventes = $this->Admin_model->toutvente();
					?>
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th>Description</th>
							<th>Debit</th>
							<th>Crédit</th>
						</tr>
						<?php 
						$plus = 0;
						$moins = 0;
							foreach ($ventes as $key => $v) {

							?>
								<tr>
									<td><?php echo $v['paye_date_v'] ?> - Commande <?php echo $v['nom_p'] ?></td>
									<td></td>
									<td align="right"><?php echo $cmd = $v['prix_v'] + $v['frais_v'] ?></td>
								</tr>
							<?php
							$plus += $cmd;
								if ($v['livre_v'] == 1) {
							?>
									<tr>
										<td><?php echo $v['livre_date_v'] ?> - Paiement vendeur <?php echo $v['nom_p'] ?> (<?php echo $azy = 100 - $v['com_appliquee'] ?> %)</td>
										<td align="right"><?php echo $vendr = $v['prix_v'] * $azy / 100 ?></td>
										<td></td>
									</tr>
							<?php
								}
								elseif($v['livre_v'] == 2)
								{
								?>
									<tr>
										<td><?php echo $v['livre_date_v'] ?> - Retour <?php echo $v['nom_p'] ?> </td>
										<td align="right"><?php echo $vendr = $v['prix_v'] + $v['frais_v'] ?></td>
										<td></td>
									</tr>
								<?php
								}
								$moins += $vendr;
									if (($v['frais_v'] > 0) && $v['recu_v'] ) {
							?>
									<tr>
										<td><?php echo $v['recu_date_v'] ?> - Frais transport <?php echo $v['nom_p'] ?></td>
										<td align="right"><?php echo $v['frais_v'] ?></td>
										<td></td>
									</tr>
							<?php
								$moins += $v['frais_v'];
								}
							}
							?>
								<tr>
									<td class="total" align="center">TOTAL</td>
									<td class="total" align="right"><?php echo $moins ?></td>
									<td class="total" align="right"><?php echo $plus ?></td>
								</tr>

							<?php if (($plus - $moins ) > 0) {
							?>
								<tr>
									<td class="total" align="center">SOLDE</td>
									<td class="total" align="right"></td>
									<td class="total" align="right"><?php echo $plus - $moins ?></td>
								</tr>
							<?php
							}
							else
							{
							?>
								<tr>
									<td class="total" align="center">SOLDE</td>
									<td class="total" align="right"><?php echo $plus - $moins ?></td>
									<td class="total" align="right"></td>
								</tr>
							<?php
							}
							?>
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