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
    <div class="breadcrumb-title pe-3">Detail of {{ $project->code }}</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/reports/electric">
              <i class="bi bi-graph-up-arrow"></i> Electric Reports
            </a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            Report {{ $project->code }}
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="row">
    <div class="col-lg-6">
      {{-- Project Data --}}
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">Project Data</h6>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Project Code</label>
            <div class="col-sm-7">
              <span class="badge bg-dark text-light">{{ $project->code }}</span>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Ship Name</label>
            <div class="col-sm-7">
              {{ $project->ship_name }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Ship Size</label>
            <div class="col-sm-7">
              {{ $project->ship_size }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Status</label>
            <div class="col-sm-7">
              {{ $project->status }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Project Manager</label>
            <div class="col-sm-7">
              {{ $project->user->name }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Contract Start</label>
            <div class="col-sm-7">
              {{ $project->contract_start }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Contract End</label>
            <div class="col-sm-7">
              {{ $project->contract_ended }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      {{-- Block Data --}}
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">Block Data</h6>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          @foreach ($blocks as $block)    
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">PIC {{ $block->block_name }}</label>
            <div class="col-sm-7">
              <span class="badge bg-success text-dark">{{ $block->user->name }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- Chart Usage --}}
  <h6 class="mb-0 text-uppercase">Usage Report Chart</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="chart-container1">
            <canvas id="electricChart" height="600"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- List of Equipments --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">Equipment Usage Report Data</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      {{-- Electric Usage Report --}}
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">List of Electric Usage Reports</h6>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Block</th>
                  <th>Date</th>
                  <th>Equipment</th>
                  <th>Activity</th>
                  <th>Volt</th>
                  <th>Ampere</th>
                  <th>Usage</th>
                  <th>Period</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($blocks as $block)
                  @if ($block->equipment_process->isNotEmpty())
                    @foreach ($block->equipment_process as $item)
                      @if ($item->equipment->type == 'Electric')
                      @php
                        static $i = 1;
                      @endphp
                      <tr>
                        <td class="text-center align-middle">{{ $i++; }}</td>
                        <td class="align-middle">{{ $item->block->block_name }}</td>
                        <td class="text-center align-middle">{{ $item->created_at }}</td>
                        <td class="align-middle">{{ $item->equipment->equipment_electric->name }}</td>
                        <td class="align-middle">{{ $item->equipment->activity }}</td>
                        <td class="text-center align-middle">{{ $item->equipment->volt }} Volt</td>
                        <td class="text-center align-middle">{{ $item->equipment->ampere }} Ampere</td>
                        <td class="text-center align-middle">{{ $item->kWh }} kWh</td>
                        <td class="text-center align-middle">{{ $item->period }}</td>
                      </tr>
                      @endif
                    @endforeach
                  @endif
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Block</th>
                  <th>Date</th>
                  <th>Equipment</th>
                  <th>Activity</th>
                  <th>Volt</th>
                  <th>Ampere</th>
                  <th>Usage</th>
                  <th>Period</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection

@section('custom-js')
  <script>
    const url = window.location.href;
    $.ajax({
      type: "GET",
      url: url + '/monthly-usage-data',
      dataType: 'JSON',
      success: function (data) {
        console.log(data);
        const electric = document.getElementById('electricChart').getContext('2d');
        const electricChart = new Chart(electric, {
            type: 'line',
            data: {
                labels: data.monthlist,
                datasets: [{
                    label: 'Electric Usage',
                    data: data.data.kWh,
                    borderColor: '#3461ff',
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
      }
    });
  </script>
@endsection