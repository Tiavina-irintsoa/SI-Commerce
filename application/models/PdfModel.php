<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfModel extends CI_Model{
    public function demande_proforma($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $pdf->Output('proforma.pdf', 'I');
    }

    public function content_performa($pdf, $societe, $fournisseur, $delai, $data){
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
        $pdf->Cell(10,20,'',);
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
        
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);

        $pdf->Output('proforma.pdf', 'I');
    }
}