<?php 
if (!empty($_SESSION['session_admin'])) {

$id_membre = $_SESSION['session_admin']; 
  $membre = $this->User_model->get_id($id_membre);
 
//Count commandes new
$achat = $this->Vente_model->nouveau_commandes_recu(); 
$nb_cmd = count($achat);

?>

<H5><b><?php echo $membre['prenom_a'] ?></b></H5>
<h6>- <?php echo $membre['nom_r'] ?> -</h6>
<?php } ?>
  <!--sous menu -->
  <ul id="menu-accordeon">

    <li style="background-color: #ec9349 !important;"><a href="#">Commandes <span class="badge"><?php echo $nb_cmd ?></span></a>
        <ul>
           <li><a href="<?php echo base_url() ?>admin/paiement_produit">Attente</a></li>
           <li><a href="<?php echo base_url() ?>admin/livraison_produit"> Payé</a></li>
           <li><a href="<?php echo base_url() ?>admin/reception_produit"> Vérifié</a></li>
           <li><a href="<?php echo base_url() ?>admin/recu_produit">Reçu</a></li>
           <li><a href="<?php echo base_url() ?>admin/rejet_produit">Rejeté</a></li>
        </ul>
     </li>
    <li><a href="<?php echo base_url() ?>admin/produits">Produits</a></li>
    <li><a href="<?php echo base_url() ?>admin/categories">Catégories</a></li>
    <li><a href="#">Validation</a>
        <ul>
           <li><a href="<?php echo base_url() ?>validation/produit">Produits</a></li>
           <li><a href="<?php echo base_url() ?>validation/membre">Membres</a></li>
        </ul>
     </li>
    
    <!--li><a href="<?php echo base_url() ?>admin/script_parrain">Log inscription</a></li>
    <li><a href="<?php echo base_url() ?>admin/script_referral">Log abonnement</a></li-->
    
   <?php if (isset($_SESSION['session_superadmin']) || isset($_SESSION['session_simpleadmin'])) { ?>
    <li><a href="#">Membres</a>
        <ul>
           <li><a href="<?php echo base_url() ?>admin/membre_tout">Tout</a></li>
           <li><a href="<?php echo base_url() ?>admin/membre_actif">Premium</a></li>
           <li><a href="<?php echo base_url() ?>admin/membre_non">Gratuit</a></li>
           <li><a href="<?php echo base_url() ?>admin/membre_non_confirme">Non confirmé</a></li>
        </ul>
     </li>
     <!--li><a href="<?php echo base_url() ?>admin/activation_manuel">P. Abonnement</a></li-->
     <li><a href="#">Tableau de bord</a>
        <ul>
           <li><a href="<?php echo base_url() ?>admin/recapitulatif">compte principal</a></li>
           <li><a href="<?php echo base_url() ?>admin/rapport">Rapport</a></li>
           <li><a href="<?php echo base_url() ?>bord/membre">Membres</a></li>
        </ul>
     </li>
   <?php } ?>
     <li><a href="#">Localisation</a>
        <ul>
           <li><a href="<?php echo base_url() ?>bord/loca_agence">Par agence</a></li>
           <li><a href="<?php echo base_url() ?>bord/loca_destination">Destination réélle</a></li>
        </ul>
     </li>
     <?php if (isset($_SESSION['session_superadmin'])) { ?>
       <li style="background-color: #222 !important;"><a href="<?php echo base_url() ?>admin/parametres">Paramètres</a></li>
     <li style="background-color: #222 !important;"><a href="<?php echo base_url() ?>agence/frais_distance">Frais - Distances</a></li>
     <li style="background-color: #222 !important;"><a href="<?php echo base_url() ?>agence">Agences</a></li>
    <li style="background-color: #222 !important;"><a href="#">G. utilisateur</a>
        <ul>
           <li><a href="<?php echo base_url() ?>user">Utilisateur</a></li>
           <li><a href="<?php echo base_url() ?>user/role">Rôles</a></li>
        </ul>
     </li>
   <?php } ?>
   <?php if (isset($_SESSION['session_superadmin'])) { ?>
      <li style="background-color: transparent !important;"><a href="<?php echo base_url() ?>admin/fichiers">Fichiers</a></li>
    <?php } ?>

     <!--li><a href="#">Retrait</a>
        <ul>
           <li><a href="<?php echo base_url() ?>admin/retrait_demande">En attente</a></li>
           <li><a href="<?php echo base_url() ?>admin/retrait_liste">Terminé</a></li>
        </ul>
     </li>
     <li><a href="<?php echo base_url() ?>admin/log_moobi">Log Paiement</a></li-->
  </ul>