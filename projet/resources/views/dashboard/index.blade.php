@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="mb-4">📊 Dashboard</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5>Produits</h5>
                <h3>{{ $totalProduits }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5>Catégories</h5>
                <h3>{{ $totalCategories }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5>Fournisseurs</h5>
                <h3>{{ $totalFournisseurs }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5>Stock total</h5>
                <h3>{{ $stockTotal }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <div class="card p-3">
            <h5>Entrées / Sorties (7 jours)</h5>
            <canvas id="chartMouvements"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3">
            <h5>Produits en rupture</h5>

            @if(count($produitsRupture) == 0)
                <p class="text-success">Aucun produit en rupture</p>
            @else
                <ul>
                    @foreach($produitsRupture as $p)
                        <li>{{ $p->nom }} ({{ $p->quantite }})</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>

<script>
    new Chart(document.getElementById('chartMouvements'), {
        type: 'bar',
        data: {
            labels: @json($chartData['labels']),
            datasets: [
                {
                    label: 'Entrées',
                    data: @json($chartData['entrees']),
                },
                {
                    label: 'Sorties',
                    data: @json($chartData['sorties']),
                }
            ]
        }
    });
</script>

@endsection
