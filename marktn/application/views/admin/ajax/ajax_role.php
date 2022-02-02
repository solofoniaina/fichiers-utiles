<?php 
	$roles = $this->User_model->get_role()
?>
<table class="table table-bordered">
	<tr>
		<th>Rôles</th>
		<th></th>
	</tr>
	<?php 
		foreach ($roles as $key => $r) {

		?>
			<tr>
				<td><?php echo $r['nom_r'] ?></td>
				<td align="center">
					<button onclick="modif_role('<?php echo $r['id_role'] ?>','<?php echo $r['nom_r'] ?>')" class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
					<button onclick="supprimer_role('<?php echo $r['id_role'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
				</td>
			</tr>
		<?php
		}
		?>
</table>