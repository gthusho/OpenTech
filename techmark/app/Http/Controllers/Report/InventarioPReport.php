<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 26/07/2017
 * Time: 08:36 PM
 */

namespace App\Http\Controllers\Report;


use App\ExistenciaProducto;
use App\Http\Controllers\Controller;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InventarioPReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l'p;
    private $titulo = "INVENTARIO PRODUCTOS";
    private $request =  null;

    function __construct(Request $request)
    {
        $this->datos['productos'] = ExistenciaProducto::with('producto','talla','sucursal')
            ->sucursal($request->get('sucursal'))
            ->producto($request->get('producto'))
            ->talla($request->get('talla'))
            ->orderBy('producto_id','desc')->get();
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
            $pdf->writeHTML(view('cpanel.report.inventariop.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('ingresos_articulos.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('productos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.inventariop.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}