<?php

namespace App\Http\Controllers\Report;

use App\Articulo;
use App\ToolPDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Elibyy\TCPDF\TCPDF;

class ArticuloReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'p';
    private $titulo = "REPORTE ARTICULOS";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['articulos']=Articulo::with('categoria','marca','material','medida')
            ->marca($request->get('marca'))
            ->medida($request->get('medida'))
            ->material($request->get('material'))
            ->categoria($request->get('categoria'))
            ->tipo($request->get('type'),$request->get('s'))
            ->orderBy('nombre','asc')->get();
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
            $pdf->writeHTML(view('cpanel.report.articulos.tabla',$this->datos)->render(), true, false, true, false, '');
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
                $excel->sheet('articulo', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.articulos.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}
