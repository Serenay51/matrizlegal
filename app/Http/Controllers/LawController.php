<?php

namespace App\Http\Controllers;

use App\Models\Law;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawController extends Controller
{
    public function index()
    {
        $laws = Law::paginate(10);

        return view('laws.index', compact('laws'));
    }

    public function create()
    {
        return view('laws.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Nacional,Provincial,CABA,La Matanza',
            'description' => 'required|string',
            'link' => 'required|url',
            'law_creation_date' => 'nullable|date',
        ]);

        Law::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'link' => $request->link,
            'law_creation_date' => $request->law_creation_date,
            
        ]);

        return redirect()->route('laws.index')->with('success', 'Ley agregada correctamente.');
    }

    public function search(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verificar si el usuario está bloqueado
        if ($user->bloqueado) {
            return redirect()->route('dashboard')->with('error', 'Has alcanzado el límite de búsquedas. Suscríbete al plan premium para continuar.');
        }

        // Incrementar el contador de búsquedas para usuarios no premium
        if ($user->is_admin == 0) {
            $searchCount = session('search_count', 0) + 1;

            if ($searchCount >= 5) {
                // Bloquear al usuario
                $user->bloqueado = true;
                $user->save();

                return redirect()->route('dashboard')->with('error', 'Has alcanzado el límite de búsquedas. Suscríbete al plan premium para continuar.');
            }

            session(['search_count' => $searchCount]);
        }

        // Realizar la búsqueda
        $laws = Law::query();

        if ($request->filled('query')) {
            $laws->where('name', 'LIKE', '%' . $request->query('query') . '%')
                ->orWhere('description', 'LIKE', '%' . $request->query('query') . '%');
        }

        if ($request->filled('name')) {
            $laws->where('name', 'LIKE', '%' . $request->query('name') . '%');
        }

        if ($request->filled('category')) {
            $laws->where('category', 'LIKE', '%' . $request->query('category') . '%');
        }

        if ($request->filled('description')) {
            $laws->where('description', 'LIKE', '%' . $request->query('description') . '%');
        }

        return view('dashboard', ['laws' => $laws->get()]);
    }
}

