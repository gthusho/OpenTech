<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 03/08/2017
 * Time: 03:15 PM
 */

namespace App\Http\Controllers\Report;


use App\DetalleVentaProducto;
use App\Sucursal;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\DetalleVentaArticulo;
use App\Http\Controllers\Controller;
use App\ToolPDF;


class EgresosPReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l';
    private $titulo = "REPORTE DETALLE EGRESOS";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['egresos'] = DetalleVentaProducto::with('producto','sucursal','ventaproducto','talla')
            ->where('sucursal_id','<>','')
            ->fecha($request->get('fecha'))
            ->sucursal($request->get('sucursal'))
            ->sucursal($request->get('reportsuc'))
            ->producto($request->get('producto'))
            ->talla($request->get('talla'))
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
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->writeHTML(view('cpanel.report.egresosp.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('detalles_productos.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
        dd();
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('egresos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.egresosp.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}