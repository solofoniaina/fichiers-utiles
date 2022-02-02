<br>
<?php $package = $this->Package_model->cepackage($id_package);
	$p = $package[0];

	$produits = $this->Produit_model->produit_package($id_package);
	$nombre = count($produits);

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

			$saryeto = "holder.jpg";

			?>
				<div  class="col-sm-6 col-md-6">
					<div title="<?php echo $produits[$j]['lien_p'] ?>" class="thumbnail" align="center">
					<?php //IF IMAGE
						if ((strrpos($produits[$j]['lien_p'],".jpg")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".png")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".bmp")== (strlen($produits[$j]['lien_p'])-4)) ) {
					?>
					<img controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>" class="" style="height: 150px; width: auto; ">
					<?php
						}//END IF IMAGE Debut VIDEO AUDIO
						elseif ((strrpos($produits[$j]['lien_p'],".avi")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".mp4")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".flv")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".vob")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".wmv")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".3gp")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".ogg")== (strlen($produits[$j]['lien_p'])-4)) ||(strrpos($produits[$j]['lien_p'],".wma")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".mp3")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".kar")== (strlen($produits[$j]['lien_p'])-4)) ) {
					?>
					<video controls="true" src="<?php echo base_url() ?>assets/files/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>" alt="télécharger" class="" style="height: 150px; width: auto; "></video>
					<?php
						}//ENDIF VIDEO DOCUMENTS
						elseif ((strrpos($produits[$j]['lien_p'],".pdf")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".doc")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".docx")== (strlen($produits[$j]['lien_p'])-5)) || (strrpos($produits[$j]['lien_p'],".ppt")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".pptx")== (strlen($produits[$j]['lien_p'])-5)) || (strrpos($produits[$j]['lien_p'],".xls")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".xlsx")== (strlen($produits[$j]['lien_p'])-5)) ||(strrpos($produits[$j]['lien_p'],".rtf")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".txt")== (strlen($produits[$j]['lien_p'])-4)) ) {
						?>
						<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/doc.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
						<?php
							}//ENDIF DOCUMENTS ZIP RAR
							elseif ((strrpos($produits[$j]['lien_p'],".rar")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".tar")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".zip")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".77z")== (strlen($produits[$j]['lien_p'])-4)) || (strrpos($produits[$j]['lien_p'],".gz")== (strlen($produits[$j]['lien_p'])-3)) ) {
							?>
							<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/rar.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
							<?php
								}//ENDIF DOCUMENTS  AUTRE
								else
								{
							?>
							<a href="<?php echo base_url() ?>index.php/produit/alaivo/<?php echo $id_package ?>/<?php echo $produits[$j]['lien_p'] ?>"><img src="<?php echo base_url() ?>assets/images/autre.PNG" alt="télécharger" class="" style="height: 150px; width: auto; "></a>
							<?php
								}//ENDIF AUTRE 
							?>
						<div class="caption">
							<div style="margin-top: 23px;" class="input-group-btn">
								
								<!--a href="<?php echo base_url() ?>index.php/produit/upd/<?php echo $produits[$j]['id_produit'] ?>" class="btn btn-xs btn-warning type="button">modifier</a-->
								<a href="<?php echo base_url() ?>index.php/produit/del/<?php echo $id_package ?>/<?php echo $produits[$j]['id_produit'] ?>" class="btn btn-xs btn-danger">supprimer</a>
								<a href="<?php echo base_url() ?>index.php/produit/download/<?php echo $id_package ?>/<?php echo urlencode($produits[$j]['lien_p']) ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-download"></span> </a>
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