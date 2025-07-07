@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">Liste des Employés</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
        <i class="bi bi-person-plus-fill"></i> Ajouter un Employé
    </button>

    <!-- Users Table -->
    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-hover table-bordered align-middle text-nowrap">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>#</th>
                    <th>N° PPR</th>
                    <th>Nom (FR)</th>
                    <th>Nom (AR)</th>
                    <th>Email</th>
                    <th>Sexe</th>
                    <th>Date de Naissance</th>
                    <th>CIN</th>
                    <th>Date de Recrutement</th>
                    <th>Poste</th>
                    <th>Affectation/Détachement</th>
                    <th>Grade</th>
                    <th>Service</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->name_fr }}</td>
                        <td>{{ $user->name_ar }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->sexe == 'homme')
                                <span class="badge bg-info text-dark">Homme</span>
                            @elseif($user->sexe == 'femme')
                                <span class="badge bg-warning text-dark">Femme</span>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $user->cin }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($user->date_recrutment)->format('d/m/Y') }}</td>
                        <td>{{ $user->position }}</td>
                        <td>{{ $user->affectation_detachement ?? '-' }}</td>
                        <td>{{ $user->grade }}</td>
                        <td>{{ $user->service ?? '-' }}</td>
                        <td class="text-center">
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-success">Employé</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form method="POST" action="/admin/user/{{ $user->id }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center fst-italic text-muted">Aucun utilisateur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="/admin/users" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-primary fw-bold" id="createUserModalLabel">Ajouter un nouvel Employé</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nom (FR) <span class="text-danger">*</span></label>
                <input type="text" name="name_fr" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nom (AR) <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Mot de passe <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Sexe <span class="text-danger">*</span></label>
                <select name="sexe" class="form-select" required>
                    <option value="" disabled selected>Choisir...</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Date de Naissance <span class="text-danger">*</span></label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">CIN <span class="text-danger">*</span></label>
                <input type="text" name="cin" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Date de Recrutement <span class="text-danger">*</span></label>
                <input type="date" name="date_recrutment" class="form-control" required>
            </div>
    
            <!-- POSITION -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Poste <span class="text-danger">*</span></label>
                <select name="position" class="form-select" required>
                    <option value="" disabled selected>Choisir...</option>
                    <option value="EN ACTIVITÉ - القيام بالوظيفة">EN ACTIVITÉ - القيام بالوظيفة</option>
                    <option value="ABONDANT DE POSTE (RÉVOQUÉ) - التخلي عن الوظيفة">ABONDANT DE POSTE (RÉVOQUÉ) - التخلي عن الوظيفة</option>
                    <option value="CONGÉ DE MALADIE (LONGUE DURÉE) - عطلة مرضية طويلة الأمد">CONGÉ DE MALADIE (LONGUE DURÉE) - عطلة مرضية طويلة الأمد</option>
                    <option value="CONGÉ DE MALADIE (MOYEN DURÉE) - عطلة مرضية متوسطة الأمد">CONGÉ DE MALADIE (MOYEN DURÉE) - عطلة مرضية متوسطة الأمد</option>
                    <option value="DÉCHARGE SYNDICALE - التفرغ النقابي">DÉCHARGE SYNDICALE - التفرغ النقابي</option>
                    <option value="DÉMISSION - استقالة">DÉMISSION - استقالة</option>
                    <option value="DDÉTACHEMENT - الإلحاق">DÉTACHEMENT - الإلحاق</option>
                    <option value="LICENCIEMENT - الفصل من العمل">LICENCIEMENT - الفصل من العمل</option>
                    <option value="MISE À DISPOSITION - وضع رهن الإشارة">MISE À DISPOSITION - وضع رهن الإشارة</option>
                    <option value="MISE EN DISPONIBILITÉ - الإحالة على الاستيداع">MISE EN DISPONIBILITÉ - الإحالة على الاستيداع</option>
                    <option value="MUTATION - الانتقال">MUTATION - الانتقال</option>
                    <option value="POSITION MILITAIRE - وضعية الجندية">POSITION MILITAIRE - وضعية الجندية</option>
                    <option value="STAGIAIRE - متدرب">STAGIAIRE - متدرب</option>
                    <option value="SUSPENSION PROVISOIRE -  توقيف مؤقت عن العمل">SUSPENSION PROVISOIRE -  توقيف مؤقت عن العمل</option>
            
                </select>
            </div>




            <div class="col-md-4">
                <label class="form-label fw-semibold">Affectation / Détachement</label>
                <input type="text" name="affectation_detachement" class="form-control">
            </div>

            

             <!-- GRADE -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Grade <span class="text-danger">*</span></label>
                <select name="grade" class="form-select" required>
                    <option value="" disabled selected>Choisir...</option>
                    <option value="Adjoint Administratif 1er Grade">Adjoint Administratif 1er Grade</option>
                    <option value="Adjoint administratif grade principal">Adjoint administratif grade principal</option>
                    <option value="Adjoint administratif 2ème grade">Adjoint administratif 2ème grade</option>
                    <option value="Adjoint administratif 3ème grade">Adjoint administratif 3ème grade</option>
                    <option value="Adjoint administratif 4ème grade">Adjoint administratif 4ème grade</option>
                    <option value="Adjoint de santé breveté">Adjoint de santé breveté</option>
                    <option value="Adjoint de santé breveté principal">Adjoint de santé breveté principal</option>
                    <option value="Adjoint de santé diplômé d'État">Adjoint de santé diplômé d'État</option>
                    <option value="Adjoint de santé diplômé d'État spécialiste">Adjoint de santé diplômé d'État spécialiste</option>
                    <option value="Adjoint de santé diplômé d'État spécialiste principal">Adjoint de santé diplômé d'État spécialiste principal</option>
                    <option value="Adjoint technique grade principal">Adjoint technique grade principal</option>
                    <option value="Adjoint technique 1er grade">Adjoint technique 1er grade</option>
                    <option value="Adjoint technique 2ème grade">Adjoint technique 2ème grade</option>
                    <option value="Adjoint technique 3ème grade">Adjoint technique 3ème grade</option>
                    <option value="Adjoint technique 4ème grade">Adjoint technique 4ème grade</option>
                    <option value="Architecte 1er grade">Architecte 1er grade</option>
                    <option value="Architecte en chef 1er grade">Architecte en chef 1er grade</option>
                    <option value="Architecte grade principal">Architecte grade principal</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                    <option value="Autres Contractuels">Autres Contractuels</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Service</label>
                <input type="text" name="service" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Rôle <span class="text-danger">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="employee" selected>Employé</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap Icons CDN for icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap 5 JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
