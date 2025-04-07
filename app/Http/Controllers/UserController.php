<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function updateAdminStatus(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario es una instancia del modelo User
        if ($user instanceof User) {
            $user->is_admin = $request->input('is_admin');
            $user->bloqueado = $request->input('bloqueado');
            if ($user->save()) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false], 500);
    }
}