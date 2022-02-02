<!DOCTYPE html>
<html lang="fr">
<?php $id_membre = $_SESSION['session_membre']; ?>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cybar, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="Cybar." />
	<meta property="og:url" content="www.angelsfraternity.com" />
	<meta property="og:type" content="Travail, éducation, logement, nouriture, organisation, madagascar, malagasy, société" /> 
	<meta property="og:title" content="www.angelsfraternity.com" />
	<meta property="og:description"   content="Cybar." />
	<meta property="og:image" content="assets/images/logo.png"/>

	<title>	Cybar | page</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu_deroulant.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin.min.css">


</head>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete-page">
			<div class="row">

				<div class="col-md-1" align="center"></div>
				<div class="col-md-2" align="center" style="padding-top: 50px">
					<?php $this->load->view('template/sous_menu_admin') ?>
				</div>

				<div class="col-md-8" style="overflow: auto;padding-top: 50px" id="droite">
					
					<titre>Frais de transport de base</titre>
					<?php 
						 $agences = $this->Agence_model->select_all();
						 $nombre = count($agences);

						 //FRAIS ENREGISTRES
						 $fr = array();
						 $frais = $this->Parametres_model->select_frais_dist();
						 foreach ($frais as $key => $f) {
						 	$fr[$f['dep_f_d']."_".$f['arriv_f_d']] = $f['val_f_d'];
						 	$fr[$f['arriv_f_d']."_".$f['dep_f_d']] = $f['val_f_d'];
						 }
		                 
					 ?>
					<BR><br>
					<div class="resume">
					<form method="POST" action="<?php echo base_url() ?>admin/update_parametres_frais_distance">
						<table>
							<?php 
							############# ALGORITHME #############
							# 1 : 2,3,4,5
							# 2 : 3,4,5
							# 3 : 4,5
							# 4 : 5
							######################################
							$k = 0;
							for($i = 0; $i < $nombre - 1; $i++)
							{
								for($j=$i+1 ; $j < $nombre; $j++)
								{
							?>
								<tr>
									<td class="td_agence" align="right"><input type="hidden" name="dep_<?php echo $k ?>" value="<?php echo $agences[$i]['id_agence'] ?>"><?php echo $agences[$i]['nom_a'] ?></td>
									<td class="td_agence" align=""> <input type="number" value="<?php echo $fr[$agences[$i]['id_agence'].'_'.$agences[$j]['id_agence']] ?>" name="val_<?php echo $k ?>" class="form-control"> </td>
									<td class="td_agence" align="left"><input type="hidden" name="arriv_<?php echo $k ?>" value="<?php echo $agences[$j]['id_agence'] ?>"><?php echo $agences[$j]['nom_a'] ?></td>
								</tr>

							<?php
							$k ++;
								}
							}
							 ?>
							
						</table>
						<button type="submit" class="btn btn-warning">Enregistrer</button>
					</form>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
	<script src="<?php echo base_url() ?>assets/js/admin.min.js?5" ></script>
</body>
</html>