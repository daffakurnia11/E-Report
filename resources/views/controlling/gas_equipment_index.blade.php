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
    <div class="breadcrumb-title pe-3">{{ $gasEquipment->name }} Gas Controlling</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-clipboard-data"></i> {{ $gasEquipment->name }} Gas Controlling
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Projects</h6>
    <div class="btn-group">
      <button class="btn btn-primary" disabled>{{ $gasEquipment->name }}</button>
      <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-73px, 40px);">
        @foreach ($equipments as $item)
        <a class="dropdown-item" href="/controlling/gas/{{ $item->id }}">{{ $item->name }}</a>
        @endforeach
        <div class="dropdown-divider"></div>	
        <a class="dropdown-item" href="/controlling/gas">All Gas Planning</a>
      </div>
    </div>
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
              <th>Gas Plan</th>
              <th>Gas Usage</th>
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
                if ($plan->plan_type == 'Gas' && $plan->gas_equipment_id == $gasEquipment->id) {
                  $total_plan = $plan->total_plan;
                }
              }       
              $total_usage = 0;
              foreach ($project->block as $block) {
                foreach ($block->equipment as $equipment) {
                  if ($equipment->type == 'Gas') {
                    if ($equipment->equipment_gas->gas_equipment_id == $gasEquipment->id) {
                      $total_usage = $total_usage + $equipment->equipment_process->gas_usage;
                    }
                  }
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
              <td class="text-center align-middle">{{ $total_plan }} Kg</td>
              <td class="text-center align-middle">{{ $total_usage }} Kg</td>
              <td class="text-center align-middle">
                <a href="/controlling/gas/{{ $gasEquipment->id }}/{{ $project->code }}" class="btn-sm text-primary"><i class="bi bi-clipboard-data"></i> Get Report Data</a>
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
              <th>Gas Plan</th>
              <th>Gas Usage</th>
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