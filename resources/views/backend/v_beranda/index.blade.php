@extends('backend.v_layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Selamat Datang -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat Datang, {{ Auth::user()->nama }} di Dashboard</h4>                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik & Laporan -->
<!-- Grafik Rating & Booking per Bulan Kiri-Kanan -->
<div class="row mt-4">
    <!-- Grafik Rating -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">📊 Grafik Rata-rata Rating per Bulan</h5>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="ratingChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Booking per Bulan -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📈 Grafik Booking per Bulan ({{ date('Y') }})</h5>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="bookingPerBulanChart"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- Grafik Ruangan Terfavorit -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📊 Grafik Ruangan Terfavorit</h5>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="ruanganChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Laporan Keuangan -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">💰 Laporan Keuangan</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Pendapatan</span>
                        <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Pembayaran Masuk</span>
                        <span>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Jumlah User yang booking</span>
                        <span>{{ $jumlahLunas }} orang</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Booking</span>
                        <span>{{ $totalBooking }} transaksi</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Grafik Rating per Bulan
    const ctxRating = document.getElementById('ratingChart').getContext('2d');
    new Chart(ctxRating, {
        type: 'line',
        data: {
            labels: {!! json_encode($labelsPerBulan) !!},
            datasets: [{
                label: 'Rata-rata Rating',
                data: {!! json_encode($dataRatingPerBulan) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    
    // Grafik Booking per Bulan
    const ctxBooking = document.getElementById('bookingPerBulanChart').getContext('2d');
    new Chart(ctxBooking, {
        type: 'line',
        data: {
            labels: {!! json_encode($labelsPerBulan) !!},
            datasets: [{
                label: 'Jumlah Booking',
                data: {!! json_encode($dataPerBulanChart) !!},
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: '#36A2EB',
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#36A2EB'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    // Grafik Ruangan Terfavorit
    const ctxRuangan = document.getElementById('ruanganChart').getContext('2d');
    new Chart(ctxRuangan, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Booking',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush
