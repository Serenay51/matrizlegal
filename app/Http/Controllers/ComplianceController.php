<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Law;

class ComplianceController extends Controller
{
    public function search(Request $request)
    {
        $query = Law::query();

        // Filtros geográficos
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->filled('province')) {
            $query->where('province', 'like', '%' . $request->province . '%');
        }

        if ($request->filled('district')) {
            $query->where('district', 'like', '%' . $request->district . '%');
        }

        // Filtros de residuos
        if ($request->filled('waste')) {
            foreach ($request->waste as $type) {
                $query->whereJsonContains('waste', $type);
            }
        }

        // Filtro de aparatos
        if ($request->filled('equipment')) {
            foreach ($request->equipment as $equip) {
                $query->whereJsonContains('equipment', $equip);
            }
        }

        // Filtros de agua
        if ($request->filled('water')) {
            foreach ($request->water as $w) {
                $query->whereJsonContains('water', $w);
            }
        }

        // Filtro por tipo de actividad
        if ($request->filled('activity')) {
            $query->where('activity_type', $request->activity);
        }

        // Obtener resultados
        $laws = $query->get();

        return view('compliance', compact('laws'));
    }
}
