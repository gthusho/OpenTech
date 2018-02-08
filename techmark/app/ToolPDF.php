<?php
/**
 * Created by PhpStorm.
 * User: Gthusho-PC
 * Date: 2/2/2017
 * Time: 22:02
 */

namespace App;


 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Config;

 class  ToolPDF
{

     public static function footerPDF($pdf){
         $pdf->setFooterCallback(function($pdf){
             $pdf->SetY(-15);
             // Set font
             $pdf->SetFont('helvetica', 'I', 8);
             // Page number
             $pdf->Cell(0, 5, date('d/m/Y H:i').' | '.ucwords(\Auth::user()->nombre) , 0, false, 'L', 0, '', 0, false, 'T', 'M');
             $pdf->Cell(0, 5, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
         });
     }
     public static function headerPDF($pdf){
         $pdf->setHeaderCallback(function($pdf){
             $image_file = url('texmarck2.png');
             $pdf->Image($image_file, 15, 7, 50, '', '', '', 'T', false, 500, '', false, false, 0, false, false, false);
             // Set font
             $pdf->SetFont('times', 'I', 10);
             // Title

             $pdf->Write(0, 'TexMarck
                            (+591)(4)6464962
            ',0,false,'R');
             $pdf->Ln();
             $pdf->Cell(0, 0, '', 'T', 1, 'C', 0, '',2);
         });
     }
     public static  function setMargen($pdf){
         $pdf->SetMargins(15, 20, 15);
         $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
         $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     }


 }