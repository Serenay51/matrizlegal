<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'suggestion' => 'required|string',
        ]);
    
        // Guardar la sugerencia en la base de datos
        Suggestion::create($request->all());
    
        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Gracias por tu sugerencia!');
    }
}