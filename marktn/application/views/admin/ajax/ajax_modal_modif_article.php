<?php 
		//POUR MODIF
			$prod_upd = $this->Package_model->cepackage($id_package);
		?>
    	<div class='modal-header'>
    		A propos de votre produit
    	</div>
		<div class='modal-body'>
			<output id="output"></output>
				<input type="hidden" name="id_membre_p" value="<?php echo $_SESSION['session_membre'] ?>">
				<input type="hidden" name="id_package" value="<?php echo $id_package ?>">

				<div class="row">
					<div class="col-xs-6">
						<label>Nom produit <required>*</required>:</label>
						<input class="form-control" type="text" id="nom_p" name="nom_p" value="<?php echo $prod_upd[0]['nom_p'] ?>" required/>
					</div>
					<div class="col-xs-3">
						<label>Prix (MGA) <required>*</required>: </label> 
						<input class="form-control" type="number" id="prix_p" name="prix_p" value="<?php echo $prod_upd[0]['prix_p'] ?>" required/>
					</div>

					<div class="col-xs-3">
						<label>Qté stock :<required>*</required>: </label> 
						<input class="form-control" type="number" id="stock_p" name="stock_p" value="<?php echo $prod_upd[0]['stock_p'] ?>" required/>
					</div>		
					<div class="col-xs-4">
						<label>Localisation : <required>*</required>: </label> 
						<select class="form-control" id="localisation_p" name="localisation_p">
							<?php $localisation = $this->Agence_model->select_all();
							foreach ($localisation as $key => $ag) {
							echo "<option value='".$ag['id_agence']."'>".$ag['nom_a']."</option>";
							}
							?>

							<?php $localisation = $this->Agence_model->select_all();
							foreach ($localisation as $key => $loca) {
								$selection = "";
								if ($loca['id_agence'] == $prod_upd[0]['localisation_p']) {
									$selection = "selected";
								}
							echo "<option $selection value='".$loca['id_agence']."'>".$loca['nom_a']."</option>";
							}
							?>
							
						</select>
					</div>
					<div class="col-xs-4">						
						<label>Catégorie :</label>
						<select id="categ_p" name="categ_p" class="form-control">
							<?php $categ = $this->Categorie_model->get_categorie();
							foreach ($categ as $key => $cat) {
								$selection = "";
								if ($cat['id_categorie'] == $prod_upd[0]['categ_p']) {
									$selection = "selected";
								}
							echo "<option $selection value='".$cat['id_categorie']."'>".$cat['nom_c']."</option>";
							}
							?>
						</select>
					</div>
					<div class="col-xs-4">
						<label>Etat :</label>
						<select id="etat_p" name="etat_p" class="form-control">
							<option <?php echo ($prod_upd[0]['etat_p'] == 2) ? "selected" : "" ?> value="2">Neuf</option>
							<option <?php echo ($prod_upd[0]['etat_p'] == 1) ? "selected" : "" ?> value="1">Occasion</option>
						</select>
					</div>
				</div>
				
				
				<label>Description du produit <required>*</required> :</label><i>Détails du produit</i>
				<textarea class="form-control" id="description_p" name="description_p" onfocus="if (this.value == 'Ajouter une petite description à votre package' || this.value == 'Description') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Ajouter une petite description à votre package';}">
				<?php echo $prod_upd[0]['description_p'] ?>
				</textarea>

		</div>
		<div class='modal-footer'>
			<input type="submit"  class="btn btn-<?php echo (empty($id_package)) ? 'success' : 'warning' ?>" value="<?php echo (empty($id_package)) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
			<button type='button' class='btn btn-default' data-dismiss='modal' >Fermer</button>
		</div>

<script type="text/javascript" src="<?php echo base_url() ?>tiny_mce/tiny_mce.min.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			height: "200px"
		});
	</script>