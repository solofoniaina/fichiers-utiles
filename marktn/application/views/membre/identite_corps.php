<?php 
	$id_membre = $_SESSION['session_membre'];
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];
	$cin1 = (empty($m['cin1'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin1'];
	$cin2 = (empty($m['cin2'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin2'];
	$cin3 = (empty($m['cin3'])) ? "images/holder.jpg" : "identite/" . $id_membre . "/" . $m['cin3'];
?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title"><b>Karapanondro 1</b> : <i>Ampidiro eto ny sarin'ny karapanondronao</i></h3>
	</div>
	<div class="row panel-body">
		<div class="col-xs-6">
			<form enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>identite/updcin1">
				
				<div class="photo-place">
					<img for="cin1" alt="votre photo" id="new-image1" src="<?php echo base_url() ?>assets/<?php echo $cin1 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px">
				</div>
	        	<input style="display: none;" type='file' id="cin1" name="cin1" onchange="readURL1(this);" />
				<br>
				<label class="input affiche btn btn-default" for="cin1" id="cin1-label"><?php echo (empty($m['cin1'])) ? '+ Hampiditra sary' : '+ Hanova sary' ?></label>
				<input id="enreg_photo1" type="submit"  class="btn btn-<?php echo (empty($m['cin'])) ? 'info' : 'warning' ?>" value="<?php echo (empty($m['cin'])) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
			</form>
		</div>
		<div class="col-xs-6">
			<img style="max-height: 160px;opacity: 0.6;margin-right: 10px" src="<?php echo base_url() ?>assets/images/cin1.jpg">
		</div>
	</div>
</div>

<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title"><b>Karapanondro 2</b> : <i>Ampidiro eto ny sarin'ny karapanondronao ambadika</i></h3>
	</div>
	<div class="row panel-body">
		<div class="col-xs-6">
			<form enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>identite/updcin2">
				
				<div class="photo-place">
					<img for="cin2" alt="votre photo" id="new-image2" src="<?php echo base_url() ?>assets/<?php echo $cin2 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px">
				</div>
	        	<input style="display: none;" type='file' id="cin2" name="cin2" onchange="readURL2(this);" />
				<br>
				<label class="cin2 affiche btn btn-default" for="cin2" id="cin2-label"><?php echo (empty($m['cin2'])) ? '+ Hampiditra sary' : '+ Hanova sary' ?></label>
				<input id="enreg_photo2" type="submit"  class="btn btn-<?php echo (empty($m['cin'])) ? 'info' : 'warning' ?>" value="<?php echo (empty($m['cin'])) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
			</form>
		</div>
		<div class="col-xs-6">
			<img style="max-height: 160px;opacity: 0.6;margin-right: 10px" src="<?php echo base_url() ?>assets/images/cin2.jpg">
		</div>
	</div>
</div>

<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title"><b>Ny sarinao mitazona ny karapanondro </b>: <i>Alaivo sary ny tenanao miaraka amin'ny karapanondronao</i></h3>
	</div>
	<div class="row panel-body">
		<div class="col-xs-6">
			<form enctype="multipart/form-data" method="POST" action="<?php echo base_url() ?>identite/updcin3">
				
				<div class="photo-place">
					<img for="cin3" alt="votre photo" id="new-image3" src="<?php echo base_url() ?>assets/<?php echo $cin3 ?>" class="photo-service no_image" style="max-height: 120px;width: auto;border-radius: 2px">
				</div>
	        	<input style="display: none;" type='file' id="cin3" name="cin3" onchange="readURL3(this);" />
				<br>
				<label class="cin3 affiche btn btn-default" for="cin3" id="cin3-label"><?php echo (empty($m['cin3'])) ? '+ Hampiditra sary' : '+ Hanova sary' ?></label>
				<input id="enreg_photo3" type="submit"  class="btn btn-<?php echo (empty($m['cin'])) ? 'info' : 'warning' ?>" value="<?php echo (empty($m['cin'])) ? 'Enregistrer' : 'Enregistrer' ?>" name="submit">
			</form>
		</div>
		<div class="col-xs-6">
			
		</div>
	</div>
</div>