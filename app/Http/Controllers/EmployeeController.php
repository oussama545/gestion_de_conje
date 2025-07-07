<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeConge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    public function dashboard()
    {
        $demandes = DemandeConge::with('user') // ⚠️ Chargement de la relation
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('employe.dashboard', compact('demandes'));
    }

    public function showDemandeForm()
    {
        // Récupérer tous les utilisateurs sauf l'utilisateur courant (optionnel)
        $users = User::where('id', '!=', auth()->id())->orderBy('name_fr')->get();

        return view('employe.demande-form', compact('users'));
    }

public function storeDemande(Request $request)
{
    $validated = $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'nombre_jrs' => 'required|integer|min:1',
        'reason' => 'required|string|max:1000',
        'type' => 'required|string',
        'remplacement_id' => 'nullable|exists:users,id',
    ]);

    DemandeConge::create([
        'user_id' => Auth::id(),
        'start_date' => $validated['start_date'],
        'nombre_jrs' => $validated['nombre_jrs'],
        'reason' => $validated['reason'],
        'status' => 'pending',
        'type' => $validated['type'],
        'remplacement_id' => $validated['remplacement_id'] ?? null,
    ]);

    return redirect('/employee/dashboard')->with('success', 'Demande de congé créée avec succès.');
}
}