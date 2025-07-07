<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeConge;
use App\Models\User;


class AdminController extends Controller
{
   public function index()
    {
        $userCount = \App\Models\User::where('role', 'employee')->count();
        $acceptedCount = \App\Models\DemandeConge::where('status', 'accepted')->count();
        $pendingCount = \App\Models\DemandeConge::where('status', 'pending')->count();
        $refusedCount = \App\Models\DemandeConge::where('status', 'refused')->count();

        return view('admin.dashboard', compact('userCount', 'acceptedCount', 'pendingCount', 'refusedCount'));
    }


    public function users() {
        $currentUserId = auth()->id(); // Get current authenticated user's ID

        $users = User::where('id', '!=', $currentUserId)->get();

        return view('admin.users', compact('users'));
    }


public function storeUser(Request $request) {
    $request->validate([
        'name_fr' => 'required|string',
        'name_ar' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'date_naissance' => 'required|date',
        'sexe' => 'required|in:homme,femme',
        'cin' => 'required|string|unique:users,cin',
        'date_recrutment' => 'required|date',
        'position' => 'required|string',
        'affectation_detachement' => 'nullable|string',
        'grade' => 'required|string',
        'service' => 'nullable|string',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name_fr' => $request->name_fr,
        'name_ar' => $request->name_ar,
        'email' => $request->email,
        'date_naissance' => $request->date_naissance,
        'sexe' => $request->sexe,
        'cin' => $request->cin,
        'date_recrutment' => $request->date_recrutment,
        'position' => $request->position,
        'affectation_detachement' => $request->affectation_detachement,
        'grade' => $request->grade,
        'service' => $request->service,
        'password' => bcrypt($request->password),
        'role' => 'employee', // or get from form if needed
    ]);

    return back()->with('success', 'Employé ajouté avec succès.');
}


    public function destroyUser(User $user) {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function demandes() {
        $demandes = DemandeConge::with('user')->latest()->get();
        return view('admin.demandes', compact('demandes'));
    }

    public function updateStatus(Request $request, DemandeConge $demande) {
        $request->validate(['status' => 'required|in:accepted,refused']);
        $demande->update(['status' => $request->status]);
        return back()->with('success', 'Demande mise à jour.');
    }
}
