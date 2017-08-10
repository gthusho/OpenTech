<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 16/07/2017
 * Time: 12:55 PM
 */

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Tool;
use App\ToolPDF;
use App\VentaArticulo;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PagosVentaReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "COMPROBANTE C";
    private $request =  null;

    function __construct(Request $request)
    {
        $this->datos['venta'] = VentaArticulo::find($request->get('id'));
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
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 9);

            /*
       * QR
       */
            $y = $pdf->GetY(); //obtengo la posicion en Y

            $style = array('width' => 0.6, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $code = $this->datos['venta']->getCode().' | '.$this->datos['venta']->cliente->razon_social.' | '.$this->datos['venta']->registro;

            $pdf->writeHTML(view('cpanel.report.pagosventa.tabla', $this->datos)->render(), true, false, true, false, '');
            $pdf->write2DBarcode($code, 'QRCODE,Q', 150, $y, 25, 25, $style, 'N');

            $pdf->Output('pagos.pdf', 'i');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}