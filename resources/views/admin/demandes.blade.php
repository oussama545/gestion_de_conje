@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Gestion des Demandes de Congé</h2>

    @if($demandes->isEmpty())
        <div class="alert alert-info fst-italic">Aucune demande de congé trouvée.</div>
    @else
        <div class="table-responsive shadow-sm rounded" style="max-height:600px; overflow-y:auto;">
            <table class="table table-striped table-hover align-middle text-nowrap mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Employé</th>
                        <th>Start date</th>
                        <th>Nombre de jours</th>
                        <th>Raison</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                    <tr>
                        <td>
                            <strong>{{ $demande->user->name_fr ?? $demande->user->name ?? 'N/A' }}</strong><br>
                            <small class="text-muted">{{ $demande->user->email ?? '' }}</small>
                        </td>
                        <td>
                            <span>{{ \Carbon\Carbon::parse($demande->start_date)->format('d/m/Y') }}</span>
                        </td>
                        <td class="fw-semibold text-center">{{ $demande->nombre_jrs ?? '—' }}</td>
                        <td><em class="text-secondary">{{ Str::limit($demande->reason, 50) }}</em></td>
                        <td><span class="badge bg-info text-dark text-capitalize">{{ $demande->type }}</span></td>
                        <td>
                            @if($demande->status === 'accepted')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle-fill me-1"></i> Acceptée
                                </span>
                            @elseif($demande->status === 'refused')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle-fill me-1"></i> Refusée
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-hourglass-split me-1"></i> En attente
                                </span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="/admin/demande/{{ $demande->id }}/status" class="d-flex gap-2">
                                @csrf
                                <select name="status" class="form-select form-select-sm" required>
                                    <option value="" disabled selected>Choisir...</option>
                                    <option value="accepted">Accepter</option>
                                    <option value="refused">Refuser</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection
