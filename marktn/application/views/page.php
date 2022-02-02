<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:url" content="www.marketinona.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:image" content="assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	marketinona | page</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="assets/css/menu.min.css?201910101">

</head>

<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<img src="<?php echo base_url() ?>assets/images/logo.png" title="logo marketinona" alt="logo marketinona" style="height: 70px">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<!--PDP -->
					<div class="photo-place">
						<img alt="votre photo" id="new-image" src="<?php echo base_url() ?>assets/images/user/user.jpg" class="photo-profil no_image" style="height: 120px;width: 120px;border-radius: 10px">
					</div>
		        		<label class="input affiche" for="input" id="input-label" style="border: 1px dashed #ccc; cursor: pointer; padding: 5px; margin-top: 5px; margin-bottom: 20px">Changer photo</label> <button style="display: none;width: 211px; border: 1px dashed #000; height: 40px;" name="submit_photo" type="submit" id="enreg_photo" class="btn btn-success">ENREGISTRER LE PROJET</button>
					<input style="display: none; " type='file' id="input" name="photos" onchange="readURL(this);" />
					<h4>RABIALAHY</h4>
					<H4>Solofoniaina</H4>
					<!--sous menu -->
					<ul id="menu-accordeon">
					   
					   <li><a href="http://www.frogweb.fr/demos/mdr.html#">Profil</a></li>
					   <li><a href="#">Mon compte</a>
					      <ul>
					         <li><a href="page.html">AGATE</a></li>
					         <li><a href="page.html">TOPAZE</a></li>
					         <li><a href="page.html">BERYL</a></li>
					         <li><a href="page.html">SAPHIR</a></li>
					         <li><a href="page.html">EMERAUDE</a></li>
					         <li><a href="page.html">RUBIS</a></li>
					         <li><a href="page.html">DIAMANT</a></li>
					         <li><a href="page.html">1 ETOILE</a></li>
					         <li><a href="page.html">2 ETOILES</a></li>
					         <li><a href="page.html">3 ETOILES</a></li>
					         <li><a href="page.html">4 ETOILES</a></li>
					         <li><a href="page.html">5 ETOILES</a></li>
					      </ul>
					   </li>
					</ul>
					
				</div>
				<div class="col-md-8" style="overflow: auto;padding-top: 50px">
					<titre>Votre compte sur AGATE</titre> (1€=4000MGA)
					<BR><br>
					<table class="table table-bordered">
						<tr>
							<th>N°</th>
							<th>Date</th>
							<th>Parrain</th>
							<th>AF</td>
							<th>Pied1</th>
							<th>Pied2</th>
							<th>Pied3</th>
							<th>Pied4</th>
							<th>Pied5</th>
							<th>Pied6</th>
							<th>Gain PARRAIN</th>
							<th>en Ariary </th>
							<th>disponible </th>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							<td>DFVG</td>
							<td>GFHF</td>
							<td>GHBD</td>
							
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>

						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>THUI</td>
							<td>5</td>
							<td>KJTR</td>
							<td>FGEE</td>
							<td>RFTG</td>
							<td>QDGV</td>
							<td>FGBC</td>
							
							<td>FGHN</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							
							<td>GFHF</td>
							<td>GHBD</td>
							<td>RFTG</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>THUI</td>
							<td>5</td>
							<td>KJTR</td>
							<td>FGEE</td>
							<td>QDGV</td>
							<td>FGBC</td>
							
							<td>FGHN</td>
							<td>RFTG</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							<td>DFVG</td>
							<td>GFHF</td>
							
							<td>RFTG</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>THUI</td>
							<td>5</td>
							<td>KJTR</td>
							<td>FGEE</td>
							<td>QDGV</td>
							<td>FGBC</td>
							<td>SDFR</td>
							<td>FGHN</td>
							
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							<td>DFVG</td>
							<td>GFHF</td>
							<td>GHBD</td>
							
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>THUI</td>
							<td>5</td>
							<td>KJTR</td>
							<td>FGEE</td>
							<td>QDGV</td>
							<td>FGBC</td>
							
							<td>FGHN</td>
							<td>RFTG</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							
							<td>GFHF</td>
							<td>GHBD</td>
							<td>RFTG</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>THUI</td>
							<td>5</td>
							<td>KJTR</td>
							<td>FGEE</td>
							<td>QDGV</td>
							<td>FGBC</td>
							<td>SDFR</td>
							<td>FGHN</td>
							
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr>
							<td>1</td>
							<td>12/12/2012</td>
							<td>ATXO</td>
							<td>5</td>
							<td>DFER</td>
							<td>RFTG</td>
							<td>GHRTE</td>
							<td>DFVG</td>
							<td>GFHF</td>
							<td>GHBD</td>
							<td>10</td>
							<td>40 000</td>
							<td>20 000</td>
						</tr>
						<tr class="tr_total">
							
							<th colspan="11">TOTAL</th>
							<th>5 700 500</th>
							<th class="total_dispo">2 500 000 </th>
						</tr>
					</table>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
	
</body>
<script type="text/javascript" src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#menu-accordeon>li').click(function(){
        $(this).toggleClass('active');
        $(this).siblings().removeClass('active');
    })   
});
</script>
</html>