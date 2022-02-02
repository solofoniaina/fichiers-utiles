<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; 
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];
?>
<head>
<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Compte</title>
<?php $this->load->view('template/header') ?>

</head>
<style type="text/css">
	.box{
    border-radius: 15px;
    color: #fff;
    padding-top: 15px;
    padding-left: 28px;
    border: solid 6px #fff;
	}
	.box1{
		background-color: #7d00ff;
	}
	.box2{
		background-color: #dc00ff;
	}
	.box3{
		background-color: #229201;
	}
	.box4{
		background-color: #168492;
	}
	.box5{
		background-color: #4143d6;
	}
	.box6{
		background-color: #cd4343;
	}
	.box7{
		background-color: #006eff;
	}
</style>
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
					<titre class="hidden-xs">RESUME</titre>
							<BR><br>
							
						<?php
						$parametres = $this->Admin_model->get_parametres();
            			$p = $parametres[0];
            				
						$total_gain_dispo = 0;
						$total_comm = $this->MesFonctions->total_gain($id_membre);
						 ?>
								
								<table class="hidden-xs hidden-sm table table-bordered">
									<tr>
										<th colspan="2" style="text-align:center">VOS GAINS</th>
									</tr>
									<tr>
										<td>Ventes de vos articles ( <?php echo 100 - $p['notre_commission'] ?> %)</td>
										<td style="text-align: right;"><?php echo $vente_dir = $this->MesFonctions->gain_vente_directe($id_membre) ?> MGA</td>
									</tr>
									<tr>
										<td>Commission ventes</td>
										<td style="text-align: right;"><?php echo $comventes = $this->MesFonctions->gain_vente_membre($id_membre) ?> MGA</td>
									</tr>
									<tr>
										<td>Reduction sur achats  ( <?php echo $p['gain_public'] ?> %)</td>
										<td style="text-align: right;"><?php echo $achat = $this->MesFonctions->gain_reduction($id_membre) ?> MGA</td>
									</tr>
									
									<TR  class="info">
										<th>TOTAL DE VOS GAINS</th>
										<th style="text-align: right;"><?php echo $total_comm ?> MGA</th>
									</TR>
								</table>
								<table class="hidden-xs hidden-sm table">
									
									<tr>
										<th colspan="3" style="text-align:center">HISTORIQUES DE RETRAITS</th>
									</tr>
									<?php $retraits = $this->Retrait_model->retrait_membre($id_membre);
									$total_retrait = 0;
									foreach ($retraits as $key => $r) {
										$total_retrait += $r['valeur_d'];
									?>
									<tr>
										<td><?php echo $r['date_paiement_d'] ?></td>
										<td>Numero :<?php echo $r['numero_d'] ?></td>
										<td style="text-align: right;"><?php echo $r['valeur_d'] ?> MGA</td>
										
									</tr>
									<?php } ?>
									<TR  class="danger">
										<th>TOTAL DE VOS RETRAITS</th>
										<th></th>
										<th  style="text-align: right;"><?php echo $total_retrait ?> MGA </th>
									</TR>
								</table>
<!-- BOX POUR MOBILE -->
								<div class="hidden-md hidden-lg row">
									<div class="box box1 col-xs-6">
										Ventes
										<span style="text-align: center">
											<h2><?php echo $vente_dir ?></h2>
										</span>
									</div>
									<div class="box box2 col-xs-6">
										Comm. ventes
										<span style="text-align: center">
											<h2><?php echo $comventes ?></h2>
										</span>
									</div>
									<div class="box box3 col-xs-6">
										5% Achats
										<span style="text-align: center">
											<h2><?php echo $achat ?></h2>
										</span>
									</div>
									<div class="box box4 col-xs-6">
										Comm. références
										<span style="text-align: center">
											<h2><?php echo $invit ?></h2>
										</span>
									</div>
									<div class="box box5 col-xs-6">
										Total gain
										<span style="text-align: center">
											<h2><?php echo $total_comm ?></h2>
										</span>
									</div>
									<div class="box box6 col-xs-6">
										Total retrait
										<span style="text-align: center">
											<h2><?php echo $total_retrait ?></h2>
										</span>
									</div>
									<div class="box box7 col-xs-12">
										Disponible
										<span style="text-align: center">
											<h2><?php echo $retir_encours = $this->MesFonctions->retirable_encours($id_membre, $total_comm); ?></h2>
										</span>
									</div>
								</div>
								<?php
								$retrait_now = $this->MesFonctions->retirable($id_membre, $total_comm);
								 if ($this->Membre_model->est_active($id_membre)) {
								 	$minimum_retr = $p['minimum_retrait'];
								 } 
								 else
								 {
								 	$minimum_retr = $p['minimum_retrait'] * 2;
								 }
									if ($retrait_now >= $minimum_retr) { ?>.
						        		<a class="btn btn-lg btn-success hidden-md hidden-lg" href="<?php echo base_url() ?>retrait">Retirer</a>
						    	<?php 
						    		} 
						    	?>
<!-- FIN BOX POUR MOBILE -->
							<div>
								<img class="hidden-lg hidden-md" style="width: -webkit-fill-available;" src="<?php echo base_url() ?>assets/images/pub/marketinona_gain3.jpg">
							</div>
					<div class="hidden-xs hidden-sm resume" style="background-color: #ffa5f8; padding: 32px; font-size: 16px;
}"><b>Somme disponible pour retrait : <?php echo $retir_encours  ?> MGA </b>
						<br>
						Retrait minimum : <?php echo $p['minimum_retrait'] ?> MGA <b></b><br>
				        <?php if ($retrait_now >= $minimum_retr) { ?>
				        	L'administrateur fera la vérification avant le transfert d'argent vers votre compte Mobile Money.
				        	<a class="btn btn-md btn-success" href="<?php echo base_url() ?>retrait">Retirer</a>
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
</html>