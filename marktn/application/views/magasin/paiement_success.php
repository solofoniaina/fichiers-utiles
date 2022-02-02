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
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona." />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | Paiement effectué</title>
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
		<input type="hidden" name="id_membre" value="<?php echo $id_membre ?>">
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<!--sous menu -->
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Resumé de votre achat :</titre>
					<BR><br>
					<div align="center" style="background-color: #f991f4;padding: 6px;margin-bottom: 5px;text-transform: capitalize;line-height: 25px;">
						<p>
							Félicitations, <br>
							Votre paiement est effectué avec succès.<br>
							<?php if (!empty($_SESSION['panier_ok'])) { ?>
							Vous pouvez télécharger vos fichiers ci-dessous :
						<?php }
						elseif(!empty($_SESSION['session_membre']))
							{ ?>
							<a class="btn btn-success" href="<?php echo base_url() ?>compte"><span class="glyphicon glyphicon-user"></span> Retour à mon compte</a>
						<?php } ?>
						 </p>
					</div>
				<?php if (!empty($_SESSION['panier_ok'])) { ?>
					<table class="table table-hover">
						<?php
						
							foreach ($_SESSION['panier_ok'] as $key => $id_package) {
								$pack = $this->Package_model->cepackage($id_package);

								$produit = $this->Produit_model->produit_package($id_package);
						?>
						<tr class="tr_<?php echo $key ?>">
							<td colspan="2"> <b><span class="glyphicon glyphicon-plus"></span> <?php echo strtoupper($pack[0]['nom_p']) . " (" . count($produit) . " fichiers)" ?></b> </td> 
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
				<?php } ?>
					<div>
						<!--a href="<?php echo base_url() ?>index.php/achat/payment_mobile" class="btn btn-warning">Tout télécharger</a-->
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