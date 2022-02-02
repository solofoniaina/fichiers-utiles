<?php
class MesFonctions extends CI_Model
{
      public function replaceSpecialChar($str) {
          $ch0 = array( 
                  "œ"=>"oe",
                  "Œ"=>"OE",
                  "æ"=>"ae",
                  "Æ"=>"AE",
                  "À" => "A",
                  "Á" => "A",
                  "Â" => "A",
                  "à" => "A",
                  "Ä" => "A",
                  "Å" => "A",
                  "&#256;" => "A",
                  "&#258;" => "A",
                  "&#461;" => "A",
                  "&#7840;" => "A",
                  "&#7842;" => "A",
                  "&#7844;" => "A",
                  "&#7846;" => "A",
                  "&#7848;" => "A",
                  "&#7850;" => "A",
                  "&#7852;" => "A",
                  "&#7854;" => "A",
                  "&#7856;" => "A",
                  "&#7858;" => "A",
                  "&#7860;" => "A",
                  "&#7862;" => "A",
                  "&#506;" => "A",
                  "&#260;" => "A",
                  "à" => "a",
                  "á" => "a",
                  "â" => "a",
                  "à" => "a",
                  "ä" => "a",
                  "å" => "a",
                  "&#257;" => "a",
                  "&#259;" => "a",
                  "&#462;" => "a",
                  "&#7841;" => "a",
                  "&#7843;" => "a",
                  "&#7845;" => "a",
                  "&#7847;" => "a",
                  "&#7849;" => "a",
                  "&#7851;" => "a",
                  "&#7853;" => "a",
                  "&#7855;" => "a",
                  "&#7857;" => "a",
                  "&#7859;" => "a",
                  "&#7861;" => "a",
                  "&#7863;" => "a",
                  "&#507;" => "a",
                  "&#261;" => "a",
                  "Ç" => "C",
                  "&#262;" => "C",
                  "&#264;" => "C",
                  "&#266;" => "C",
                  "&#268;" => "C",
                  "ç" => "c",
                  "&#263;" => "c",
                  "&#265;" => "c",
                  "&#267;" => "c",
                  "&#269;" => "c",
                  "Ð" => "D",
                  "&#270;" => "D",
                  "&#272;" => "D",
                  "&#271;" => "d",
                  "&#273;" => "d",
                  "È" => "E",
                  "É" => "E",
                  "Ê" => "E",
                  "Ë" => "E",
                  "&#274;" => "E",
                  "&#276;" => "E",
                  "&#278;" => "E",
                  "&#280;" => "E",
                  "&#282;" => "E",
                  "&#7864;" => "E",
                  "&#7866;" => "E",
                  "&#7868;" => "E",
                  "&#7870;" => "E",
                  "&#7872;" => "E",
                  "&#7874;" => "E",
                  "&#7876;" => "E",
                  "&#7878;" => "E",
                  "è" => "e",
                  "é" => "e",
                  "ê" => "e",
                  "ë" => "e",
                  "&#275;" => "e",
                  "&#277;" => "e",
                  "&#279;" => "e",
                  "&#281;" => "e",
                  "&#283;" => "e",
                  "&#7865;" => "e",
                  "&#7867;" => "e",
                  "&#7869;" => "e",
                  "&#7871;" => "e",
                  "&#7873;" => "e",
                  "&#7875;" => "e",
                  "&#7877;" => "e",
                  "&#7879;" => "e",
                  "&#284;" => "G",
                  "&#286;" => "G",
                  "&#288;" => "G",
                  "&#290;" => "G",
                  "&#285;" => "g",
                  "&#287;" => "g",
                  "&#289;" => "g",
                  "&#291;" => "g",
                  "&#292;" => "H",
                  "&#294;" => "H",
                  "&#293;" => "h",
                  "&#295;" => "h",
                  "Ì" => "I",
                  "Í" => "I",
                  "Î" => "I",
                  "Ï" => "I",
                  "&#296;" => "I",
                  "&#298;" => "I",
                  "&#300;" => "I",
                  "&#302;" => "I",
                  "&#304;" => "I",
                  "&#463;" => "I",
                  "&#7880;" => "I",
                  "&#7882;" => "I",
                  "&#308;" => "J",
                  "&#309;" => "j",
                  "&#310;" => "K",
                  "&#311;" => "k",
                  "&#313;" => "L",
                  "&#315;" => "L",
                  "&#317;" => "L",
                  "&#319;" => "L",
                  "&#321;" => "L",
                  "&#314;" => "l",
                  "&#316;" => "l",
                  "&#318;" => "l",
                  "&#320;" => "l",
                  "&#322;" => "l",
                  "Ñ" => "N",
                  "&#323;" => "N",
                  "&#325;" => "N",
                  "&#327;" => "N",
                  "ñ" => "n",
                  "&#324;" => "n",
                  "&#326;" => "n",
                  "&#328;" => "n",
                  "&#329;" => "n",
                  "Ò" => "O",
                  "Ó" => "O",
                  "Ô" => "O",
                  "Õ" => "O",
                  "Ö" => "O",
                  "Ø" => "O",
                  "&#332;" => "O",
                  "&#334;" => "O",
                  "&#336;" => "O",
                  "&#416;" => "O",
                  "&#465;" => "O",
                  "&#510;" => "O",
                  "&#7884;" => "O",
                  "&#7886;" => "O",
                  "&#7888;" => "O",
                  "&#7890;" => "O",
                  "&#7892;" => "O",
                  "&#7894;" => "O",
                  "&#7896;" => "O",
                  "&#7898;" => "O",
                  "&#7900;" => "O",
                  "&#7902;" => "O",
                  "&#7904;" => "O",
                  "&#7906;" => "O",
                  "ò" => "o",
                  "ó" => "o",
                  "ô" => "o",
                  "õ" => "o",
                  "ö" => "o",
                  "ø" => "o",
                  "&#333;" => "o",
                  "&#335;" => "o",
                  "&#337;" => "o",
                  "&#417;" => "o",
                  "&#466;" => "o",
                  "&#511;" => "o",
                  "&#7885;" => "o",
                  "&#7887;" => "o",
                  "&#7889;" => "o",
                  "&#7891;" => "o",
                  "&#7893;" => "o",
                  "&#7895;" => "o",
                  "&#7897;" => "o",
                  "&#7899;" => "o",
                  "&#7901;" => "o",
                  "&#7903;" => "o",
                  "&#7905;" => "o",
                  "&#7907;" => "o",
                  "ð" => "o",
                  "&#340;" => "R",
                  "&#342;" => "R",
                  "&#344;" => "R",
                  "&#341;" => "r",
                  "&#343;" => "r",
                  "&#345;" => "r",
                  "&#346;" => "S",
                  "&#348;" => "S",
                  "&#350;" => "S",
                  "&#347;" => "s",
                  "&#349;" => "s",
                  "&#351;" => "s",
                  "&#354;" => "T",
                  "&#356;" => "T",
                  "&#358;" => "T",
                  "&#355;" => "t",
                  "&#357;" => "t",
                  "&#359;" => "t",
                  "Ù" => "U",
                  "Ú" => "U",
                  "Û" => "U",
                  "Ü" => "U",
                  "&#360;" => "U",
                  "&#362;" => "U",
                  "&#364;" => "U",
                  "&#366;" => "U",
                  "&#368;" => "U",
                  "&#370;" => "U",
                  "&#431;" => "U",
                  "&#467;" => "U",
                  "&#469;" => "U",
                  "&#471;" => "U",
                  "&#473;" => "U",
                  "&#475;" => "U",
                  "&#7908;" => "U",
                  "&#7910;" => "U",
                  "&#7912;" => "U",
                  "&#7914;" => "U",
                  "&#7916;" => "U",
                  "&#7918;" => "U",
                  "&#7920;" => "U",
                  "ù" => "u",
                  "ú" => "u",
                  "û" => "u",
                  "ü" => "u",
                  "&#361;" => "u",
                  "&#363;" => "u",
                  "&#365;" => "u",
                  "&#367;" => "u",
                  "&#369;" => "u",
                  "&#371;" => "u",
                  "&#432;" => "u",
                  "&#468;" => "u",
                  "&#470;" => "u",
                  "&#472;" => "u",
                  "&#474;" => "u",
                  "&#476;" => "u",
                  "&#7909;" => "u",
                  "&#7911;" => "u",
                  "&#7913;" => "u",
                  "&#7915;" => "u",
                  "&#7917;" => "u",
                  "&#7919;" => "u",
                  "&#7921;" => "u",
                  "&#372;" => "W",
                  "&#7808;" => "W",
                  "&#7810;" => "W",
                  "&#7812;" => "W",
                  "&#373;" => "w",
                  "&#7809;" => "w",
                  "&#7811;" => "w",
                  "&#7813;" => "w",
                  "Ý" => "Y",
                  "&#374;" => "Y",
                  "?" => "Y",
                  "&#7922;" => "Y",
                  "&#7928;" => "Y",
                  "&#7926;" => "Y",
                  "&#7924;" => "Y",
                  "ý" => "y",
                  "ÿ" => "y",
                  "&#375;" => "y",
                  "&#7929;" => "y",
                  "&#7925;" => "y",
                  "&#7927;" => "y",
                  "&#7923;" => "y",
                  "&#377;" => "Z",
                  "&#379;" => "Z",
                  "@" => "at",
                  "$" => "dollar",
                  "€" => "euro",
                  "¤" => "",
                  ")" => "",
                  "(" => "",
                  "/" => "-",
                  "'" => "-",
                  "#" => "-",
                  "*" => "-",
                  "@" => "A",
                  "²" => "2",
                  "|" => "-",
                  "`" => "-",
                  "\"" => "-",
                  "\\" => "-",
                  "^" => "-"
                  );
              $str = strtr(trim($str),$ch0); 
              return $str;
          }

