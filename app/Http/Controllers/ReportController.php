<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\anuncio;
use App\Models\categoria;
use App\Models\transaccion;
use PDF;

class ReportController extends Controller
{
    public function showReportsBlade() {
        $categoria = categoria::all();
        return view('admin.reports')->with('categoria', $categoria);
    }
    
    public function createCategoryPDF(Request $request) {
        $anuncioaux = new anuncio;
        $anuncioaux->id_categoria = $request->input('category');
        $anuncio = anuncio::select('*')->where([['vendido', '=', 1],['id_categoria', '=', $anuncioaux->id_categoria]])->get();
        $pdf = PDF::loadView('pdf.categoryPDF', compact('anuncio'));
        return $pdf->download('Categorias.pdf');
    }

    public function createSellerPDF() {
        $transaccion = transaccion::all();
        $anuncio = anuncio::where('vendido', '==', 1);
        foreach($anuncio as $anuncio) {
            $user += User::where('id', '==', $anuncio->id_vendedor);
        }
        $pdf = PDF::loadView('pdf.sellerPDF')->with('user', $user);
        return $pdf->download('Valoraciones.pdf');
    }
}
