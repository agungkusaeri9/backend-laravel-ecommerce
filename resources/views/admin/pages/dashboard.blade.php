@extends('admin.templates.default')

@section('content')
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendapatan Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($income['today']) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendapatan Bersih</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($income['total']) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Ongkir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($shipping_costs) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Transaksi Total</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($transaction_total) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-inventory fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transactions }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction_latest as $item)
                                <tr>
                                    <td>{{ $item->uuid }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ number_format($item->transaction_total) }}</td>
                                    <td>
                                        @if ($item->transaction_status == 'SUCCESS')
                                        <span class="badge badge-success">SUCCESS</span>
                                        @elseif ($item->transaction_status == 'PENDING')
                                        <span class="badge badge-warning">PENDING</span>
                                        @elseif ($item->transaction_status == 'DELIVERY')
                                        <span class="badge badge-info">DELIVERY</span>
                                        @elseif ($item->transaction_status == 'FAILED')
                                        <span class="badge badge-danger">FAILED</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Masuk </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> SUCCESS
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> DELIVERY
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> PENDING
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> FAILED
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('afterScripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["SUCCES","DELIVERY", "PENDING", "FAILED"],
    datasets: [{
      data: [{{ $pie['success'] }},{{ $pie['delivery'] }}, {{ $pie['pending'] }}, {{ $pie['failed'] }}],
      backgroundColor: ['#09ff00','#2ec1f2', '#fcf400', '#fc0000'],
      hoverBackgroundColor: ['#06ba00','#00b2ed', '#ded700', '#d10000'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>
@endpush