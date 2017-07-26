<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 18/07/2017
 * Time: 02:59 PM
 */

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Producto;
use App\Proveedor;
use App\ToolPDF;
use App\User;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductosReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l';
    private $titulo = "REPORTE PRODUCTOS";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['productos'] = Producto::with('usuario')
            ->producto($request->get('s'))
            ->orderBy('estado','desc')
            ->orderBy('descripcion','asc')->get();
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
            $pdf->writeHTML(view('cpanel.report.productos.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('proveedores.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('producto', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.productos.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}