<script src="<?php echo base_url() ?>bootstrap/jquery/1.12.4/jquery.min.js" ></script>
	<script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js" ></script>
<div class="menu">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="padding: 0px" href="#">
					<img alt="Brand" src="<?php echo base_url()?>assets/images/logo.png" class="logo_brand" style="height: 70px">
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url()?>article"><span class="glyphicon glyphicon-credit-card"></span> Produits</a></li>
					<li><a href="<?php echo base_url()?>apropos"><span class="glyphicon glyphicon-info"></span> A propos</a></li>
					<li><a href="<?php echo base_url()?>inscription"><span class="glyphicon glyphicon-info"></span> Inscription</a></li>
					
					<!--li><a href="<?php echo base_url()?>magasin"><span class="glyphicon glyphicon-credit-card"></span> Fichiers</a></li-->
					
					<?php 
					if (empty($_SESSION['session_membre']) && empty($_SESSION['session_acheteur']) && empty($_SESSION['session_admin'])) {
					?>
						<li><a href="<?php echo base_url()?>connexion"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
					<?php }
					else
					{ 
						?>

						<li class="dropdown">
							<a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"><span class="glyphicon glyphicon-user"></span> 
								Compte
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="<?php echo base_url()?>compte"><span class="glyphicon glyphicon-user"></span> Mon compte</a></li>
							<?php //Special compte complet 
							if (!empty($_SESSION['session_membre']) || !empty($_SESSION['session_admin'])) { ?>
								<li><a href="<?php echo base_url() ?>compte/password"><span class="glyphicon glyphicon-lock"></span> Changer mot de passe</a></li>

							<?php } ?>

							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url()?>logout"><span class="glyphicon glyphicon-log-out"></span> Se Déconnecter</a></li>
							</ul>
						</li>
						
					<?php
					}
					?>
					<li class="hidden-xs hidden-sm li-panier"><a style="color:#fff !important;" href="<?php echo base_url()?>article/panier"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge count_panier" id="count_panier"><?php echo empty($_SESSION['panier']) ? 0 : count($_SESSION['panier']) ?></span></a></li>

				</ul>

			</div>
		</div>
	</nav>
</div>