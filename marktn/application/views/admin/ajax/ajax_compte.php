<?php
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
	$inscription = $this->Membre_model->toutes_inscriptions($etape);
 	if (count($inscription)) {
 		$sarany = frais_inscription($etape);
 ?>
	<titre>Suivi cotisation sur <?php echo $nom_etape ?></titre> (1€=4000MGA)
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
			<th>Encaissé </th>
		</tr>
		<?php 
			
			$total_gain_parrain = 0;
			$total_dispo = 0;
			foreach ($inscription as $key => $insc) {
			$encaisser = false;
			$gain_parrain = 0;
		?>
			<tr>
				<td><?php echo $key + 1 ?></td>
				<td><?php echo $insc['date_i'] ?></td>
				<td><b><i><?php echo $insc['login_m'] ?></i></b></td>
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
											$encaisser = true;
											break;
									}
									break;
							}
							break;
					}

				?>
				<td><?php echo $gain_parrain ?></td>
				<td><?php echo $gain_parrain * 4000 ?></td>
				<td><?php if ($encaisser) echo $dispo = $gain_parrain * 4000;
						 else $dispo = 0;
				 ?></td>
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