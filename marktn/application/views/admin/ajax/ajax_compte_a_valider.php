<?php 
	$demande = $this->Membre_model->select_by_ref_paiement($code_paiement_m);
	if (count($demande)) {
?>
<BR><br>
<table class="table table-bordered">
	<tr>
		<th>REF PAIEMENT</th>
		<th>Nom</th>
		<th>Prénoms</th>
		<th>Login</td>
	</tr>
	<?php
		foreach ($demande as $key => $value) {
	?>
	<tr class="tr_1_<?php echo $value['id_membre'] ?>">
		<td><H3 style="margin-top: 0px; margin-bottom: 0; color:#9b1e60"><?php echo $value['code_paiement_m'] ?></H3></td> <td><?php echo $value['nom_m'] ?></td>
		<td><?php echo $value['prenom_m'] ?></td>
		<td><?php echo $value['login_m'] ?></td>
		<td><button class="btn btn-default" onclick="approuver('1','<?php echo $value['id_membre'] ?>')">Approuver</button></td>
	</tr>
	<?php } ?>
</table>
<?php
	}
	else
	{
?>
	<div class="alert alert-warning"> 
		Désolé, la référence de paiement est introuvable.
	</div>
<?php
	}
?>