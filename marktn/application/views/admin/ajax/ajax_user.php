<?php 
	$user = $this->User_model->get()
?>
<table class="table table-bordered">
	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Email</th>
		<th>Tél</th>
		<th>Rôles</th>
		<th>Password</th>
	</tr>
	<?php 
		foreach ($user as $key => $u) {
		?>
			<tr>
				<td><?php echo $u['nom_a'] ?></td>
				<td><?php echo $u['prenom_a'] ?></td>
				<td><?php echo $u['login_a'] ?></td>
				<td><?php echo $u['telephone_a'] ?></td>
				<td><?php echo $u['nom_r'] ?></td>
				<td><?php echo $u['password_a'] ?></td>
				<td align="center">
					<button onclick=modif_user("<?php echo $u['nom_a'] ?>","<?php echo $u['prenom_a'] ?>","<?php echo $u['login_a'] ?>","<?php echo $u['telephone_a'] ?>","<?php echo $u['role_a'] ?>","<?php echo $u['password_a'] ?>","<?php echo $u['id_admin'] ?>") class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
					<button onclick="supprimer_user('<?php echo $u['id_admin'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
				</td>
			</tr>
		<?php
		}
		?>
</table>