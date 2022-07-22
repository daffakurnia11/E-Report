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
    <div class="breadcrumb-title pe-3">Detail of {{ $block->block_name }}</div>
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
          <li class="breadcrumb-item active" aria-current="page">
            {{ $block->block_name }}
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="row">
    <div class="col-lg-6">
      {{-- Detail Data --}}
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">{{ $block->block_name }} Data</h6>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Block Name</label>
            <div class="col-sm-7">
              {{ $block->block_name }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Block Weight</label>
            <div class="col-sm-7">
              {{ $block->block_weight }} Ton
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Block File</label>
            <div class="col-sm-7">
              @if ($block->filename)
                <a href="/files/block/{{ $block->filename }}" target="_blank" class="d-block" rel="noopener noreferrer">{{ $block->filename }}</a>
              @else
                <span class="d-block">No file</span>
              @endif
            </div>
          </div>
          <div class="row mb-2 align-items-center">
            <label class="col-sm-5 d-block fw-bold">Status</label>
            <div class="col-sm-7">
              <span class="d-block">
                {{ $block->status }}
                <a href="/my-block/update/{{ $block->id }}" class="btn-sm btn-success confirmAlert" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Update Progress"><i class="bi bi-check2-circle"></i> Update Progress</a>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Person In Charge</label>
            <div class="col-sm-7">
              {{ $block->user->name }}
            </div>
          </div>
        </div>
      </div>
    </div>
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
              <span class="badge bg-dark text-light">{{ $block->project->code }}</span>
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Ship Name</label>
            <div class="col-sm-7">
              {{ $block->project->ship_name }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Ship Size</label>
            <div class="col-sm-7">
              {{ $block->project->ship_size }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Status</label>
            <div class="col-sm-7">
              {{ $block->project->status }}
            </div>
          </div>
          <div class="row mb-2">
            <label class="col-sm-5 d-block fw-bold">Project Manager</label>
            <div class="col-sm-7">
              {{ $block->project->user->name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- List of Equipments --}}
  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Equipments</h6>
    <div>
      <a href="/report-usage/{{ $block->id }}" class="btn btn-sm btn-success">Get Report</a>
      <button type="button" class="btn btn-sm btn-primary addEquipment" data-bs-toggle="modal" data-bs-target="#modalEquipment">Add new equipment</button>
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
              <th>Equipment</th>
              <th>Activity</th>
              <th>Data</th>
              <th>Status</th>
              <th>Start</th>
              <th>End</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($equipments as $item)
            <tr>
              <td class="align-middle text-center">{{ $loop->iteration }}</td>
              <td class="align-middle">
                @if ($item->type == 'Gas')
                  {{ $item->type }} || {{ $item->equipment_gas->gas_equipment->name }}
                @else
                  {{ $item->type }} || {{ $item->equipment_electric->name }}
                @endif
              </td>
              <td class="align-middle text-wrap">{{ $item->activity }}</td>
              <td class="align-middle">
                @if ($item->type == 'Gas')
                  Flowmeter : {{ $item->flowmeter }} LPM
                @else
                  <span class="d-block">Volt : {{ $item->volt }} Volt</span>
                  <span class="d-block">Ampere : {{ $item->ampere }} Ampere</span>
                @endif
              </td>
              <td class="align-middle text-center">
                <span class="badge bg-info text-dark">{{ $item->status }}</span>  
              </td>
              <td class="align-middle text-center">{{ $item->created_at }}</td>
              <td class="align-middle text-center">{{ $item->stopped_at ?: 'On progress' }}</td>
              <td class="align-middle text-center">
                @if (!$item->stopped_at)
                <a href="/my-block/{{ $block->id }}/{{ $item->id }}/finished" class="btn btn-sm text-success confirmAlert" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Finishing Progress"><i class="bi bi-check2-circle"></i></a>
                @else
                <a href="/report-usage/{{ $block->id }}" class="btn btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Get usage report"><i class="bi bi-clipboard-data"></i></a>
                @endif
                <button type="button" class="btn p-0 text-warning editEquipment" data-bs-toggle="modal" data-bs-target="#modalEquipment" data-equipment-id="{{ $item->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <form action="/my-block/{{ $block->id }}/{{ $item->id }}" method="post" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Delete equipment"><i class="bi bi-trash-fill"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Equipment</th>
              <th>Activity</th>
              <th>Data</th>
              <th>Status</th>
              <th>Start</th>
              <th>End</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

<!-- Modal -->
<div class="modal fade" id="modalEquipment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="formModal">
        @csrf
        <div class="modal-body">
          <select class="form-select mb-3" id="type" name="type">
            <option disabled>--Select the type of equipment--</option>
            <option value="Gas">Gas</option>
            <option value="Electric">Electric</option>
          </select>
          {{-- Gas Menu --}}
          <div class="form-menu" id="gasMenu" style="display: none">
            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="equipment" class="form-label">Equipment*</label>
                <select class="form-select mb-3" id="equipment_gas" name="equipment_gas_id">
                  <option disabled>--Select the equipment--</option>
                  @foreach ($gases as $item)
                  <option value="{{ $item->id }}">Gas || {{ $item->gas_filter }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="flowmeter" class="form-label">Flowmeter*</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="flowmeter" id="flowmeter" value="{{ old('flowmeter') }}">
                  <span class="input-group-text" id="basic-addon2">LPM</span>
                </div>
              </div>
            </div>
          </div>

          {{-- Electric Menu --}}
          <div class="form-menu" id="electricMenu" style="display: none">
            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="equipment" class="form-label">Equipment*</label>
                <select class="form-select mb-3" id="equipment_electric" name="equipment_electric_id">
                  <option disabled>--Select the equipment--</option>
                  @foreach ($electrics as $item)
                  <option value="{{ $item->id }}">Electric || {{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="volt" class="form-label">Volt*</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="volt" id="volt" value="{{ old('volt') }}">
                  <span class="input-group-text" id="basic-addon2">Volt</span>
                </div>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="ampere" class="form-label">Ampere*</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="ampere" id="ampere" value="{{ old('ampere') }}">
                  <span class="input-group-text" id="basic-addon2">Ampere</span>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="activity" class="form-label">Activity*</label>
            <input required type="text" class="form-control" name="activity" id="activity" value="{{ old('activity') }}">
          </div>
          <small class="text-danger">*) Field must be filled (required)</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary formSubmit"></button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('custom-js')
  <script>
    const url = window.location.href;
    $('select').on('change', function () {
      const type = $(this).val();
      if (type === "Gas") {
        $('.form-menu').css('display', 'none')
        $('#gasMenu').css('display', 'block')
      } else if (type === "Electric") {
        $('.form-menu').css('display', 'none')
        $('#electricMenu').css('display', 'block')
      }
    });
    $('.addEquipment').on('click', function() {
      $('.modal-title').text('Add new equipment');
      $('.formSubmit').text('Add Equipment');
      $('.form-menu').css('display', 'none');
      $('.formModal').attr('action', url);
      $('input[name=activity]').val('');
      $('input[name=flowmeter]').val('');
      $('input[name=volt]').val('');
      $('input[name=ampere]').val('');

      $('option[selected]').removeAttr('selected')
      $('option[disabled]').attr('selected', true)
    });
    $('.editEquipment').on('click', function () {
      const getId = $(this).data('equipment-id');
      $.ajax({
        type: "GET",
        url: url + '/' + getId,
        dataType: 'JSON',
        success: function (data) {
          $('.modal-title').text('Edit equipment');
          $('.formSubmit').text('Edit Equipment');
          $('input[name=activity]').val(data.equipment.activity);
          $('.formModal').attr('action', url + '/' + data.equipment.id);

          $('option[selected]').removeAttr('selected')
          $('select#type').find($('option[value=' + data.equipment.type + ']')).attr('selected', true);

          if (data.equipment.type === 'Gas') {
            $('.form-menu').css('display', 'none')
            $('#gasMenu').css('display', 'block')
            
            $('input[name=flowmeter]').val(data.equipment.flowmeter);
            $('input[name=volt]').val(data.equipment.volt);
            $('input[name=ampere]').val(data.equipment.ampere);

            $('select#equipment_electric').find($('option[selected]')).removeAttr('selected');
            $('select#equipment_electric').find($('option[disabled]')).attr('selected', true);
            $('select#equipment_gas').find($('option[value=' + data.equipment.equipment_gas_id + ']')).attr('selected', true);
          } else if (data.equipment.type === 'Electric') {
            $('.form-menu').css('display', 'none')
            $('#electricMenu').css('display', 'block')
            
            $('input[name=flowmeter]').val(data.equipment.flowmeter);
            $('input[name=volt]').val(data.equipment.volt);
            $('input[name=ampere]').val(data.equipment.ampere);

            $('select#equipment_gas').find($('option[selected]')).removeAttr('selected');
            $('select#equipment_gas').find($('option[disabled]')).attr('selected', true);
            $('select#equipment_electric').find($('option[value=' + data.equipment.equipment_electric_id + ']')).attr('selected', true);
          }
          console.log(data);
        }
      })
    });
  </script>
@endsection