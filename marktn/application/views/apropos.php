<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="marketinona, organisation, ONG, madio, mizara,mianatra, miasa,ville propre, société nourrie, société vêtue, société logée, compatriote éduqué, éducation, travail, propreté, Madagascar"/>
	<meta name="description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:url" content="www.marketinona.com" />
	<meta property="og:type" content="vente" /> 
	<meta property="og:title" content="www.marketinona.com" />
	<meta property="og:description"   content="marketinona est une plateforme de mise en relation vendeurs et acheteurs à Madagascar. Tout le monde peut publier n'importe quel produit. C'est une solution pour les ventes en ligne à Madagascar." />
	<meta property="og:image" content="<?php echo base_url() ?>assets/images/logo.png"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<title>	marketinona | Accueil</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/accueil.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/general.min.css?201910101">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/menu.min.css?2023">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bg.min.css">

</head>
<style type="text/css">

</style>
<body>
	<div>
		<!-- DEBUT MENU -->
		<?php $this->load->view('template/menu'); ?>
		<!-- FIN MENU -->
		<div class="tete_accueil row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6" style="text-align: justify;line-height: 2;padding-left: 37px;padding-right: 20px;">
				<h3>Ny mombamomba ny marketinona</h3>
			marketinona dia vahaolana iray afahana mampifandray ny mpivarotra sy ny mpanjifa eto Madagasikara, izay afahan'ny mpivarotra rehetra mampiseho ny karazan'entany ary afahan'ny mpividy ihany koa mitady sy misafidy izay entana mahaliana azy sy tiany hovidina.<br>
			Azo aranty eto avokoa ny karazan'entana rehetra azo amidy, na vaovao na efa niasa.<br>
			Ny mpivarotra rehetra dia tokony handoa hetra ka natao ihany koa izy ity mba hafahan'ny tsirairay ( na dia izay tsy manana karatra fandoavan-ketra) mivarotra izay entana tiany hamidy ka anjaranay ny mandoa ny hetra mifandraika amin'izany.<br>
			Misokatra ho an'ny rehetra ny tranokala, na ny mpividy na ny mpivarotra. Fa izay mivarotra kosa, ka tsy manana karatra fandoavan-ketra, dia tsy maintsy mampiseho ny karapanondrony eto amin'ny tranokala mba ho ara-dalana tanteraka ny varotra atao.<br>
			Izahay no mandray ny vidin'entana ary anjaranay ny manolotra azy an'ny mpivarotra. Napetraka io lamina io mba hisorohana ny fisolokiana mety hisy, ka amin'izany dia tsy azon'ny mpivarotra atao ny mandray ny vola raha tsy efa voamarina tsara ilay entana. 
			<br>
			Raha sanatria kosa tsy mifanaraka amin'ny kaomandy ilay entana dia tsy maintsy averina amin'ny tompony ny vola.
			</div>
			<div class="col-md-3">
			</div>
		</div>
		<div class="section-gris row" >
			<div class="col-md-6" style="text-align: left;">
				<h3>VAHAOLANA ATOLOTRAY</h3>
				<h5>Ireto avy no vahaolana entin'ity tranokala ity amin'ny vahoaka sy ny fanjakana Malagasy</h5>
			</div>
			<div class="col-md-6" style="text-align: center;">
				<h1><?php echo number_format($this->Membre_model->count_membre(), 2, ',', ' '); ?> Membres</h1>
			</div>
		</div>
		<div class="section" style=";">
			<div class="profils row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="row">
						<!--div class='hidden-xs hidden-sm ripple-background'> <div class='circle xxlarge shade1'></div> <div class='circle xlarge shade2'></div> <div class='circle large shade3'></div> <div class='circle mediun shade4'></div> <div class='circle small shade5'></div> </div-->
						<?php 
						$parametres = $this->Admin_model->get_parametres();
			    		$p = $parametres[0];
						?>
						<div data-aos="fade"  data-aos-duration="200" class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<img src="<?php echo base_url() ?>assets/images/profils/no_deplacement.webp" alt="Intègre" class="" style="height: 150px; width: auto; ">
								<div class="caption">
									<h3>Tsy mila mifindra toerana</h3>
									<p>Vita eto amin'ny tranokala ny fividanana sy fivarotana entana amin'ny faritany samy hafa, ny Marketinona no mandray sy mandefa ny entana.</p>
								</div>
							</div>
						</div>
						<div data-aos="fade"  data-aos-duration="200" class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<img src="<?php echo base_url() ?>assets/images/profils/securite.webp" alt="Intègre" class="" style="height: 150px; width: auto; ">
								<div class="caption">
									<h3>Azo antoka</h3>
									<p>Tsy azon'ny mpivarotra raisina ny vola raha tsy efa voamarina tsara, foana ny fisolokiana.</p>
								</div>
							</div>
						</div>
						<div data-aos="fade"  data-aos-duration="200" class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<img src="<?php echo base_url() ?>assets/images/profils/no_carte.webp" alt="Intègre" class="" style="height: 150px; width: auto; ">
								<div class="caption">
									<h3>Tsy mila karatra fandoavan-ketra</h3>
									<p>Afaka mivarotra ara-dalana ireo mpivarotra madinika tsy manana karatra fandoavan-ketra</p>
								</div>
							</div>
						</div>
						<div data-aos="fade"  data-aos-duration="200" class="col-sm-6 col-md-3">
							<div class="thumbnail" align="center">
								<img src="<?php echo base_url() ?>assets/images/profils/impot_plus.webp" alt="Intègre" class="" style="height: 150px; width: auto; ">
								<div class="caption">
									<h3>Mitombo ny mpandoa hetra </h3>
									<p>Misy ampahany miditra amin'ny kitampom-bolam-panjakana avokoa ny varotra rehetra mandalo eto amin'ny Marketinona.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>


	</div>
	<?php $this->load->view('template/footer'); ?>
</body>
<script src="<?php echo base_url() ?>assets/js/inscription.min.js"></script>
<!--link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">	
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script-->

</html>