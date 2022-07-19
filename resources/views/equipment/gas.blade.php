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
    <div class="breadcrumb-title pe-3">Gas Equipments</div>
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
            Gas
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Gas Equipments</h6>
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
              <th>Gas Filter</th>
              <th>Capacity & Unit</th>
              <th>Quantity</th>
              <th>Density</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $item->gas_filter }}</td>
              <td class="text-center align-middle">{{ $item->capacity }} {{ $item->unit }}</td>
              <td class="text-center align-middle">{{ $item->quantity }}</td>
              <td class="text-center align-middle">{{ $item->density }}</td>
              <td class="text-center align-middle">
                <button type="button" class="btn p-0 text-warning editEquipment" data-bs-toggle="modal" data-bs-target="#modalEquipment" data-equipment-id="{{ $item->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <form action="/equipment/gas/{{ $item->id }}" method="post" class="d-inline">
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
              <th>Gas Filter</th>
              <th>Capacity & Unit</th>
              <th>Quantity</th>
              <th>Density</th>
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
              <label for="gas_filter" class="form-label">Gas Filter Name*</label>
              <input required type="text" class="form-control" name="gas_filter" id="gas_filter" value="{{ old('gas_filter') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="capacity" class="form-label">Capacity</label>
              <div class="input-group">
                <input type="text" class="form-control" name="capacity" id="capacity" value="{{ old('capacity') }}">
                <span class="input-group-text">Unit</span>
                <input type="text" class="form-control" name="unit" value="{{ old('unit') }}">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="quantity" class="form-label">Quantity*</label>
              <input required type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="density" class="form-label">Density</label>
              <input type="text" class="form-control" name="density" id="density" value="{{ old('density') }}">
            </div>
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
    const baseUrl = window.location.origin;
    $('.addEquipment').on('click', function () {
      $('.modal-title').text('Add new gas equipment')
      $('.formModal').attr('action', baseUrl + '/equipment/gas')
      $('input[name=gas_filter]').val('')
      $('input[name=capacity]').val('')
      $('input[name=unit]').val('')
      $('input[name=quantity]').val('')
      $('input[name=density]').val('')
      $('.formSubmit').text('Add equipment')
    })
    $('.editEquipment').on('click', function () {
      const getId = $(this).data('equipment-id');
      $.ajax({
        type: "GET",
        url: baseUrl + '/equipment/gas/' + getId,
        dataType: 'JSON',
        success: function (data) {
          console.log(data);
          $('.modal-title').text('Edit equipment ' + data.equipment.gas_filter)
          $('.formModal').attr('action', baseUrl + '/equipment/gas/' + data.equipment.id)
          $('input[name=gas_filter]').val(data.equipment.gas_filter)
          $('input[name=capacity]').val(data.equipment.capacity)
          $('input[name=unit]').val(data.equipment.unit)
          $('input[name=quantity]').val(data.equipment.quantity)
          $('input[name=density]').val(data.equipment.density)
          $('.formSubmit').text('Edit equipment')
        }
      })
    });
  </script>
@endsection