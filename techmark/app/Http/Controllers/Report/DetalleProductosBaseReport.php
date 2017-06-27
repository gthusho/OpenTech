<?php

namespace App\Http\Controllers\Report;

use App\DetalleProductoBase;
use App\ToolPDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Elibyy\TCPDF\TCPDF;

class DetalleProductosBaseReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "REPORTE DETALLE PRODUCTOS";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['detalles']=DetalleProductoBase::with('usuario','prodbase','talla','material')
            ->talla($request->get('talla'))
            ->material($request->get('material'))
            ->detProdBase($request->get('s'))
            ->orderBy('producto_base_id')
            ->orderBy('material_id')
            ->orderBy('talla_id')->get();
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
            $pdf->writeHTML(view('cpanel.report.detprodbases.tabla',$this->datos)->render(), true, false, true, false, '');
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
                $excel->sheet('detalle_productos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.detprodbases.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}
