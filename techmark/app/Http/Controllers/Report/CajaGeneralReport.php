<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 14/07/2017
 * Time: 11:38 AM
 */

namespace App\Http\Controllers\Report;


use App\Caja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Support\Facades\Auth;


class CajaGeneralReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "CAJA CHICA";
    private $request = null;

    function __construct(Request $request)
    {
        $this->datos['caja'] = Caja::find($request->get('id'));
    }

    public function index(Request $request)
    {
        if (Auth::user()->can('allow-read')) {
            $pdf = new TCPDF('p', 'mm', 'Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By Liss');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);

            $pdf->writeHTML(view('cpanel.report.cajageneral.tabla', $this->datos)->render(), true, false, true, false, '');
            $pdf->Output('detalles_productos.pdf', 'i');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}