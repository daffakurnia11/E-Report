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
    <div class="breadcrumb-title pe-3">Gas Usage Reports</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <i class="bi bi-clipboard-data"></i> Report Usage
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Gas
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Usage Reports</h6>
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
              <th>Gas Filter</th>
              <th>Activity</th>
              <th>Flowmeter</th>
              <th>Usage</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($equipments as $item)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $item->block->block_name }}</td>
              <td class="text-center align-middle">{{ $item->created_at }}</td>
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
              <th>Block</th>
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
  
</main>
<!--end page main-->

@endsection
