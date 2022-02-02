<?php 
	$prod = $this->Produit_model->produit_package($id_package);
	$nombre = count($prod);
	foreach ($prod as $key => $produits) {
	if ((strrpos($produits['lien_p'],".jpg")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".png")== (strlen($produits['lien_p'])-4)) || (strrpos($produits['lien_p'],".bmp")== (strlen($produits['lien_p'])-4)) ) {
?>
<img class="img_produit img-rounded" title="<?php echo $produits['lien_p'] ?>"  id="" onclick="apercu_image(<?php echo $id_package ?>,'<?php echo $produits['lien_p'] ?>')"  src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $produits['lien_p'] ?>" data-toggle="modal" data-target="#modalapercuimage" style="max-height: 120px;max-width: 200px"  >
<?php
	}
?>

<?php
} //Fin foreach $prod
?>

