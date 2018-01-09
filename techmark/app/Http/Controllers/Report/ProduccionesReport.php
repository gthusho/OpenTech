<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 16/07/2017
 * Time: 12:55 PM
 */

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Produccion;
use App\ProduccionCliente;
use App\ToolPDF;
use App\Trabajador;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
class ProduccionesReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'p';
    private $titulo = "REPORTE PRODUCCIONES";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['producciones'] = Produccion::with('trabajador','usuario','sucursal'/*,'almacen'*/)
            //->fecha($request->get('fecha'))
            ->where('estado','t') ->orwhere('estado','c')
            ->fecha2($request->get('fecha'))
            ->sucursal($request->get('sucursal'))
            ->trabajador($request->get('trabajador'))
            ->destino($request->get('s'))
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
            $pdf->writeHTML(view('cpanel.report.producciones.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('articulos.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('produccion', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.producciones.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

}