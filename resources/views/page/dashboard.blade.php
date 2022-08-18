@extends('layout/index')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content-delivery')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
    integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('view-of-content')
    <h2>Dashboard</h2>
    @include('sweetalert::alert')
    <div class="row justify-content-md-start gy-3">
        <div class="col-md-auto">
            <div class="box-card d-flex aling-items-center">
                <img src="{{ asset('assets/icon/ic_total_asset.svg') }}" alt="icon total aset" class="icon-ds">
                <div class="total-text ms-3">
                    <p class="card-title">Total Aset</p>
                    <p class="card-desc">Keseluruhan aset yang dimiliki</p>
                    <h5 class="card-value">{{ $totalAsset }} unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="box-card d-flex aling-items-center">
                <img src="{{ asset('assets/icon/ic_tangible.svg') }}" alt="icon total aset" class="icon-ds">
                <div class="total-text ms-3">
                    <p class="card-title">Aset Berwujud</p>
                    <p class="card-desc">Keseluruhan aset berwujud</p>
                    <h5 class="card-value">{{ $totalTangibleAsset }} unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="box-card d-flex aling-items-center">
                <img src="{{ asset('assets/icon/ic_intangible.svg') }}" alt="icon total aset" class="icon-ds">
                <div class="total-text ms-3">
                    <p class="card-title">Aset Tak Berwujud</p>
                    <p class="card-desc">Keseluruhan aset tak berwujud</p>
                    <h5 class="card-value">{{ $totalIntangibleAsset }} unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="box-card d-flex aling-items-center">
                <img src="{{ asset('assets/icon/employee.svg') }}" alt="icon total aset" class="icon-ds">
                <div class="total-text ms-3">
                    <p class="card-title">Pengguna</p>
                    <p class="card-desc">Keseluruhan pengguna</p>
                    <h5 class="card-value">{{ $employee }} orang</h5>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="box-card d-flex aling-items-center">
                <img src="{{ asset('assets/icon/ic_total_price.svg') }}" alt="icon total aset" class="icon-ds">
                <div class="total-text ms-3">
                    <p class="card-title">Total Harga Aset</p>
                    <p class="card-desc">Total dari harga keseluruhan aset</p>
                    <h5 class="card-value">{{ "Rp " . number_format($totalPrice ,2,',','.');}}</h5>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="content-wrapper"">
        <canvas id="conditionChart"></canvas>
    </div>
    <div class="content-wrapper">
        <canvas id="growthChart"></canvas>
    </div>
    <script>
        let conditonData = {{ Js::from($condition) }}
        let yearLabel = {{ Js::from($yearLabel) }}
        let yearCount = {{ Js::from($yeaCount) }}
        Chart.defaults.color = "white";
        const conditionChartElement = document.getElementById('conditionChart').getContext('2d');
        const conditionChart = new Chart(conditionChartElement, {
            type: 'bar',
            data: {
                labels: ['Baik', 'Rusak Berat'],
                datasets: [{
                    label: 'Unit',
                    data: conditonData,
                    backgroundColor: 'rgba(12, 110, 253)',

                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(141, 140, 146)"
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(141, 140, 146)'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Kondisi Aset'
                    }
                }
            },
        });

        const growthChartElement = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(growthChartElement, {
            type: 'line',
            data: {
                labels: yearLabel,
                datasets: [{
                    label: 'Unit',
                    data: yearCount,
                    backgroundColor: 'rgba(12, 110, 253)',
                    borderColor: 'rgba(12, 110, 253)'

                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Grafik Belanja Modal aset',

                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: 'rgba(141, 140, 146)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(141, 140, 146)'
                        }
                    }
                }
            },
        });

    </script>
@endsection
