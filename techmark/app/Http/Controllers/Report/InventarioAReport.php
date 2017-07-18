<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 17/07/2017
 * Time: 06:59 PM
 */

namespace App\Http\Controllers\Report;


use App\ExistenciaArticulo;
use App\Http\Controllers\Controller;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InventarioAReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l'p;
    private $titulo = "INVENTARIO ARTICULO";
    private $request =  null;

    function __construct(Request $request)
    {
        $this->datos['articulos'] = ExistenciaArticulo::with('articulo','almacen','sucursal','categoria')
            ->sucursal($request->get('sucursal'))
            ->articulo($request->get('articulo'))
            ->orderBy('articulo_id','desc')->get();
    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $pdf = new TCPDF('p','mm','Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By Gthusho');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 25);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->writeHTML(view('cpanel.report.inventarioa.tabla',$this->datos)->render(), true, false, true, false, '');
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
                $excel->sheet('articulos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.inventarioa.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}