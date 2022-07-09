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
    <div class="breadcrumb-title pe-3">Electric Equipments</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <i class="bi bi-plugin"></i> Equipment
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Electric
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Electric Equipments</h6>
    <button type="button" class="btn btn-sm btn-primary addEquipment" data-bs-toggle="modal" data-bs-target="#modalEquipment">Add new equipment</button>
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
              <th>Volt</th>
              <th>Ampere</th>
              <th>Watt</th>
              <th>Power Factor</th>
              <th>Quantity</th>
              <th>Spesification</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $item->name }}</td>
              <td class="text-center align-middle">{{ $item->volt }}</td>
              <td class="text-center align-middle">{{ $item->ampere }}</td>
              <td class="text-center align-middle">{{ $item->watt }}</td>
              <td class="text-center align-middle">{{ $item->power_factor }}</td>
              <td class="text-center align-middle">{{ $item->quantity }}</td>
              <td class="text-wrap align-middle">{{ $item->spesification ?: '-' }}</td>
              <td class="text-center align-middle">
                <button type="button" class="btn p-0 text-warning editEquipment" data-bs-toggle="modal" data-bs-target="#modalEquipment" data-equipment-id="{{ $item->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <form action="/equipment/electric/{{ $item->id }}" method="post" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete equipment"><i class="bi bi-trash-fill"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Equipment</th>
              <th>Volt</th>
              <th>Ampere</th>
              <th>Watt</th>
              <th>Power Factor</th>
              <th>Quantity</th>
              <th>Spesification</th>
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
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="name" class="form-label">Equipment Name*</label>
              <input required type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="volt" class="form-label">Volt*</label>
              <div class="input-group">
                <input required type="number" class="form-control" name="volt" id="volt" value="{{ old('volt') }}">
                <span class="input-group-text" id="basic-addon2">Volt</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="ampere" class="form-label">Ampere*</label>
              <div class="input-group">
                <input required type="number" class="form-control" name="ampere" id="ampere" value="{{ old('ampere') }}">
                <span class="input-group-text" id="basic-addon2">Ampere</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="watt" class="form-label">Watt*</label>
              <div class="input-group">
                <input required type="number" class="form-control" name="watt" id="watt" value="{{ old('watt') }}">
                <span class="input-group-text" id="basic-addon2">Watt</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="power_factor" class="form-label">Power Factor*</label>
              <input required type="number" class="form-control" name="power_factor" id="power_factor" value="{{ old('power_factor') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="quantity" class="form-label">Quantity*</label>
              <input required type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity') }}">
            </div>
            <div class="col-12 mb-3">
              <label for="spesification" class="form-label">Spesification</label>
              <input type="text" class="form-control" name="spesification" id="spesification" value="{{ old('spesification') }}">
            </div>
          </div>
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
    const baseUrl = window.location.origin;
    $('.addEquipment').on('click', function () {
      $('.modal-title').text('Add new electric equipment')
      $('.formModal').attr('action', baseUrl + '/equipment/electric')
      $('input[name=name]').val('')
      $('input[name=volt]').val('')
      $('input[name=ampere]').val('')
      $('input[name=watt]').val('')
      $('input[name=power_factor]').val('')
      $('input[name=quantity]').val('')
      $('input[name=spesification]').val('')
      $('.formSubmit').text('Add equipment')
    })
    $('.editEquipment').on('click', function () {
      const getId = $(this).data('equipment-id');
      $.ajax({
        type: "GET",
        url: baseUrl + '/equipment/electric/' + getId,
        dataType: 'JSON',
        success: function (data) {
          console.log(data);
          $('.modal-title').text('Edit equipment ' + data.equipment.name)
          $('.formModal').attr('action', baseUrl + '/equipment/electric/' + data.equipment.id)
          $('input[name=name]').val(data.equipment.name)
          $('input[name=volt]').val(data.equipment.volt)
          $('input[name=ampere]').val(data.equipment.ampere)
          $('input[name=watt]').val(data.equipment.watt)
          $('input[name=power_factor]').val(data.equipment.power_factor)
          $('input[name=quantity]').val(data.equipment.quantity)
          $('input[name=spesification]').val(data.equipment.spesification)
          $('.formSubmit').text('Edit equipment')
        }
      })
    });
  </script>
@endsection