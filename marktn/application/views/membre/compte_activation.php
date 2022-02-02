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

	<title>	Activation</title>
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
					<titre>Paiement Abonnement :</titre>
					<BR><br>
					<div align="center" style="background-color: #f5cef3;padding: 37px;margin-bottom: 5px;text-align: justify;">
						<?php  	$parametres = $this->Admin_model->get_parametres();
    							$p = $parametres[0];
    					?>
						<p>
							
							Vous êtes sur le point d'effectuer un paiement d'un abonnement de <b><?php echo $p['droit_inscription'] ?> MGA</b> pour 1 mois par Mvola.<br>
							Votre prochain paiement sera le <?php echo date('d/m/Y', strtotime(date('Y-m-d').' +1 month')) ?> .
							Après le paiement, vous beneficierez toutes les fonctionnalités et avantages de notre plateforme : 
							<ul>
								<li>Vente</li>
								<li>achat avec <b><?php echo $p['gain_membre'] ?> %</b> de réduction</li>
								<li>réception des commissions de <b><?php echo $p['gain_membre'] ?> %</b> sur les partages d'articles</li>
								<li>gain de <b><?php echo $p['notre_commission'] * $p['droit_inscription'] / 100 ?> MGA</b> à chaque abonnement de vos références.</li>
							</ul>
							<br><br>
							Les retraits et paiements sont faits par Mvola, après vérification par le responsable.
							Le minimum de retrait est de <b><?php echo $p['minimum_retrait'] ?> MGA</b>.
						 </p>
					</div>
					<div class="alert alert-info">En appuyant sur ce bouton, vous effectuerez le paiement de l'<b>abonnement de <?php echo $p['droit_inscription'] ?> MGA</b> pour 1 mois;<br>
						<!--a href="<?php echo base_url() ?>Payer/payment_moobipay" class="btn btn-success">Payer par MVola</a-->

						<a href="<?php echo base_url() ?>Payer/payment_mon_num" class="btn btn-success">Payer par MVola</a>
						<?php 	$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
								$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
								$difference = $retrait_now - $p['droit_inscription'];
								if ($difference >= 0) {
								 ?>
								<a href="<?php echo base_url() ?>Payer/payment_mon_compte" class="btn btn-info">Payer par Mon Compte principal</a>
							<?php } ?>
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