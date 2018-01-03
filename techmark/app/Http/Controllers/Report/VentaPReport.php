<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 03/08/2017
 * Time: 03:44 PM
 */

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\VentaArticulo;
use App\ToolPDF;
use App\User;
use App\VentaProducto;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VentaPReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "COMPROBANTE B";
    private $request = null;

    function __construct(Request $request)
    {
        $this->datos['venta'] = VentaProducto::find($request->get('id'));
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
            $code = 'http://texmarckbolivia.com/';

            $pdf->writeHTML(view('cpanel.report.ventap.tabla', $this->datos)->render(), true, false, true, false, '');
            $pdf->write2DBarcode($code, 'QRCODE,Q', 150, $y, 25, 25, $style, 'N');

            $pdf->Output('detalles_productos.pdf', 'i');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}