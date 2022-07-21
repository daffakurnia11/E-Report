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
    <div class="breadcrumb-title pe-3">Usage Reports</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/my-block">
              <i class="bi bi-boxes"></i> Block Data
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/my-block/{{ $block->id }}">
              {{ $block->block_name }}
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Usage Report
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  {{-- Gas Usage Report --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Gas Usage Reports</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Date</th>
              <th>Gas Filter</th>
              <th>Activity</th>
              <th>Flowmeter</th>
              <th>Usage</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($gases as $item)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="text-center align-middle">{{ $item->equipment->stopped_at }}</td>
              <td class="align-middle">{{ $item->equipment->equipment_gas->gas_filter }}</td>
              <td class="align-middle">{{ $item->equipment->activity }}</td>
              <td class="text-center align-middle">{{ $item->equipment->flowmeter }} LPM</td>
              <td class="text-center align-middle">{{ $item->gas_usage }} Kg</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Date</th>
              <th>Gas Filter</th>
              <th>Activity</th>
              <th>Flowmeter</th>
              <th>Usage</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  {{-- Electric Usage Report --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Electric Usage Reports</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
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
            @foreach ($electrics as $item)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="text-center align-middle">{{ $item->equipment->stopped_at }}</td>
              <td class="align-middle">{{ $item->equipment->equipment_electric->name }}</td>
              <td class="align-middle">{{ $item->equipment->activity }}</td>
              <td class="text-center align-middle">{{ $item->equipment->volt }} Volt</td>
              <td class="text-center align-middle">{{ $item->equipment->ampere }} Ampere</td>
              <td class="text-center align-middle">{{ $item->kWh }} kWh</td>
              <td class="text-center align-middle">{{ $item->period }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
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
  
</main>
<!--end page main-->

@endsection
