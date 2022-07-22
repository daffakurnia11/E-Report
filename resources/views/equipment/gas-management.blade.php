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
            <i class="bi bi-gear"></i> Gas Equipment
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Gas
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-9">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">List of Gas Equipments</h6>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                <tr>
                  <td class="text-center align-middle">{{ $loop->iteration }}</td>
                  <td class="align-middle">{{ $item->name }}</td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn p-0 text-warning edit-equipment"data-equipment-id="{{ $item->id }}">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form action="/gas-equipment/{{ $item->id }}" method="post" class="d-inline">
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
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-4">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase form-title">Create a new equipment</h6>
      </div>
      <hr>
      <div class="card">
        <form action="/gas-equipment" method="post" class="form-equipment">
          @csrf
          <div class="card-body">
            <div class="mb-3">
              <label for="name" class="form-label">Gas Filter Name*</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <small class="text-danger">*) Field must be filled (required)</small>
          </div>
          <div class="card-footer d-flex">
            <button type="submit" class="btn btn-primary form-submit">Add equipment</button>
            <button type="button" class="btn text-danger form-clear" style="display: none">Clear data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection

@section('custom-js')
  <script>
    const baseUrl = window.location.href;
    $('.form-clear').on('click', function () {
      $('.form-title').text('Create a new equipment');
      $('.form-equipment').attr('action', baseUrl);
      $('.form-submit').text('Add equipment')
      $('.form-clear').css('display', 'none');

      $('input[name=name]').val('');
    })
    $('.edit-equipment').on('click', function () {
      const getId = $(this).data('equipment-id');
      $.ajax({
        type: "GET",
        url: baseUrl + '/show/' + getId,
        dataType: 'JSON',
        success: function (data) {
          $('.form-title').text('Edit equipment');
          $('.form-equipment').attr('action', baseUrl + '/' + getId);
          $('.form-submit').text('Edit equipment');
          $('.form-clear').css('display', 'block');
          
          $('input[name=name]').val(data.equipment.name);
        }
      })
    });
  </script>
@endsection