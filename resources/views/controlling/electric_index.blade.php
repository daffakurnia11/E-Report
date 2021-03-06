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
    <div class="breadcrumb-title pe-3">Electric Controlling</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-clipboard-data"></i> Electric Controlling
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Projects</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Contract Start</th>
              <th>Contract End</th>
              <th>Period</th>
              <th>Electric Plan</th>
              <th>Electric Usage</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            @php
              $start = Carbon\Carbon::parse($project->contract_start);
              $ended = Carbon\Carbon::parse($project->contract_ended);
              $diff = $start->diffInMonths($ended);

              $total_plan = 0;
              foreach ($project->project_plan as $plan) {
                if ($plan->plan_type == 'Electric') {
                  $total_plan = $plan->total_plan;
                }
              }       
              $total_usage = 0;
              foreach ($project->block as $block) {
                foreach ($block->equipment as $equipment) {
                  $total_usage = $total_usage + $equipment->equipment_process->kWh;
                }
              }
            @endphp
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="text-center align-middle">
                <span class="badge bg-success text-dark">{{ $project->code }}</span>
              </td>
              <td class="align-middle">{{ $project->ship_name }}</td>
              <td class="text-center align-middle">{{ $project->contract_start }}</td>
              <td class="text-center align-middle">{{ $project->contract_ended }}</td>
              <td class="text-center align-middle">{{ $diff }} Months</td>
              <td class="text-center align-middle">{{ $total_plan }} kWh</td>
              <td class="text-center align-middle">{{ $total_usage }} kWh</td>
              <td class="text-center align-middle">
                <a href="/controlling/electric/{{ $project->code }}" class="btn-sm text-primary"><i class="bi bi-clipboard-data"></i> Get Report Data</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Contract Start</th>
              <th>Contract End</th>
              <th>Period</th>
              <th>Electric Plan</th>
              <th>Electric Usage</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection