@extends('layouts.app') 

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Faire une Demande de Congé</h2>
    <form method="POST" action="/employee/demande">
        @csrf
        <div class="mb-3">
            <label for="start_date" class="form-label">Date début</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nombre_jrs" class="form-label">Nombre de jours</label>
            <input type="number" name="nombre_jrs" id="nombre_jrs" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type de congé</label>
            <select name="type" id="type" class="form-select" required>
                <option value="conge annuel">Congé Annuel</option>
                <option value="conge maladie">Congé Maladie</option>
                <option value="conge maternite">Congé Maternité</option>
                <option value="congé de paternité">congé de paternité</option>
                <option value="congé de mariage">congé de mariage</option>
                <option value="congé de Haj">congé de Haj</option>
                <option value="congé administratif">congé administratif</option>
                <option value="autre" selected>Autre</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Motif</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="remplacement_id" class="form-label">Remplaçant (optionnel)</label>
            <select name="remplacement_id" id="remplacement_id" class="form-select">
                <option value="">-- Aucun --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" data-email="{{ strtolower($user->email) }}">
                        {{ $user->name_fr }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>.

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (Select2 needs it) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function matchCustom(params, data) {
        // Si pas de terme de recherche, afficher tout
        if ($.trim(params.term) === '') {
            return data;
        }

        // Terme de recherche (en minuscules)
        const term = params.term.toLowerCase();

        // Texte affiché (en minuscules)
        const text = (data.text || '').toLowerCase();

        // Email depuis l'attribut data-email
        const email = $(data.element).data('email') || '';

        // Recherche terme dans texte ou email
        if (text.indexOf(term) > -1 || email.indexOf(term) > -1) {
            return data;
        }

        // Ne pas afficher l'option si pas de correspondance
        return null;
    }

    $('#remplacement_id').select2({
        placeholder: "Sélectionner un remplaçant",
        allowClear: true,
        width: '100%',
        matcher: matchCustom
    });
});
</script>
@endsection
