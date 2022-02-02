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
	<meta name="description"   content="marketinona est une plateforme en ligne de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:url" content="www.marketinona.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une plateforme en ligne de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	Panier | Marketinona : site de mise en relation acheteur - vendeur à Madagascar</title>
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
					<titre>Mes produits :</titre>
					<BR><br>
					<?php if (count($_SESSION['panier'])) { ?>
					<table class="table table-hover">

						<tr class="warning">
							<th>Produits</th>
							<th>P.U</th>
							<th>Qté</th>
							<th>Prix</th>
						</tr>
						<?php
						$somme = 0;
						$frais = 0;
							foreach ($_SESSION['panier'] as $key => $package) {
								$pack = $this->Package_model->cepackage($package['id_package']);
						?>
						<tr class="tr_<?php echo $key ?>">
							<td> <?php echo $pack[0]['nom_p'] ?> </td> 
							<td><?php echo $pack[0]['prix_p'] ?> MGA</td>
							<td><?php echo $package['nombre_achat'] ?></td>
							<td><?php echo $s = $pack[0]['prix_p'] * $package['nombre_achat'] ?> MGA</td>
							<TD><button class="btn btn-xs btn-danger"  onclick="removepanier(<?php echo $key ?>)"><span class="glyphicon glyphicon-remove"></span> Supprimer</button></TD>
						</tr>
						<?php  
						 $somme += $s;
					} ?>
						<tr>
							<td colspan="3" align="center"><b>TOTAL</b></td>
							<TD><b><?php echo $somme ?> MGA<b></TD>
						</tr>
					</table>
					<div align="center" style="background-color: #f991f4;padding: 6px;margin-bottom: 5px;text-transform: capitalize;">
						<h4><?php echo $soratra->Avadika($somme) ?> Ariary - <i><?php echo $lettre->Conversion($somme) ?> Ariary</i> </h4>
					</div>
				<?php }
					else
					{
				?>
					<div class="info-produit alert alert-warning">
						Votre panier est vide. <a class="btn btn-success" href="<?php echo base_url() ?>article">Aller au magasin</a>
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
						if (!empty($_SESSION['session_membre']) || !empty($_SESSION['session_acheteur'])) {
					?>
							<a href="<?php echo base_url() ?>achat/produit" type="submit" class="btn btn-success">Valider la commande</a>
					<?php
							}
							else
							{
					?>
						<a data-toggle="modal" data-target="#modalCreation"  class="btn btn-success">Valider la commande</a>
						<?php }
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
	<script src="<?php echo base_url() ?>assets/js/article.min.js" ></script>

<!-- MODAL CREATION -->
<div class="modal fade" id="modalCreation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="place_modal_description">
    	<div class='modal-header'>
    		Mamorona kaonty afahanao manaraka ny <b>komandinao</b>
    	</div>
		<div class='modal-body'>
			<output id="output"></output>
			<form id="form_inscription" method="POST" action="<?php echo base_url() ?>achat/produit">

				<label>Anarana :</label>
				<input type="text" class="form-control" id="nom_m">
				<label>Fanampin'anarana :</label>
				<input type="text" class="form-control" id="prenom_m">
				<label>Laharan'ny finday iantsoana anao :</label>
				<input type="number" class="form-control" id="telephone_m">
				<label>Avereno soratana ny laharan'ny finday :</label>
				<input type="number" class="form-control" id="telephone_m1">

				<label>Mamoròna teny miafina :</label>
				<input type="password" class="form-control" id="password_m">

				<label>Avereno ny teny miafina :</label>
				<input type="password" class="form-control" id="password_m1">
				<input type="hidden" class="form-control" name="id_acheteur" id="id_acheteur">
			</form>
		</div>
		<div class='modal-footer'>
			<button type='button' onclick="inscription_achat()" class='btn btn-success'><b>Tohizana</b></button>
			<button type='button' class='btn btn-info' data-dismiss='modal' data-toggle="modal" data-target="#modalConnexion">Efa manana kaonty</button>
	</div>
      
    </div>
  </div>
</div>

<!-- MODAL CONNEXION -->
<div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="place_modal_description">
    	<div class='modal-header'>
    		Ampidiro ny finday sy ny teny miafina
    	</div>
		<div class='modal-body'>
			<output id="output"></output>
			<form id="form_connexion" method="POST" action="<?php echo base_url() ?>achat/produit">

				<label>Adiresy email na telefaonina :</label>
				<input type="text" class="form-control" id="telephone_m2">

				<label>Teny miafina :</label>
				<input type="password" class="form-control" id="password_m2">

				<input type="hidden" class="form-control" name="id_acheteur" id="id_acheteur">
			</form>
		</div>
		<div class='modal-footer'>
			<button type='button' onclick="connexion_achat()" class='btn btn-success'><b>Tohizana</b></button>
			<button type='button' class='btn btn-info' data-dismiss='modal' data-toggle="modal" data-target="#modalCreation">Tsy manana kaonty</button>
		</div>
    </div>
  </div>
</div>
</html>