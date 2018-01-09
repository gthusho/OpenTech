<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 02/08/2017
 * Time: 01:11 PM
 */

namespace App\Http\Controllers\Report;
use App\IngresosProducto;
use App\ToolPDF;
use App\User;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class IngresosPReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l'p;
    private $titulo = "REPORTE INGRESOS PRODUCTOS";
    private $request =  null;

    function __construct(Request $request)
    {
        $this->datos['ingresos'] = IngresosProducto::with('producto','sucursal','produccion','talla')
            ->fecha2($request->get('fecha'))
            ->sucursal($request->get('sucursal'))
            ->producto($request->get('producto'))
            ->talla($request->get('talla'))
            ->sucursal($request->get('reportsuc'))
            ->where('estado','t')
            ->orderBy('id','desc')->get();
    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $pdf = new TCPDF('p','mm','Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By Liss');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 25);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->writeHTML(view('cpanel.report.ingresosp.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('ingresos_productos.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('ingresos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.ingresosp.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

}