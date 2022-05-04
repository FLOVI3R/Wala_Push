<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\categoria;

class AdminController extends Controller
{
    public function showAdminBlade() {
        $users = User::where('deleted', '!=', 1)->get();
        return view('admin.admin')->with('users', $users);
    }

    public function showUserEditBlade($id) {
        $user = User::FindOrFail($id);
        return view('admin.user_edit')->with('user', $user);
    }

    public function userActivate($id) {
        $user = User::FindOrFail($id);
        if($user->email_verified_at == null) {
            return redirect()->action([AdminController::class, 'showAdminBlade'])->with('status', 'Es necesario que el usuario confirme su email para activar la cuenta');
        }else {
            $user->actived = '1';
            $user->update();
            return redirect()->action([AdminController::class, 'showAdminBlade'])->with('status', 'Usuario activado correctamente');
        }
    }

    public function userDeactivate($id) {
        $user = User::FindOrFail($id);
        $user->actived = '0';
        $user->update();
        return redirect()->action([AdminController::class, 'showAdminBlade'])->with('status', 'Usuario desactivado correctamente');
    }

    public function userUpdate(Request $request, $id) {
        $user = User::FindOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->localidad = $request->input('localidad');
        $user->role = $request->input('role');
        $user->update();
        return redirect()->action([AdminController::class, 'showAdminBlade'])->with('status', 'Usuario editado correctamente');
    }

    public function userSoftDelete($id) {
        $user = User::FindOrFail($id);
        $user->deleted = '1';
        $user->update();
        return redirect()->action([AdminController::class, 'showAdminBlade'])->with('status', 'Usuario eliminado correctamente');
    }
}