      public function lettre_tsotra($texte)
      {
            //Enregistrer les positions des caractères inutiles
            $tsyilaina = array();
            $tab = str_split($texte);
            foreach ($tab as $key => $lettre) {
                  if(!preg_match('/[-a-z0-9_.]/', $lettre))
                  {
                        $tsyilaina[] = $lettre;
                  }
            }
            foreach ($tsyilaina as $key => $fake) {
                  $texte = str_replace($fake, "", $texte);

            }
            return $texte;
      }
      public function total_gain($id_membre)
      {     $total_comm = $this->gain_referral($id_membre) + $this->gain_reduction($id_membre) + $this->gain_vente_membre($id_membre) + $this->gain_vente_public($id_membre) + $this->gain_vente_directe($id_membre);
            return $total_comm;
      }
      public function gain_referral($id_membre)
      {
            $membre = $this->Membre_model->cemembre($id_membre);
            $m = $membre[0];
            return $m['gain_referral_m'];
      }

      public function gain_vente_public($id_membre)
      {//TSY MISY PUBLIC SY MEMBRE TSONY
            return 0;
      }
      public function gain_vente_membre($id_membre)
      {
            $membre = $this->Membre_model->cemembre($id_membre);
            $m = $membre[0];
            
            $parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];
            
            $prix_pub   = 0;
            $prix_mb    = 0;
            // VENTES COMMMISSION
            $ventes = $this->Vente_model->vente_parrain($id_membre);
            //var_dump($ventes);exit();
            foreach ($ventes as $key => $v_p) {
                  //MODIF 09 09 2021 : mahazo fona na membre na tsy membre le acheteur
                    
                  if($v_p['active_parrain_v'])
                  {
                  //SI Abonné => Commission membre
                        $comm_mb = $p['gain_membre'] * $v_p['prix_v'] / 100;
                        $prix_mb += $comm_mb;
                  }
                  else
                  {
                         //SI pas abonné => Commission public
                        $comm_mb = $p['gain_public'] * $v_p['prix_v'] / 100;
                        $prix_mb += $comm_mb;
                  }
            }

