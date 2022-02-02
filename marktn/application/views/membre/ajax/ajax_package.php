<br>
<?php $id_membre = $_SESSION['session_membre']; 
$packages = $this->Package_model->package_membre($id_membre);
			//var_dump($packages);
			$nombre = count($packages);

			if(!$nombre){
			?>
			<div class="well well-lg holder_text">
				Ce dossier est vide.
				<br>
				Vous pouvez ajouter gratuitement des fichiers dans ce dossier.
			</div>
			<?php
			}

			$row = intval($nombre / 2);
			if ($nombre % 2) {
				$row += 1;
			}
		$nb = 0;
		$total = 0;
		for ($x=0; $x < $row ; $x++) { 


		 ?>
		<div class="row">
			<?php for ($j=$nb; $j < $nb+2; $j++) { 

				if (empty($packages[$j]['image_p'])) {
					$saryeto = "holder.jpg";
				}
				else
				{
					$saryeto = "membre/".$id_membre."/".$packages[$j]['image_p'];
				}
			?>
				<div  class="col-md-6">
					<div class="thumbnail" align="center">
						<a title="Clic pour Télécharger" href="<?php echo base_url() ?>index.php/magasin/packages/<?php echo $packages[$j]['id_package'] ?>">
							<img src="<?php echo base_url() ?>assets/images/<?php echo $saryeto ?>" alt="télécharger" class="" style="height: 150px; width: auto; opacity:0.5;">
							<img class="hidden-xs img-folder" style="" src="<?php echo base_url() ?>assets/images/folder.PNG" alt="télécharger">
						</a>
						<div class="caption">
							<h4><?php echo $packages[$j]['nom_p'] ?></h4>
							<p><?php echo $packages[$j]['prix_p'] ?> MGA</p>
							<p><?php echo $packages[$j]['description_p'] ?> </p>
							<div style="margin-top: 23px;" class="input-group-btn">
								
								<a href="<?php echo base_url() ?>index.php/package/upd/<?php echo $packages[$j]['id_package'] ?>" class="btn btn-xs btn-warning type="button"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
								<a href="<?php echo base_url() ?>index.php/package/del/<?php echo $packages[$j]['id_package'] ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
								
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php
				if ($j == $nombre-1 ) {
					break;
				}
			}

			$nb += 2; ?>
			
		</div>
		<?php } //ROW ?>