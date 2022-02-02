<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/footer.min.css">
<a class="hidden-md hidden-lg" href="<?php echo base_url()?>article/panier">
	<div class="panier_mobile">
	<span class="glyphicon glyphicon-shopping-cart"></span>  <span class="badge count_panier" id=""><?php echo empty($_SESSION['panier']) ? 0 : count($_SESSION['panier']) ?></span>
	</div>
</a>
<div class="pied row" style="padding: 25px;background-color: #ccc;font-weight: 100">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<ul><b>MARKETINONA :</b> 
				<li>Solution pour les ventes à distance</li>
				<li>Produits conformes à la commande</li>
				<li>Paiement des impôts</li>
			</ul>
		</div>
		<div class="col-sm-6 col-md-4">
			<ul>
				<b>CONTACT :</b>
				<li>support@marketinona.com</li>
				<li>+261 34 78 343 34</li>
			</ul>
		</div>
		<div class="col-sm-6 col-md-4">
		</div>
		
	</div>
	 <div class="row" style="margin-top: 40px;margin-bottom: 40px;">
	 	<div class="col-md-6" align="left" style="padding-left: 40px"> <span class="glyphicon glyphicon-copyright-mark"></span> marketinona 2021
		</div>
		<div class="col-md-6 " align="center">
			<h4> Suivez-nous sur facebook:</h4>
			<a href="https://www.facebook.com/marketinona" target="_blank" class="lien_social"><img src="<?php echo base_url(); ?>assets/images/social/fb.png" class="img_social"></a>
			<!-- TWEET -->
			<!--a href="https://twitter.com/rjsolofoniaina" target="_blank" class="lien_social"><img src="<?php echo base_url(); ?>assets/images/social/1.png" class="img_social"></a>
			<!-- IN -->
			<!--a href="https://www.linkedin.com/company/init-mg/" target="_blank" class="lien_social"><img src="<?php echo base_url(); ?>assets/images/social/4.png" class="img_social"></a>
			<!-- INSTAGRAM -->
			<!--a href="https://www.linkedin.com/in/cnam-madagascar-292729193/" target="_blank" class="lien_social"><img src="<?php echo base_url(); ?>assets/images/social/3.png" class="img_social"></a-->
		</div>
	 </div>
</div>