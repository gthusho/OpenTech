<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 03/08/2017
 * Time: 09:23 PM
 */

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\VentaArticulo;
use App\ToolPDF;
use App\VentaProducto;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class VentasPCredReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l';
    private $titulo = "REPORTE VENTAS AL CREDITO";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['ventas'] = VentaProducto::fecha($request->get('fecha'))
            ->where('estado','t')->where('tipo_pago','Credito')
            ->codigo($request->get('s'))
            ->sucursal($request->get('sucursal'))
            ->orderBy('id','desc')->get();

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
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->writeHTML(view('cpanel.report.ventascreditop.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('detalles_productos.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('ventas', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.ventascreditop.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}