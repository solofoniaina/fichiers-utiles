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
	<meta property="og:description"   content="<?php echo $p['description_p'] ?> - Disponible sur Marketinona.com, une application de vente de fichiers numériques en ligne, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement MVola, la vente et l'achat deviennent plus facile et accessible par tout le monde.
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. " />

	<meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une application de vente de fichiers numériques en ligne à Madagascar, qui permet aux vendeurs d'exposer leurs fichiers, et aux acheteurs de télécharger directement sur le site après le paiement.
	Grace au module de paiement VanillaPay, la vente et l'achat deviennent plus facile et accessible par tout le monde. Le paiement se fait par mobile money : Mvola, Orange Money, Airtel Money et aussi par un compte VanillaPay. 
	Vous pouvez vendre des formations vidéos ou documents numériques (word, excel, pdf,...), des photos et d'autres fichiers. 
	Vous n'êtes pas obligé de vous inscrire sur le site quand vous achetez des fichiers, mais si vous voulez que les fichiers achetés soient enregistrés dans votre espace membre, vous devez vous inscrire" />
	
	
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