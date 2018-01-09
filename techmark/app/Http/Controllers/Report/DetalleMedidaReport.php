<?php

namespace App\Http\Controllers\Report;

use App\ToolPDF;
use App\VisitaCotizacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Elibyy\TCPDF\TCPDF;

class DetalleMedidaReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'p';
    private $titulo = "MEDIDAS DE ";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['visita'] = VisitaCotizacion::find($request->get('visita'));
    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $pdf = new TCPDF('p','mm','Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By LDiego');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 25);

            $y = $pdf->GetY(); //obtengo la posicion en Y

            $style = array('width' => 0.6, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $code = 'http://texmarckbolivia.com/';

            $pdf->Cell(0, 0, $this->titulo.strtoupper($this->datos['visita']->cliente->razon_social), '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->writeHTML(view('cpanel.report.detallemedida.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->write2DBarcode($code, 'QRCODE,Q', 150, $y, 25, 25, $style, 'N');
            $pdf->Output('detallemedidas.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('articulo', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.detallemedida.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}
