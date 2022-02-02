<!DOCTYPE html>
<html lang="fr">
<?php $package = $this->Package_model->cepackage($id_package);
	$p = $package[0];

	$prod = $this->Produit_model->produit_package($id_package);
	$nombre = count($prod);

	if (empty($p['image_p'])) {
		$saryeto = "logo.png";
	}
	else
	{
		$saryeto = "membre/".$p['id_membre_p']."/".$p['image_p'];
	}

 ?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<meta property="og:locale" content="fr_FR" />
	<meta property="og:url" content="https://marketinona.com/share/prod/<?php echo $id_package ?>/<?php echo $this->MesFonctions->monId($p['id_membre_p']) ?>" />
	<meta property="og:image" content="http://marketinona.com/assets/images/<?php echo $saryeto ?>"/>
	<meta property="og:type" content="article" /> 
	<meta property="og:title" content="<?php echo $p['nom_p']." (".$nombre." fichiers ) "  ?>" />
	<meta property="og:description"   content="<?php echo $p['nom_p'] ?> - Disponible sur Marketinona.com, une plateforme en ligne de mise en relation acheteurs et vendeurs à Madagascar, qui permet aux vendeurs d'exposer leurs produits, et aux acheteurs de passer les commandes via le site. Achetez directement sur le site et recevez votre commande chez vous." />

	<meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="<?php echo $p['nom_p'] ?> - Disponible sur Marketinona.com, une plateforme en ligne de mise en relation acheteurs et vendeurs à Madagascar, qui permet aux vendeurs d'exposer leurs produits, et aux acheteurs de passer les commandes via le site. Achetez directement sur le site et recevez votre commande chez vous." />
	
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<title>	<?php echo $p['nom_p']." (".$nombre." fichiers ) "  ?> | <?php echo $p['description_p'] ?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magasin.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">

</head>

<script type="text/javascript">
	document.location = "<?php echo base_url() ?>magasin/details/<?php echo $id_package ?>";
</script>