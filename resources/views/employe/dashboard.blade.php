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
@if($demandes->count())
    @foreach($demandes as $demande)
        <div id="decision-{{ $demande->id }}" class="d-none">
            <div class="flex flex-col justify-center">
                <div>ROYAUME DU MAROC</div>
                <div>MINISTERE DE L'ITERIEUR</div>
                <div>WILAYA DE LA REGION DE L'ORIENTAL</div>
                <div>PREFECTURE D'OUJDA ANGAD</div>
                <div>CONSEIL DE LA PREFECTURE D'OUJDA ANGAD</div>
                <div>DIRECTION GENERALE DES SERVICES</div>
                <div>SERVICE DES RESOURCES HUMAINES</div>
                <div>AFFAIRES JURIDIQUES PATRIMOINE ET CONTENTIEUX</div>
            </div>
            <div>N°: {{ $demande->id }}</div>

            <div class="flex justify-center my-10">
                <div class="border border-black rounded-xl">
                    <div class="border-2 border-black rounded-xl p-5">
                        <span>Décision de congé Annuel</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mb-3 my-2">
                <span>Le Président du Conseil de la Préfecture d'Oujda-Angad</span>
            </div>
            <ul>
                <li>- Vu le Dahir N°1.58.008 du 4 Chaâbane 1377 (24 février 1958)...</li>
                <li>- Vu le Dahir N°1.11.10 du 14 Rabiî 1432 (18 février 2011)...</li>
                <li>- Vu le dahir n° 1.15.84 du 20 Ramadan 1436 (7 juillet 2015)...</li>
                <li>- Vu la demande présentée par l’intéressé.</li>
            </ul>

            <div class="flex justify-center mt-2">
                <div class="border-2 border-black rounded-xl p-3">
                    <span>DECIDE</span>
                </div>
            </div>

            <div class="my-2">Article unique : un congé annuel d’une durée de : {{ $demande->nombre_jrs }}</div>

            <div class="flex items-center space-x-4 mb-3">
                <div class="border border-black rounded-xl p-3">
                    Vingt ({{ $demande->nombre_jrs }}) jours ouvrables
                </div>
                <div>
                    est accordé au titre de l'année {{ \Carbon\Carbon::parse($demande->created_at)->format('Y') }} à
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div>{{ $demande->user->sexe === "homme" ? "MR" : "MME" }}: </div>
                <div class="p-3 border border-black rounded-xl">{{ $demande->user->name_fr }}</div>
            </div>

            <div class="flex items-center my-3 space-x-4">
                <div>Grade: </div>
                <div class="p-3 border border-black rounded-xl">{{ $demande->user->grade }}</div>
            </div>

            <div class="flex items-center space-x-1">
                <div>a l'Administration du conseil de la préfecture d'Oujda-Angad titulaire de la CNIE: </div>
                <div class="p-3 border border-black rounded-xl">{{ $demande->user->cin }}</div>
            </div>

            <div class="flex justify-end mt-2">
                <div>Oujda le: {{ now()->format('d/m/Y') }}</div>
            </div>
        </div>
    @endforeach
@endif



<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    function printDemande(id) {
        const content = document.getElementById('decision-' + id).innerHTML;
        const printWindow = window.open('', '', 'width=800,height=800');

        printWindow.document.write(`
            <html>
                <head>
                    <title>Décision de congé</title>
                    <!-- TailwindCSS precompiled CDN -->
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            body { margin: 20px; font-family: 'Times New Roman', serif; }
                        }
                    </style>
                </head>
                <body class="p-8">
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
    