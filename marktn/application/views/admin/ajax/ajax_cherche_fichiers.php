<table class="table table-hover">
	<tr class="danger">
		
		<th></th>
		<th>Nom</th>
		<th>prix</th>
		<th>Details</th>
	</tr>
	<?php
	$package = $this->Admin_model->search_fichier($nom);
	$somme = 0;
		foreach ($package as $key => $pack) {
			$produit = $this->Admin_model->produit_package($pack['id_package']);
	?>
	<tr id="<?php echo $key ?>" class="warning">
		<td><?php echo $key + 1 ?></td>
		<td> <b><?php echo strtoupper($pack['nom_p']). " (" . count($produit) . " fichiers )" ?><b> </td> 
		<td><b><?php echo $pack['prix_p'] ?> MGA</b></td>
		<td><?php echo $pack['description_p'] ?></td>
		<td>
			<?php if ($pack['active_p']) {
			?>
				<button id="btn-suppr-admin<?php echo $key ?>" onclick="supprimer(<?php echo $pack['id_package'] ?>, <?php echo $key ?>)" class="btn btn-success btn-xs">Suppr</button>
			<?php
			}
			?>
		</td>
	</tr>
	<?php 
		foreach ($produit as $key => $prod) 
		{
	?>
		<tr class="tr_<?php echo $key ?>">
			<td></td>
			<TD colspan="4"><a href="<?php echo base_url() ?>index.php/produit/download/<?php echo $pack['id_package'] ?>/<?php echo urlencode($prod['lien_p']) ?>" class="btn btn-xs btn-warning" ><span class="glyphicon glyphicon-download"></span></a> <i><?php echo $prod['lien_p'] ?></i></TD>
			
		</tr>
		<?php  
	} //FIN PROD dans PACK 

} ?>

</table>