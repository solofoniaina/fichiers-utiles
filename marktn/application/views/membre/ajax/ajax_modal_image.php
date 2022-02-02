<style type="text/css">
/*Ne pas afficher l'icon add image pour le modal*/
	.modal-body .add_img{
		display: none;
	}
</style>
<input type="hidden" id="id_package_p" name="id_package_p" value="<?php echo $id_package ?>">
    	<div class='modal-header'>
    		Cliquer pour supprimer l'image pour supprimer.
    	</div>
		<div class='modal-body'>
			<?php 
			$package = $this->Package_model->cepackage($id_package);
				$p = $package[0];
			 ?>
			 <div id="" class="article_<?php echo $id_package ?>">
			 	<?php
			 		$imgs = $this->Produit_model->produit_package($id_package);
					foreach ($imgs as $key => $images) {
				?>
			 		<img id="" onclick="supprimer_image_produit(<?php echo $images['id_produit'] ?>,<?php echo $id_package ?>)" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $images['lien_p'] ?>" data-toggle="tooltip" data-placement="bottom" style="max-height: 100px;max-width: 100px" class="img-rounded img_<?php echo $images['id_produit'] ?>">
			 <?php } ?>
			 </div>

			 <div style="margin-top: 20px ">
			 	<label style="border: solid 1px; padding: 3px; " class="input affiche btn btn-default" for="input" id="input-label"><span class="glyphicon glyphicon-plus"></span> Ajouter image</label> 
				<div class="photo-place">
					<img for="input" alt="votre photo" id="new-image" src="<?php echo base_url() ?>assets/images/holder.jpg" class="photo-service no_image" style="max-height: 100px;">
				</div>
	        	<input style="display: none;" type='file' id="input" name="lien_p" onchange="readURL(this);" />
			 </div>

		</div>
		<div class='modal-footer'>
			<input type="submit" style="display: none;" id="enreg_photo" class="btn btn-success" value="Enregistrer" name="submit">
			<button type='button' class='btn btn-default' data-dismiss='modal' >Fermer</button>
		</div>