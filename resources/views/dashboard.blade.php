@extends('general.top')

@section('title', 'DASHBOARD')

@section('content')

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background-color: #4CAF50; color: white;">
                <div class="inner">
                    <h3>{{ $avurnavCount }}</h3>
                    <p>Nombre d'Avurnav</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('avurnav.index') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box" style="background-color: #FF9800; color: white;">
                <div class="inner">
                    <h3>{{ $pollutionCount }}</h3>
                    <p>Nombre de Pollutions</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('pollutions.index') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #4CAF50; color: white;">
                    <h5>Répartition des Types d'Événements</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTypes"></canvas>
                    <button class="btn btn-success mt-2" onclick="downloadChart('chartTypes', 'types_evenements.png')">Télécharger</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Répartition des Causes d'Événements</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartCauses"></canvas>
                    <button class="btn btn-primary mt-2" onclick="downloadChart('chartCauses', 'causes_evenements.png')">Télécharger</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5>Répartition des Bilans SAR par Région</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartRegions"></canvas>
                    <button class="btn btn-warning mt-2" onclick="downloadChart('chartRegions', 'bilan_sar_regions.png')">Télécharger</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function downloadChart(chartId, filename) {
        const canvas = document.getElementById(chartId);
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = filename;
        link.click();
    }

    const typesLabels = @json($typesData->pluck('name'));
    const typesCounts = @json($typesData->pluck('count'));
    new Chart(document.getElementById('chartTypes').getContext('2d'), {
        type: 'bar',
        data: { labels: typesLabels, datasets: [{ label: 'Nombre d\'événements', backgroundColor: '#4CAF50', data: typesCounts }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    const causesLabels = @json($causesData->pluck('name'));
    const causesCounts = @json($causesData->pluck('count'));
    new Chart(document.getElementById('chartCauses').getContext('2d'), {
        type: 'bar',
        data: { labels: causesLabels, datasets: [{ label: 'Nombre d\'événements', backgroundColor: '#FF9800', data: causesCounts }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    const regionsLabels = @json($regionsData->pluck('name'));
    const regionsCounts = @json($regionsData->pluck('count'));
    new Chart(document.getElementById('chartRegions').getContext('2d'), {
        type: 'bar',
        data: { labels: regionsLabels, datasets: [{ label: 'Nombre de bilans SAR', backgroundColor: '#FFC107', data: regionsCounts }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>

@endsection
