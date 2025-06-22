@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de bord Administrateur</h1>

 
    {{-- Analytics --}}
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Employés</h5>
                    <p class="card-text display-6">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Demandes Acceptées</h5>
                    <p class="card-text display-6">{{ $acceptedCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Demandes en Attente</h5>
                    <p class="card-text display-6">{{ $pendingCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Demandes Refusee</h5>
                    <p class="card-text display-6">{{ $refusedCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
