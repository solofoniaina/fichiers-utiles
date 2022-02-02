<?php 
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];
	$cin1 = (empty($m['cin1'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin1'];
	$cin2 = (empty($m['cin2'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin2'];
	$cin3 = (empty($m['cin3'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin3'];
?>

<div class="panel panel-info">
	<div class="panel-heading" align="left">
		<h3 class="panel-title"><b><?php echo $m['nom_m']." ".$m['prenom_m'] ?> </b>:</h3>
	</div>
	<div class="row panel-body">
		<div class="col-xs-12">
				<img for="cin3" alt="votre photo" id="new-image3" src="<?php echo base_url() ?>assets/<?php echo $cin3 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px" title="Photo">

				<img for="cin1" alt="votre photo" id="new-image1" src="<?php echo base_url() ?>assets/<?php echo $cin1 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px" title="CIN 1">

				<img for="cin2" alt="votre photo" id="new-image2" src="<?php echo base_url() ?>assets/<?php echo $cin2 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px" title="CIN 2">
		</div>
	</div>
</div>
<div align="right" style="padding: 10px">
	<button class="btn btn-warning" data-dismiss="modal" onclick="valider_cin(<?php echo $id_membre ?>)">Valider</button>
	<button class="btn btn-default" data-dismiss="modal">Fermer</button>
</div>
