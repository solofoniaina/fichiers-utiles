<?php 
if (!empty($_SESSION['session_membre'])) {

$id_membre = $_SESSION['session_membre']; 
	$membre = $this->Membre_model->cemembre($id_membre);
	$m = $membre[0];

//Count commandes new
$achat = $this->Vente_model->nouveau_commandes_recu_vendeur($id_membre); 
$nb_cmd = count($achat);

?>
<h5><?php echo $m['nom_m'] ?></h5>
<H5><?php echo $m['prenom_m'] ?></H5>
<ul id="menu-accordeon">

   <li style="background-color: #ec9349 !important;"><a href="#">Commandes reçues <span class="badge"><?php echo $nb_cmd ?></span></a>
      <ul>
           <li><a href="<?php echo base_url() ?>article/new_mes_commandes">Nouveau </a></li>
           <li><a href="<?php echo base_url() ?>article/mes_commandes">Terminé</a></li>
       </ul>
   </li>
     <li><a href="<?php echo base_url()?>compte">Recapitulatif</a></li>
   <li><a href="#">Mes produits</a>
         <ul>
           <li><a href="<?php echo base_url() ?>article/mes_packages">liste</a></li>
           <li><a href="<?php echo base_url() ?>article/mes_ventes_attente">Livraison</a></li>
           <li><a href="<?php echo base_url() ?>article/mes_ventes_realisees">Réalisée</a></li>
       </ul>
   </li>
    <!--li><a href="<?php echo base_url() ?>compte/referrals">Références</a></li-->
   
   <li><a href="<?php echo base_url() ?>produit/mes_achats_article">Mes Achats</a>
   </li>
  <li><a href="<?php echo base_url()?>compte/identite">Mon identité</a></li>
   <!--li><a href="<?php echo base_url() ?>compte">Bonus</a></li-->

  
</ul>
<?php } ?>

<!--img class="hidden-xs hidden-sm" style="width: -webkit-fill-available;" src="<?php echo base_url() ?>assets/images/pub/marketinona_gain3.jpg"-->