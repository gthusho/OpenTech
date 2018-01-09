<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 14/07/2017
 * Time: 11:38 AM
 */

namespace App\Http\Controllers\Report;

use App\DetalleVentaArticulo;
use App\Http\Controllers\Controller;
use App\ToolPDF;
use App\User;
use App\VentaArticulo;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Gasto;

class GastosReport extends Controller
{
    private $datos = null;
    private $horientacion = 'p';//'l';
    private $titulo = "GASTOS";
    private $request = null;

    function __construct(Request $request)
    {
        $this->datos['gastos'] = Gasto::with('sucursal','usuario')
            ->fecha2($request->get('fecha'))
            ->usuario($request->get('usuario'))
            ->sucursal($request->get('sucursal'))
            ->orderBy('id','desc')->get();
    }

    public function index(Request $request)
    {
        if (Auth::user()->can('allow-read')) {
            $pdf = new TCPDF('p', 'mm', 'Letter', true, 'UTF-8', false);
            ToolPDF::footerPDF($pdf);
            ToolPDF::headerPDF($pdf);
            ToolPDF::setMargen($pdf);
            $pdf->SetTitle('OpenRed By Liseth');
            $pdf->AddPage($this->horientacion);
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->Cell(0, 0, $this->titulo, '', 1, 'C', 0, '');
            $pdf->SetFont('helvetica', '', 8);
            $pdf->writeHTML(view('cpanel.report.gastos.tabla', $this->datos)->render(), true, false, true, false, '');
            $pdf->Output('gastos.pdf', 'i');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

    function excel(Request $request)
    {
        $this->request = $request;
        if (Auth::user()->can('allow-read')) {
            Excel::create($this->titulo, function ($excel) {
                $excel->sheet('gastos', function ($sheet) {
                    $sheet->row(1, array($this->titulo));
                    $sheet->loadView('cpanel.report.gastos.tabla', $this->datos);
                });
            })->export('xls');
        } else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
}