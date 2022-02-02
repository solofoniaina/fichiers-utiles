<table class="table table-hover">
<tr class="danger">
	
	<th></th>
	<th>Nom</th>
	<th>Details</th>
	<th>prix</th>
</tr>
<?php
$package = $this->Validation_model->recherche_user_produit($user, $produit);
$somme = 0;
	foreach ($package as $key => $pack) {
		$produit = $this->Admin_model->produit_package($pack['id_package']);

		$check_ouvert = "";
		if ( $pack['active_p']) {
			$check_ouvert = "checked";
		}
?>
<tr id="<?php echo $key ?>" class="warning">
	<td><?php echo $key + 1 ?></td>
	<td> <b><?php echo strtoupper($pack['nom_p']) ?><b> </td> 
	<td><?php echo $pack['description_p'] ?></td>
	<td><b><?php echo $pack['prix_p'] ?> MGA</b></td>

	<td>
		<input type="checkbox" <?php echo $check_ouvert ?> name="ouvert_<?php echo $ligne_ue->id_ue ?>" id="ouvert_<?php echo $pack['id_package'] ?>">
				
		<label onclick="active('<?php echo $pack["id_package"] ?>')" for="ouvert_<?php echo $pack['id_package'] ?>">
			<span class="ui"></span>
		</label>
	</td>
</tr>
<tr>
	<td colspan="5">
<?php  
	$array = array();
	$array['id_package'] = $pack['id_package'];
	$this->load->view('template/images_produit', $array);
	 //FIN PROD dans PACK 
?>
	</td>
</tr>
<?php } ?>
</table>