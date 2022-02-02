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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une application de vente de fichiers numériques en ligne, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement VanillaPay, la vente et l'achat deviennent plus facile et accessible par tout le monde. Le paiement se fait par mobile money : Mvola, Orange Money, Airtel Money et aussi par un compte VanillaPay. 
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. 
	Vous n'êtes pas obligé de vous inscrire sur le site quand vous achetez des fichiers, mais si vous voulez que les fichiers achetés soient enregistrés dans votre espace membre, vous devez vous inscrire" />
	<meta property="og:url" content="www.marketinona.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une application de vente de fichiers numériques en ligne, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement VanillaPay, la vente et l'achat deviennent plus facile et accessible par tout le monde. Le paiement se fait par mobile money : Mvola, Orange Money, Airtel Money et aussi par un compte VanillaPay. 
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. 
	Vous n'êtes pas obligé de vous inscrire sur le site quand vous achetez des fichiers, mais si vous voulez que les fichiers achetés soient enregistrés dans votre espace membre, vous devez vous inscrire" />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
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
					<?php $this->load->view('template/sous_menu') ?>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					<titre>Mon panier :</titre>
					<BR><br>
					<?php if (count($_SESSION['panier'])) { ?>
					<table class="table table-hover">

						<tr class="warning">
							<th>Description</th>
							<th>prix</th>
						</tr>
						<?php
						$somme = 0;
							foreach ($_SESSION['panier'] as $key => $id_package) {
								$pack = $this->Package_model->cepackage($id_package);
						?>
						<tr class="tr_<?php echo $key ?>">
							<td> <?php echo $pack[0]['nom_p'] ?> </td> 
							<td><?php echo $pack[0]['prix_p'] ?> MGA</td>
							<TD><button class="btn btn-xs btn-danger"  onclick="removepanier(<?php echo $key ?>)"><span class="glyphicon glyphicon-remove"></span> Supprimer</button></TD>
						</tr>
						<?php  
						 $somme += $pack[0]['prix_p'];
					} ?>
						<tr>
							<td><b>TOTAL A PAYER</b></td>
							<TD><b><?php echo $somme ?> MGA<b></TD>
						</tr>
					</table>
					<div align="center" style="background-color: #f991f4;padding: 6px;margin-bottom: 5px;text-transform: capitalize;">
						<h4><?php echo $lettre->Conversion($somme) ?> Ariary - <i><?php echo $soratra->Avadika($somme) ?> Ariary</i> </h4>
					</div>
				<?php }
					else
					{
				?>
					<div class="info-produit alert alert-warning">
						Votre panier est vide, veuillez ajouter des produits. <a class="btn btn-success" href="<?php echo base_url() ?>magasin">Aller au magasin</a>
					</div>
				<?php
					} ?>
					<?php if ($somme > 0) {
						//SI NON CONNECTE
							//if (empty($_SESSION['session_membre'])) {
					 ?>
						<!--form method="POST" action="<?php echo base_url() ?>payer/payment_mobile">
							<div>
								<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalPaiement">Payer avec Moobi Pay</a>
							</div>
							<div class="modal fade" id="modalPaiement" tabindex="-1" role="dialog" aria-labelledby="modalPaiement">
							  <div class="modal-dialog" role="document">
							    <div style="background-color: #a5c9d4;" class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Compléter les informations</h4>
							      </div>
							      <div class="modal-body">
							      	<label>Votre nom <required>*</required></label>
							       	<input class="form-control" type="text" name="nom_acheteur" required/>
							       	<label>Votre adresse e-mail</label>
							       	<input class="form-control" type="email" name="email_acheteur" required/>
							      </div>
							      <div class="modal-footer">
							        <button type="submit" class="btn btn-success">Poursuivre avec Moobi Pay</button>
							      </div>
							    </div>
							  </div>
							</div>
						</form-->
					<?php 
							/*}
							else // MEMBRE CONNECTE => SANS MODAL FA PAIEMENT DIRECT
							{*/
					?>
							<!--a href="<?php echo base_url() ?>payer/payment_mobile" class="btn btn-success">Payer avec Moobi Pay</a>
							<a href="<?php echo base_url() ?>testpayer/payment_mobile" class="btn btn-warning">Tester avec Moobi Pay</a-->		
					<?php
							//}
					?>
						<a href="<?php echo base_url() ?>payer/payment_mobile" class="btn btn-success">Payer par Mvola</a>
					<?php
						} ?>
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