<?php

$affiche_compte = false;
$id_membre = $_SESSION['session_membre'];

$niveau = $this->Membre_model->niveau($id_membre);
$nom_etape ="";
function nom_etape($etape)
{
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
	return $nom_etape;
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
						<?php
						for ($etape=1; $etape < 13; $etape++) {
						 	if ($this->Membre_model->demande_ok($id_membre,$etape)) {
						 	?>
							<titre>Votre compte <?php echo $nom_etape ?></titre> (1€=4000MGA)
							<BR><br>
							<table class="table table-bordered">
								<tr>
									<th>DESCRIPTION</th>
									<TH>EURO</TH>
									<TH>ARIARY</TH>
								</tr>
								<?php 
									$mes_inscriptions = $this->Membre_model->les_inscriptions($id_membre, $etape);
									$total_gain_parrain = 0;
									$total_dispo = 0;
									foreach ($mes_inscriptions as $key => $insc) {
									$gain_parrain = 0;
											$niveau1 = $this->Membre_model->les_pieds($insc['id_inscription']);
											$nb_pied_1 = count($niveau1);
											switch ($nb_pied_1) {
												case '1':
													$gain_parrain += 2.5;
													$niveau2 = $this->Membre_model->les_pieds($niveau1[0]['id_inscription']);
													$nb_pied_2 = count($niveau2);
													switch ($nb_pied_2) 
													{
														case '1':
															$gain_parrain += 1.25;
															break;
														
														case '2':
															$gain_parrain += 2.5;
															break;
													}
													break;

												case '2':
													$gain_parrain += 5;

													$niveau21 = $this->Membre_model->les_pieds($niveau1[0]['id_inscription']);
													$nb_pied_21 = count($niveau21);

													$niveau22 = $this->Membre_model->les_pieds($niveau1[1]['id_inscription']);
													$nb_pied_22 = count($niveau22);

													switch ($nb_pied_21) 
													{
														case '0':

															switch ($nb_pied_22) {
																
																
																case '1':
																	$gain_parrain += 1.25;
																	break;
																case '2':
																	$gain_parrain += 2.5;
																	break;
															}
															break;
														case '1':
															echo "<td>".$niveau21[0]['login_m']."</td>";
															switch ($nb_pied_22) {
																
																case '1':
																	$gain_parrain += 1.25;
																	break;
																case '2':
																	$gain_parrain += 2.5;
																	break;
															}
															break;
														
														case '2':
															$gain_parrain += 2.5;
															switch ($nb_pied_22) {
																case '1':
																	$gain_parrain += 1.25;
																	break;
																case '2':
																	$gain_parrain += 2.5;
																	break;
															}
															break;
													}
													break;
											}
												$total_gain_parrain += $gain_parrain;
											}
										?>
									</tr>
								<tr>
									<td >Total Gain</td>
									<td><?php echo $total_gain_parrain ?></td>
									<td><?php echo $total_gain_parrain * 4000 ?></td>
								</tr>
								<tr>
									<td >Total droit de réinscriptions</td>
									<td><?php echo $frais = ($mes_inscriptions-1) * frais_inscription($etape); ?></td>
									<td><?php echo $frais * 4000; ?></td>
									<?php $reste = $total_gain_parrain - $frais; ?>
								</tr>
								<?php $mes_inscriptions_suivantes = $this->Membre_model->les_inscriptions($id_membre, $etape+1); 
									if (count($mes_inscriptions_suivantes)) {
								?>
								<tr>
									<td >Inscription sur <?php echo nom_etape($etape + 1) ?></td>
									<td><?php echo $frais_n1 = ($mes_inscriptions-1) * frais_inscription($etape+1); ?></td>
									<td><?php echo $frais_n1 * 4000; ?></td>
									<?php $reste -= $frais_n1; ?>
								</tr>
								<tr class="tr_total">
									<td >Total gain sur <?php echo nom_etape($etape + 1) ?></td>
									<td><?php echo $reste; ?></td>
									<td><?php echo $reste * 4000; ?></td>
								</tr>
								<?php
									}
								?>
							</table>
						<?php
						}
					}
						?>