            return $prix_mb;
      }

      public function gain_vente_directe($id_membre)
      {
            $membre = $this->Membre_model->cemembre($id_membre);
            $m = $membre[0];
            $parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];
            $notre_commission_vente = $p['notre_commission']; //20%

            //Ventes directes
            $ventes_prod = $this->Vente_model->vente_membre($id_membre);
            $somme_vente_prod = 0;

            foreach ($ventes_prod as $key => $prod) {
                  $prix_prod = $prod['prix_v'] - ( $notre_commission_vente * $prod['prix_v'] / 100 );
                  $somme_vente_prod += $prix_prod;
            }

            return $somme_vente_prod;
      }
      public function retrait($id_membre)
      {
            $retraits = $this->Retrait_model->retrait_membre($id_membre);
            $total_retrait = 0;
            foreach ($retraits as $key => $r) {
                  $total_retrait += $r['valeur_d'];
            } 
            return $total_retrait;

      }

      public function retirable($id_membre,$total_gain)
      {
            $retraits = $this->Retrait_model->retrait_membre($id_membre);
            $total_retrait = 0;
            foreach ($retraits as $key => $r) {
                  $total_retrait += $r['valeur_d'];
            } 
            $parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];

            $limite = $p['minimum_retrait'];  //Limite de paiement
            $retirable = $total_gain - $total_retrait;

            if ($retirable >= $limite) {
                 return  $retirable;
            }
            else return 0;

      }

      public function retirable_encours($id_membre,$total_gain)
      {
            $retraits = $this->Retrait_model->retrait_membre($id_membre);
            $total_retrait = 0;
            foreach ($retraits as $key => $r) {
                  $total_retrait += $r['valeur_d'];
            } 
            $parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];

            $limite = $p['minimum_retrait'];  //Limite de paiement
            $retirable = $total_gain - $total_retrait;

           
            return  $retirable;

      }
      public function gain_reduction($id_membre)
      {
            $parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];
            $gain_public = $p['gain_public']; //20%

            $achat = $this->Vente_model->achat_membre($id_membre);
            $somme_reduction = 0;

            foreach ($achat as $key => $a) {
                  $pourc_produit = $gain_public * $a['prix_v'] / 100 ;
                  $somme_reduction += $pourc_produit;
            }

            return $somme_reduction;
      }
      /* NOS COMMISSION VENTES */

      /*OPERATIONS SUR LES VENTES 
      REGLES : 
            1- Avec id_parrain sans id_membre => 0%membre + -5% parrain + 20 % commission (membre non actif ou non membre)
            2- Avec id_parrain avec id_membre => 5% membre -10% parrain + 10 % commission (membre actif)
            3- sans id_parrain sans id_membre => 0% membre -0% parrain + 25% commission
            4- sans id_parrain avec id_membre => 5% membre -0% parrain + 20% commission
      */
      public function nos_commissions($id_membre, $id_parrain, $prix, $parametres)
      {
            $commission = array();
            if (!empty($id_parrain)) {
                  //1
                  if (empty($id_membre)) {
                       //0%membre + -5% parrain + 20 % commission
                        $commission['membre'] = 0;
                        $commission['parrain'] = $parametres['gain_public'] * $prix / 100;
                        $commission['nous'] = ($parametres['notre_commission'] - $parametres['gain_public']) * $prix / 100;
                  }
                  //2
                  else
                  {
                        //5% membre -10% parrain + 10 % commission (membre actif)
                        $commission['membre'] = $parametres['gain_public'] * $prix / 100;
                        $commission['parrain'] = $parametres['gain_membre'] * $prix / 100;
                        $commission['nous'] = ($parametres['notre_commission'] - $parametres['gain_membre'] - $parametres['gain_public']) * $prix / 100;     
                  }
            }
            else
            {
                   //3
                  if (empty($id_membre)) {
                       //0% membre -0% parrain + 25% commission
                        $commission['membre'] = 0;
                        $commission['parrain'] = 0;
                        $commission['nous'] = $parametres['notre_commission'] * $prix / 100;
                  }
                  //4
                  else
                  {
                        //5% membre -0% parrain + 20% commission
                        $commission['membre'] = $parametres['gain_public'] * $prix / 100;
                        $commission['parrain'] = 0;
                        $commission['nous'] = ($parametres['notre_commission'] -  $parametres['gain_public']) * $prix / 100;     
                  }
            } 
            return $commission;
      }

      public function monId($id_membre)
      {
            switch (strlen($id_membre)) {
                  case 1:
                        return 'MA00000'.$id_membre;
                        break;
                  case 2:
                        return 'MB0000'.$id_membre;
                        break;
                  case 3:
                        return 'MC000'.$id_membre;
                        break;
                  case 4:
                        return 'MD00'.$id_membre;
                        break;
                  case 5:
                        return 'MF0'.$id_membre;
                        break;
                  default:
                        return 'MG'.$id_membre;
                        break;
            }
      }

      public function no_expiree($daty)
      {
            $date_now = date("Y-m-d"); // this format is string comparable

            if ($date_now >= $daty) {
                return false;
            }else{
                return true;
            }
      }
}