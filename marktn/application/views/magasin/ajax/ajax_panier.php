<?php 
include('ChiffreEnLettre.php');
include('Isahosoratra.php');
$lettre=new ChiffreEnLettre();
$soratra=new Isahosoratra();
$id_membre = $_SESSION['session_membre']; ?>

<titre>Entana hovidina :</titre>
					<BR><br>
					<?php if (count($_SESSION['panier'])) { ?>
					<table class="table table-hover">

						<tr class="warning">
							<th>Entana hovidina</th>
							<th>vidiny iray</th>
							<th>isa</th>
							<th>vidiny</th>
						</tr>
						<?php
						$somme = 0;
							foreach ($_SESSION['panier'] as $key => $package) {
								$pack = $this->Package_model->cepackage($package['id_package']);
						?>
						<tr class="tr_<?php echo $key ?>">
							<td> <?php echo $pack[0]['nom_p'] ?> </td> 
							<td><?php echo $pack[0]['prix_p'] ?> MGA</td>
							<td><?php echo $package['nombre_achat'] ?></td>
							<td><?php echo $s = $pack[0]['prix_p'] * $package['nombre_achat'] ?> MGA</td>
							<TD><button class="btn btn-xs btn-danger"  onclick="removepanier(<?php echo $key ?>)"><span class="glyphicon glyphicon-remove"></span> Hofafàna</button></TD>
						</tr>
						<?php  
						 $somme += $s;
					} ?>
						<tr>
							<td colspan="3" align="center"><b>FITAMBARANY</b></td>
							<TD><b><?php echo $somme ?> MGA<b></TD>
						</tr>
					</table>
					<div align="center" style="background-color: #f991f4;padding: 6px;margin-bottom: 5px;text-transform: capitalize;">
						<h4><?php echo $soratra->Avadika($somme) ?> Ariary - <i><?php echo $lettre->Conversion($somme) ?> Ariary</i> </h4>
					</div>
				<?php }
					else
					{
				?>
					<div class="info-produit alert alert-warning">
						Tsy mbola nividy ianao. <a class="btn btn-success" href="<?php echo base_url() ?>magasin">Aller au magasin</a>
					</div>
				<?php
					} ?>
					<?php if ($somme > 0) {
						//SI NON CONNECTE
							//if (empty($_SESSION['session_membre'])) {
					 ?>		
					<?php
							//}
					?>
						<a data-toggle="modal" data-target="#modalCreation"  class="btn btn-success">Hotohizana ny fividianana</a>
					<?php
						} ?>