<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 02/08/2017
 * Time: 11:50 PM
 */

namespace App\Http\Controllers\Report;


use App\VentaArticulo;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VentasCredReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l';
    private $titulo = "REPORTE VENTAS AL CREDITO";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['ventas'] = VentaArticulo::with('sucursal','cliente')
            ->fecha($request->get('fecha'))
            ->where('estado','t')->where('tipo_pago','Credito')
            ->fecha($request->get('f'))
            ->codigo($request->get('s'))
            ->sucursal($request->get('sucursal'))
            ->cliente($request->get('cliente'))
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
            $pdf->writeHTML(view('cpanel.report.ventascredito.tabla',$this->datos)->render(), true, false, true, false, '');
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
                    $sheet->loadView('cpanel.report.ventascredito.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

}