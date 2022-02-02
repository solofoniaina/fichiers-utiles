<?php
include('ChiffreEnLettre.php');
$lettre=new ChiffreEnLettre();

$pdf = new Pdf();

 $pdf->Add_Page('P','A4',0);
$pdf->Image('assets/images/logo.png',150,0,40);
$pdf->AliasNbPages();

$pdf->SetAutoPageBreak(false);


$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(123);
$pdf->Text(10,11,utf8_decode('Imandry'));
$pdf->Text(10,14,utf8_decode('301 Fianarantsoa'));
$pdf->Text(10,17,utf8_decode('Madagascar'));
$pdf->Text(10,20,utf8_decode('Téléphone: (261) 34 78 343 34'));
$pdf->Text(10,23,utf8_decode('www.marketinona.com'));
$pdf->Line(8, $position_detail+25, 150, $position_detail+25);
$pdf->Line(8, $position_detail+26, 150, $position_detail+26);
date_default_timezone_set('Europe/Helsinki');
$daty=date('m/Y');

$num_fac = $id_paiement;
$date_fac = date('d/m/Y');
$req_facture = $this->Paiement_model->facture($id_paiement);
$nombre_facture =count($req_facture);
$total_now = $req_facture['montant_pf'];
$mode_paiement = $req_facture['mode_pf'];

switch (strlen($num_fac)) {
	case '1':
		$num_fac = "000".$num_fac;
		break;
	case '2':
		$num_fac = "00".$num_fac;
		break;
	case '3':
		$num_fac = "0".$num_fac;
		break;
	
	default:
		$num_fac = $num_fac;
		break;
}

$adr = $req_facture['adresse_m'];
$pays = "Madagascar";
$tel = $req_facture['telephone_m'];

$devise = "";
$type_paiement = 0;
$nom = "";

$anarana = $req_facture['nom_m'];
$date_facture = $req_facture['paye_date_v'];
$date_fact = substr($date_facture,5,2)."/".substr($date_facture,2,2);

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);
$pdf->Text(152,26,'Facture N:'.$num_fac.'/'.$date_fact);
$pdf->Text(120,38,'Date :'.$date_facture);
$pdf->Text(120,43,'Ref. client :');
	
//Dupliquer pour etre plus nette
$pdf->Text(8,38,utf8_decode('Adressée à :'));
$pdf->Text(8,38,utf8_decode('Adressée à :'));

$pdf->Text(8,43,'Nom : '.utf8_decode($anarana));
$pdf->Text(8,48,utf8_decode('Prénom :'.$req_facture['prenom_m']));
$pdf->Text(8,53,'Adresse :'.utf8_decode($req_facture['adresse_m']));
$pdf->Text(8,58,'Pays :'.utf8_decode($pays));

$type_paiement = $req_facture['mode_pf'];

$devise = "MGA";


// Infos de la commande calées à gauche


// Infos du client calées à droite

/*
// Position de l'entête à 10mm des infos (48 + 10)
*/
$position_entete = 66;



	$pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte

    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(115,8,'Description',1,0,'L',1);

    $pdf->SetX(123);
    $pdf->Cell(25,8,'P.U',1,0,'C',1);

    $pdf->SetX(148); // 
    $pdf->Cell(12,8,utf8_decode('Qté'),1,0,'C',1);

    $pdf->SetX(160); // 
    $pdf->Cell(40,8,'Montant ('.$devise.')',1,0,'C',1);

// Liste des détails
$position_detail = 78; // Position à 8mm de l'entête


//Affichge liste article
	$montant = $req_facture['prix_v'] * $req_facture['nombre_v'];

    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(115,8,utf8_decode($req_facture['nom_p']),1,'L');

    $pdf->SetY($position_detail);
    $pdf->SetX(123);
    $pdf->Cell(25,8,utf8_decode(number_format($req_facture['prix_v'], 2, ',', ' ')),1,'R');

    $pdf->SetY($position_detail);
    $pdf->SetX(148);
    $pdf->MultiCell(12,8,utf8_decode($req_facture['nombre_v']),1,'C');

    $pdf->SetY($position_detail);
    $pdf->SetX(160);
    $pdf->MultiCell(40,8,utf8_decode(number_format($montant, 2, ',', ' ')),1,'R');
    $position_detail += 8;


    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(115,8,utf8_decode('Frais de distance'),1,'L');

     $pdf->SetY($position_detail);
    $pdf->SetX(123);
    $pdf->MultiCell(25,8,utf8_decode(number_format($req_facture['frais_v'], 2, ',', ' ')),1,'R');

    $pdf->SetY($position_detail);
    $pdf->SetX(148);
    $pdf->MultiCell(12,8,utf8_decode('1'),1,'C');

    $pdf->SetY($position_detail);
    $pdf->SetX(160);
    $pdf->MultiCell(40,8,utf8_decode(number_format($req_facture['frais_v'], 2, ',', ' ')),1,'R');
     $position_detail += 8;


     $fit = $montant + $req_facture['frais_v'];

    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(152,10,'TOTAL',1,'C');

    $pdf->SetY($position_detail);
    $pdf->SetX(160);
    $pdf->MultiCell(40,10,number_format($fit, 2, ',', ' '),1,'R');

    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(152,10,'TOTAL',1,'C');

    $pdf->SetY($position_detail);
    $pdf->SetX(160);
    $pdf->MultiCell(40,10,number_format($fit, 2, ',', ' '),1,'R');

 
 /*if ($this->Paiement_model->credit_cash($id_paiement) == '1') {
	$pdf->Text(8,$position_detail+26,utf8_decode('MODE DE PAIEMENT : '.$this->Paiement_model->mode_de_paiement($mode_paiement)));
}*/
	$pdf->Text(8,$position_detail+26,utf8_decode('MODE DE PAIEMENT : MVola'));

	$pdf->Text(8,$position_detail+34,utf8_decode('Arrêté la présente facture, conforme à la somme en '.$devise.' de : '));
	//PLUS NETTE
	$pdf->Text(8,$position_detail+42,utf8_decode($lettre->Conversion($fit)));
	$pdf->Text(8,$position_detail+42,utf8_decode($lettre->Conversion($fit)));


	

 //$pdf->Image(base_url() .'assets/images/rangotra/rangotra.svg', 0, 0, 0, 0);
/*if($this->Signature_model->check_ouvert())
{
	$pdf->Image('assets/images/rangotra/rangotra.png',120,$position_detail+40,50);
}
*/

$pdf->Text(135,$position_detail+55,'Le Responsable','C');
//signature

$pdf->Text(127,$position_detail+79,'Solofoniaina RABIALAHY','C');

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(123);
$pdf->Line(8, 120+150, 210-8, 120+150);
$pdf->Text(8,120+155,utf8_decode('Cette facture est générée automatiquement sur le site www.marketinona.com'));
$pdf->Text(8,120+160,utf8_decode('Vous avez cette facture parce que vous avez déjà effectué le paiement'));
$pdf->Line(8, 120+165, 210-8, 120+165);

// Nom du fichier
$nom = 'Facture'.$anarana.'.pdf';

// Création du PDF
$pdf->Output($nom,'I');
?>