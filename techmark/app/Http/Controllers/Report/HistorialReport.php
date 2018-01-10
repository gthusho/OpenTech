<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 26/06/2017
 * Time: 10:37 PM
 */

namespace App\Http\Controllers\Report;


use App\Clientes;
use App\Http\Controllers\Controller;
use App\ToolPDF;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class HistorialReport extends Controller
{
    private $datos = null;
    private $horientacion = 'l';//'l'p;
    private $titulo = "REPORTE HISTORIAL ";
    private $request =  null;
    function __construct(Request $request)
    {
        $this->datos['historial']=Clientes::find($request->get('id'));
    }
    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $pdf = new TCPDF('p','mm','Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By Diego');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 25);
            $pdf->Cell(0, 0, $this->titulo.strtoupper($this->datos['historial']->razon_social), '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->writeHTML(view('cpanel.report.historial.tabla',$this->datos)->render(), true, false, true, false, '');
            $pdf->Output('historial.pdf', 'i');
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function excel(Request $request){
        $this->request = $request;
        if(Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('cliente', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.historial.tabla', $this->datos);
                });
            })->export('xls');
        } else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

}

