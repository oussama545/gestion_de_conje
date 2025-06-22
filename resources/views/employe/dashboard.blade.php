@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Mes Demandes de Congé</h2>

    @if($demandes->count())
        <div class="table-responsive shadow-sm rounded" style="max-height: 600px; overflow-y: auto;">
            <table id="demandesTable" class="table table-striped table-hover align-middle text-nowrap mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Date début</th>
                        <th scope="col">Nombre de jours</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Type</th>
                        <th scope="col">Remplaçant</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Actions</th> <!-- Nouvelle colonne -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($demande->start_date)->format('d/m/Y') }}</td>
                            <td class="fw-semibold">{{ $demande->nombre_jrs }}</td>
                            <td><em class="text-secondary">{{ $demande->reason }}</em></td>
                            <td><span class="badge bg-info text-dark text-capitalize">{{ $demande->type }}</span></td>
                            <td>
                                @if($demande->remplacement)
                                    {{ $demande->remplacement->name_fr }}
                                @else
                                    <span class="text-muted fst-italic">Aucun</span>
                                @endif
                            </td>
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
                                <button
                                    class="btn btn-sm btn-outline-primary"
                                    onclick="printDemande({{ $demande->id }})"
                                >
                                    <i class="bi bi-printer-fill"></i> Imprimer
                                </button>

                                <!-- Contenu caché pour impression -->
                                <div id="demande-{{ $demande->id }}" class="d-none">
                                    <h3>Demande de Congé</h3>
                                    <p><strong>Date début :</strong> {{ \Carbon\Carbon::parse($demande->start_date)->format('d/m/Y') }}</p>
                                    <p><strong>Nombre de jours :</strong> {{ $demande->nombre_jrs }}</p>
                                    <p><strong>Motif :</strong> {{ $demande->reason }}</p>
                                    <p><strong>Type :</strong> {{ ucfirst($demande->type) }}</p>
                                    <p><strong>Remplaçant :</strong>
                                        @if($demande->remplacement)
                                            {{ $demande->remplacement->name_fr }}
                                        @else
                                            Aucun
                                        @endif
                                    </p>
                                    <p><strong>Statut :</strong> {{ ucfirst($demande->status) }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info fst-italic">Vous n'avez encore soumis aucune demande.</div>
    @endif
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    function printDemande(id) {
        const content = document.getElementById('demande-' + id).innerHTML;
        const printWindow = window.open('', '', 'width=600,height=600');

        printWindow.document.write(`
            <html>
                <head>
                    <title>Impression Demande de Congé</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
                    <style>
                        body { margin: 20px; font-family: Arial, sans-serif; }
                        h3 { margin-bottom: 20px; }
                        p { font-size: 1.1em; margin: 8px 0; }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
            </html>
        `);

        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }
</script>

@endsection
    