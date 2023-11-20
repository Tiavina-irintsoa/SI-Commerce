<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfModel extends CI_Model{

    public function content_bdc($data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(0, 20, 'BON DE COMMANDE', 0, 5, 'C');

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30,8,'Societe : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $data['societe']);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40,8,'Fournisseur :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $data['fournisseur']);
        
        
        
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(20,8,'Date : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(70,8, $data['date']);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,8,'Delai de livraison :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8, $data['delai']);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30,8,'Numero : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $data['numero']);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,8,'Livraison partielle :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8,  $data['partielle']);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(90,8,'');
        $pdf->Cell(50,8,'Mode de paiement :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8, $data['mode']);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Ln();
        $pdf->Cell(40,20,'Bon de commande n:');
        $pdf->Ln();
        $pdf->Cell(50,15,'Categorie',1, 0, 'C');
        $pdf->Cell(35,15,'Designation',1, 0, 'C');
        $pdf->Cell(20,15,'Qte',1, 0 , 'C');
        $pdf->Cell(25,15,'PU',1, 0, 'C');
        $pdf->Cell(20,15,'TVA',1, 0, 'C');
        $pdf->Cell(45,15,'Montant',1, 0 , 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',14);
        $pu = 0; $tva = 0; $total = 0;
        foreach($data['details'] as $row) {
            $pu += $row['prixunitaire'];
            $tva += $row['tva']; 
            $total += ($row['prixunitaire'] + $row['prixunitaire'] * $row['tva']) * $row['quantite'];
            $pdf->Cell(50,15, $row['libellecategorie'] ,1, 0, 'C');
            $pdf->Cell(35,15, $row['nomarticle'] ,1, 0, 'C');
            $pdf->Cell(20,15, $row['quantite'] ,1, 0 , 'C');
            $pdf->Cell(25,15, number_format($row['prixunitaire'], 0, ',', ' ') ,1, 0, 'C');
            $pdf->Cell(20,15, number_format($row['tva'], 0, ',', ' ') ,1, 0, 'C');
            $pdf->Cell(45,15, number_format(($row['prixunitaire'] + $row['prixunitaire'] * $row['tva']) * $row['quantite'], 0, ',', ' ') ,1, 0 , 'C');
            $pdf->Ln();
        }
        $pdf->Cell(50,15,'');
        $pdf->Cell(35,15,'');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(20,15,'Total',1, 0 , 'C');
        $pdf->Cell(25,15, number_format($pu, 0, ',', ' '),1, 0, 'C');
        $pdf->Cell(20,15, number_format($tva, 0, ',', ' ') ,1, 0, 'C');
        $pdf->Cell(45,15, number_format($total, 0, ',', ' ') ,1, 0 , 'C');
        
        $pdf->Ln();
        $pdf->Ln();
        // $string_total = $this->nombre_en_lettres('123456789');
        $text = "Arrete le present de bon de commande a la somme de " . $total . " Ariary";
        $pdf->MultiCell(190, 10, $text);

        $nom = 'bon_commande'.$data['date'].'F'.$data['idfournisseur'].'.pdf';
        $pdf->Output($nom, 'I');
    }

    // public function nombre_en_lettres($nombre) {
    //     $nombre = str_replace(' ', '', $nombre);
    //     $nombre = str_replace(',', '.', $nombre);
    //     $nombre = explode('.', $nombre);
     
    //     $int = $nombre[0];
    //     $dec = isset($nombre[1]) ? $nombre[1] : '';
     
    //     $int_arr = str_split(strrev($int));
    //     $int_str = '';
    //     for ($i = 0; $i < count($int_arr); $i++) {
    //         $value = $int_arr[$i];
    //         $int_str .= $value . ($i % 3 == 2 && $value != 0 ? ' mille' : '') . ($i % 3 == 1 ? ' cent' : '') . ($i % 3 == 0 && $i != 0 ? ' ' : '');
    //     }
     
    //     $dec_arr = str_split(strrev($dec));
    //     $dec_str = '';
    //     for ($i = 0; $i < count($dec_arr); $i++) {
    //         $value = $dec_arr[$i];
    //         $dec_str .= $value . ($i % 3 == 2 && $value != 0 ? ' mille' : '') . ($i % 3 == 1 ? ' cent' : '') . ($i % 3 == 0 && $i != 0 ? ' ' : '');
    //     }
     
    //     return trim(strrev($int_str)) . ' Ariary' . ($dec_str != '' ? ' et ' . trim(strrev($dec_str)) . ' centimes' : '');
    //  }

    public function demande_proforma($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');
        ob_start();
        $pdf = new FPDF();
        $this->content_proforma($pdf, $societe, $fournisseur, $delai, $data);
        $path = APPPATH.'../assets/docs/demandeproforma/'.$fournisseur.'-'.$delai.'.pdf';
        $pdf->Output('F',$path);
        ob_end_flush();   
        return $path;
    }

    public function content_proforma($pdf, $societe, $fournisseur, $delai, $data){
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(0, 20, 'DEMANDE DE PROFORMA', 0, 5, 'C');

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(30,20,'Societe : ');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(60,20, $societe);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40,20,'Fournisseur :');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(60,20, $fournisseur);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(55, 0,'Delai de livraison : ');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(50, 0,$delai);

        $pdf->Ln();
        // $pdf->Cell(10,20,'',);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(35,15,'',0, 0, 'C');
        $pdf->Cell(60,15,'Designation',1, 0, 'C');
        $pdf->Cell(60,15,'Quantite',1, 0 , 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',16);
        foreach($data as $row) {
            $pdf->Cell(35,15,'',0, 0, 'C');
            $pdf->Cell(60, 15, $row[0], 1, 0, 'C');
            $pdf->Cell(60, 15, $row[1], 1, 0, 'C');
            $pdf->Ln();
        }
    }

    public function liste_proforma($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        
        $this->content_proforma($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_proforma($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_proforma($pdf, $societe, $fournisseur, $delai, $data);

        $pdf->Output('proforma.pdf', 'I');
    }
}