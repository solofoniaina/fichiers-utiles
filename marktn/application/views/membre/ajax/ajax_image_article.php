
<?php $imgs = $this->Produit_model->produit_package($id_package);
	foreach ($imgs as $key => $images) {
		?>
			<img id="" onclick="supprimer_image_produit(<?php echo $images['id_produit'] ?>,<?php echo $id_package ?>)"  src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $images['lien_p'] ?>" data-toggle="tooltip" data-placement="bottom" style="max-height: 100px;max-width: 100px" class="img-rounded img_<?php echo $images['id_produit'] ?>">
		<?php
			}
		?>
		<!-- AJOUTER PHOTOS -->
		<img title="Hanampy sary" src="<?php echo base_url() ?>assets/images/add_image.png" data-placement="bottom" style="max-height: 50px" class="add_img" onclick="charger_modal_image(<?php echo $id_package ?>)"  data-toggle="modal" data-target="#modalupdimage">