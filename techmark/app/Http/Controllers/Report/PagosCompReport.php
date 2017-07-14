<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 06/07/2017
 * Time: 04:05 AM
 */

namespace App\Http\Controllers\Report;


use App\Compra;
use App\Http\Controllers\Controller;
use App\Tool;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PagosCompReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "REPORTE PAGOS";
    private $request =  null;

    function __construct(Request $request)
    {
        $this->datos['compra'] = Compra::find($request->get('id'));
    }

    public function index(Request $request)
    {
        if (Auth::user()->can('allow-read')) {
            $pdf = new TCPDF('p', 'mm', 'Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By LDiego');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);

            /*
       * QR
       */
            $y = $pdf->GetY(); //obtengo la posicion en Y

            $style = array('width' => 0.6, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $code = $this->datos['compra']->getCode().' | '.$this->datos['compra']->proveedor->razon_social.' | '.$this->datos['compra']->fecha;

            $pdf->writeHTML(view('cpanel.report.pagoscompra.tabla', $this->datos)->render(), true, false, true, false, '');
            $pdf->write2DBarcode($code, 'QRCODE,Q', 150, $y, 30, 30, $style, 'N');

            $pdf->Output('pagos.pdf', 'i');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}