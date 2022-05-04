<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\anuncio;
use App\Models\User;
use App\Models\categoria;

class AnuncioController extends Controller
{
    public function showUserMenuBlade() {
        $ads = anuncio::where('deleted', '!=', 1)->get();
        $categoria = categoria::all();
        return view('user.user_menu')->with('ads', $ads)->with('categoria', $categoria);
    }

    public function adCreate(Request $request) {
        $ad = new anuncio;
        $ad->producto = $request->input('name');
        $ad->descripcion = $request->input('description');
        $ad->precio = $request->input('price');
        $ad->nuevo = $request->input('state');
        $ad->id_vendedor = auth()->user()->id;
        $ad->nuevo = '0';
        $ad->id_categoria = $request->input('category');
        $ad->save();
        return redirect()->action([AnuncioController::class, 'showUserMenuBlade'])->with('status', 'Anuncio creado correctamente');
    }

    public function adSoftDelete($id) {
        $ad = anuncio::FindOrFail($id);
        $ad->deleted = '1';
        $ad->update();
        return redirect()->action([AnuncioController::class, 'showUserMenuBlade'])->with('status', 'Anuncio eliminado correctamente');
    }
}
