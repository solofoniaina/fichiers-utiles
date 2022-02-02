<?php

$affiche_compte = false;
$id_membre = $_SESSION['session_membre'];

$niveau = $this->Membre_model->niveau($id_membre);
$nom_etape ="";
switch ($etape) {
	case '1':
		$nom_etape = "AGATE";
		break;
	case '2':
		$nom_etape = "TOPAZE";
		break;
	case '3':
		$nom_etape = "BERYL";
		break;
	case '4':
		$nom_etape = "SAPHIR";
		break;
	case '5':
		$nom_etape = "EMERAUDE";
		break;
	case '6':
		$nom_etape = "RUBIS";
		break;
	case '7':
		$nom_etape = "DIAMANT";
		break;
	case '8':
		$nom_etape = "1 ETOILE";
		break;
	case '9':
		$nom_etape = "2 ETOILES";
		break;
	case '10':
		$nom_etape = "3 ETOILES";
		break;
	case '11':
		$nom_etape = "4 ETOILES";
		break;
	case '12':
		$nom_etape = "5 ETOILES";
		break;
	
	default:
		$nom_etape = "AGATE";
		break;
}
if ($etape > 1) {
	if ($this->Membre_model->boucle_ok($id_membre, $etape - 1)) {
		$autorise = true;
	}
}
else
{
	$autorise = true;
}


 if ($autorise) {
 	if ($this->Membre_model->demande_ok($id_membre,$etape)) {
 		$sarany = frais_inscription($etape);
 ?>
	<titre>Votre compte <?php echo $nom_etape ?></titre> (1€=4000MGA)
	<BR><br>
	<table class="table table-bordered">
		<tr>
			<th>N°</th>
			<th>Date</th>
			<th>Parrain</th>
			<th>AF</td>
			<th>Pied1</th>
			<th>Pied2</th>
			<th>Pied3</th>
			<th>Pied4</th>
			<th>Pied5</th>
			<th>Pied6</th>
			<th>Gain PARRAIN</th>
			<th>en Ariary </th>
			<th>disponible </th>
		</tr>
		<?php 
			$mes_inscriptions = $this->Membre_model->les_inscriptions($id_membre, $etape);
			$total_gain_parrain = 0;
			$total_dispo = 0;
			foreach ($mes_inscriptions as $key => $insc) {

			$gain_parrain = 0;
		?>
			<tr>
				<td><?php echo $key + 1 ?></td>
				<td><?php echo $insc['date_i'] ?></td>
				<td><b><i>Moi</i></b></td>
				<td><?php echo $sarany ?></td>
				<?php
					$niveau1 = $this->Membre_model->les_pieds($insc['id_inscription']);
					$nb_pied_1 = count($niveau1);
					switch ($nb_pied_1) {
						case '0':
							echo "<td></td><td></td><td></td><td></td><td></td><td></td>";
							break;
						case '1':
							echo "<td>".$niveau1[0]['login_m']."</td>";
							$gain_parrain += $sarany/2;
							$niveau2 = $this->Membre_model->les_pieds($niveau1[0]['id_inscription']);
							$nb_pied_2 = count($niveau2);
							switch ($nb_pied_2) 
							{
								case '0':
									echo "<td></td><td></td><td></td><td></td><td></td>";
									break;
								case '1':
									echo "<td>".$niveau2[0]['login_m']."</td><td></td><td></td><td></td><td></td>";
									$gain_parrain += $sarany/4;
									break;
								
								case '2':
									echo "<td>".$niveau2[0]['login_m']."</td><td>".$niveau2[1]['login_m']."</td><td></td><td></td><td></td>";
									$gain_parrain += $sarany/2;
									break;
							}
							break;

						case '2':
							echo "<td>".$niveau1[0]['login_m']."</td><td>".$niveau1[1]['login_m']."</td>";
							$gain_parrain += $sarany;

							$niveau21 = $this->Membre_model->les_pieds($niveau1[0]['id_inscription']);
							$nb_pied_21 = count($niveau21);

							$niveau22 = $this->Membre_model->les_pieds($niveau1[1]['id_inscription']);
							$nb_pied_22 = count($niveau22);

							switch ($nb_pied_21) 
							{
								case '0':
									echo "";

									switch ($nb_pied_22) {
										case '0':
											echo "<td></td><td></td><td></td><td></td>";
											break;
										
										case '1':
											echo "<td>".$niveau22[0]['login_m']."</td><td></td><td></td><td></td>";
											$gain_parrain += $sarany/4;
											break;
										case '2':
											echo "<td>".$niveau22[0]['login_m']."</td><td>".$niveau22[1]['login_m']."</td><td></td><td></td>";
											$gain_parrain += $sarany/2;
											break;
									}
									break;
								case '1':
									echo "<td>".$niveau21[0]['login_m']."</td>";
									switch ($nb_pied_22) {
										case '0':
											echo "<td></td><td></td><td></td>";
											break;
										
										case '1':
											echo "<td>".$niveau22[0]['login_m']."</td><td></td><td></td>";
											$gain_parrain += $sarany/4;
											break;
										case '2':
											echo "<td>".$niveau22[0]['login_m']."</td><td>".$niveau22[1]['login_m']."</td><td></td>";
											$gain_parrain += $sarany/2;
											break;
									}
									break;
								
								case '2':
									echo "<td>".$niveau21[0]['login_m']."</td><td>".$niveau21[1]['login_m'];
									$gain_parrain += $sarany/2;
									switch ($nb_pied_22) {
										case '0':
											echo "<td></td><td></td><td></td>";
											break;
										
										case '1':
											echo "<td>".$niveau22[0]['login_m']."</td><td></td>";
											$gain_parrain += $sarany/4;
											break;
										case '2':
											echo "<td>".$niveau22[0]['login_m']."</td><td>".$niveau22[1]['login_m']."</td>";
											$gain_parrain += $sarany/2;
											break;
									}
									break;
							}
							break;
					}

				?>
				<td><?php echo $gain_parrain ?></td>
				<td><?php echo $gain_parrain * 4000 ?></td>
				<td><?php echo $dispo = $gain_parrain * 4000 ?></td>
				<?php
				$total_gain_parrain += $gain_parrain;
				$total_dispo += $dispo;
					}
				?>
				
			</tr>
		<tr class="tr_total">
			
			<th colspan="11">TOTAL</th>
			<th><?php echo $total_gain_parrain * 4000 ?></th>
			<th class="total_dispo"><?php echo $total_dispo ?></th>
		</tr>
	</table>
<?php
}
else
{
	if ($etape == "1") {
?>
	<titre>Votre compte <?php echo $nom_etape ?></titre> (1€=4000MGA)
	<BR><br>
	<H4>Pour avoir un compte sur AGATE, vous devez payer le droit d'adhesion de 5€ ou <relief> 20 000 MGA </relief> payable via MVOLA.<br></H4>
	<h4>Transférer l'argent vers le numero ci-dessous, en précisant la référence de votre paiement:</h4>
	<div class="reference_paiement">
		<p><span class="glyphicon glyphicon-qrcode"> </span> Réf paiement : 1597</p>
		<p><span class="glyphicon glyphicon-user"> </span> Déstinataire : 034 00 000 00</p>
		<p><span class="glyphicon glyphicon-euro"> </span> Montant : 20 000 MGA</p>

	</div>
	<div class="alert alert-warning" role="alert">
		La référence de paiement est obligatoire, pour que nous puissons identifier votre adhésion.
	</div>
<?php
	}
	else
	{
	?>
		<titre>Votre compte <?php echo $nom_etape ?></titre> (1€=4000MGA)
		<BR><br>
		<H4>Félicitations<br></H4>
		<h4>Vous pouvez passer au niveau supérieur. Appuyer sur ce bouton pour activer votre compte.</h4>

		<menu class="cl-effect-8" id="cl-effect-8">
	        <button onclick="ouvrir_compte('<?php echo $etape ?>','<?php echo $id_membre ?>')">Activer</button>
		</menu>
		<div class="alert alert-info" role="alert">
			Votre compte sera activé immédiatement.
		</div>

	<?php	
	}
}
}
else
{
?>
	<titre>Votre compte <?php echo $nom_etape ?></titre> (1€=4000MGA)
	<BR><br>
	<H4>Pour avoir un compte <?php echo $nom_etape ?>, vous devez completer 3 boucles sur le compte en cours.</H4>
<?php
	}

function frais_inscription($etape)
{
	switch ($etape) {
		case '1':
			$nom_etape = 5;
			break;
		case '2':
			$nom_etape = 10;
			break;
		case '3':
			$nom_etape = 20;
			break;
		case '4':
			$nom_etape = 25;
			break;
		case '5':
			$nom_etape = 50;
			break;
		case '6':
			$nom_etape = 100;
			break;
		case '7':
			$nom_etape = 200;
			break;
		case '8':
			$nom_etape = 400;
			break;
		case '9':
			$nom_etape = 800;
			break;
		case '10':
			$nom_etape = 1000;
			break;
		case '11':
			$nom_etape = 2000;
			break;
		case '12':
			$nom_etape = 4000;
			break;
		
		default:
			$nom_etape = 10;
			break;
	}
	return $nom_etape;
}
?>