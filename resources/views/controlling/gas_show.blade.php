@extends('layouts.main')

@section('header')
  @include('layouts.header')
@endsection

@section('sidebar')
  @include('layouts.sidebar')
@endsection

@section('switcher')
  @include('layouts.switcher')
@endsection

@section('content')

<!--start content-->
<main class="page-content">
  <!-- Title Page -->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Project {{ $project->code }} Plan</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/controlling/gas/{{ $gasEquipment->id }}">
              <i class="bi bi-clipboard-data"></i> {{ $gasEquipment->name }} Controlling
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $project->code }} Plan
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  {{-- Electric Plan --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">{{ $project->code }} {{ $gasEquipment->name }} Gas Plan Details</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Ship Name</th>
              <th>Contract</th>
              <th>Electric Plan</th>
              <th>T Period</th>
              <th>Persentage</th>
              <th>Gas Plan</th>
            </tr>
          </thead>
          <tbody>
            @php
              $data_planning = [];
            @endphp
            @foreach ($gas_plans as $plan)
            @php
              $total =  ($plan->persen_plan / 100) * $plan->total_plan;
              $data_planning[] = $total;
            @endphp
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="text-center align-middle">{{ $project->ship_name }}</td>
              <td class="align-middle">
                <strong>Start</strong> {{ $project->contract_start }}<br>
                <strong>End</strong> {{ $project->contract_ended }}
              </td>
              <td class="text-center align-middle">{{ $plan->total_plan }}</td>
              <td class="text-center align-middle">{{ $plan->period_interval }} * {{ $diff }} = {{ $plan->period_interval * $diff }}</td>
              <td class="text-center align-middle">{{ $plan->persen_plan }}%</td>
              @if ($plan->persen_plan)
              <td class="text-center align-middle">{{ $total }} Kg</td>
              @else
              <td class="text-center align-middle">0 Kg</td>
              @endif
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Ship Name</th>
              <th>Contract</th>
              <th>Electric Plan</th>
              <th>T Period</th>
              <th>Persentage</th>
              <th>Gas Plan</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  @php
  @endphp

  {{-- Electric Report --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">{{ $project->code }} Monthly Usage</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
          <thead>
            <tr>
              <th></th>
              <th>Month</th>
              <th>Gas Usage</th>
              <th>S-Curve</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($monthly_datas as $monthly_data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $monthly_data['month'] }}</td>
                <td>{{ $monthly_data['gas_usage'] }}</td>
                <td>{{ $monthly_data['sCurve'] }}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th>Month</th>
              <th>Gas Usage</th>
              <th>S-Curve</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  
  <h6 class="mb-0 text-uppercase">Usage Chart</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="chart-container1">
        <canvas id="controlChart" height="400" data-planning={{ implode(';', $data_planning) }} data-report={{ implode(';', $interpolation) }}></canvas>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection

@section('custom-js')
  <script>
    const dataPlanning = $('#controlChart').data('planning');
    const dataReport = $('#controlChart').data('report');
    const planning = dataPlanning.split(";");
    const report = dataReport.split(";"); 
    const ctx = document.getElementById('controlChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0.2 T', '0.4 T', '0.6 T', '0.8 T', '1 T'],
            datasets: [{
                label: 'Gas Usage Planning',
                data: planning,
                borderColor: '#3461ff',
                lineTension: 0.25
            },{
                label: 'Gas Usage Report',
                data: report,
                borderColor: '#198754',
                lineTension: 0.25
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            maintainAspectRatio: false
        }
    });
  </script>
@endsection