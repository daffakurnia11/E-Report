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
    <div class="breadcrumb-title pe-3">Project Management</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-diagram-3"></i> Project Management
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Projects</h6>
    <button type="button" class="btn btn-sm btn-primary addProject" data-bs-toggle="modal" data-bs-target="#modalProject">Add new project</button>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Project Manager</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Ship Owner</th>
              <th>Ship Size</th>
              <th>Contract Start</th>
              <th>Contract End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              @if ($project->user_id)
              <td class="align-middle">
                <span class="badge bg-success">{{ $project->user->name }}</span>
              </td>
              @else
              <td class="text-center align-middle">
                <form action="/project/{{ $project->code }}/add-pm" method="post">
                  @csrf
                  <div class="input-group">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id">
                      <option selected="" disabled>--Choose PM--</option>
                      @foreach ($managers as $manager)
                      <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                      @endforeach
                    </select>
                    <button class="btn ps-1 btn-sm btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-plus-lg"></i></button>
                  </div>
                </form>
              </td>
              @endif
              <td class="align-middle">{{ $project->code }}</td>
              <td class="align-middle">{{ $project->ship_name }}</td>
              <td class="align-middle">{{ $project->ship_owner }}</td>
              <td class="align-middle">{{ $project->ship_size }}</td>
              <td class="text-center align-middle">{{ $project->contract_start }}</td>
              <td class="text-center align-middle">{{ $project->contract_ended }}</td>
              <td class="text-center align-middle">
                @if ($project->status == 'Preparation')
                <span class="badge bg-info text-dark">{{ $project->status }}</span>
                @elseif ($project->status == 'Finished')
                <span class="badge bg-success">{{ $project->status }}</span>
                @else
                <span class="badge bg-warning text-dark">{{ $project->status }}</span>
                @endif
              </td>
              <td class="text-center align-middle">
                <button type="button" class="btn p-0 text-warning editProject" data-bs-toggle="modal" data-bs-target="#modalProject" data-code="{{ $project->code }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <form action="/project/{{ $project->code }}" method="post" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete project"><i class="bi bi-trash-fill"></i></button>
                </form>
                @if ($project->status != 'Finished')
                <a href="/project/{{ $project->code }}/mark-as-done" class="btn p-0 text-success confirmAlert" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Mark as Done">
                  <i class="bi bi-check-lg"></i>
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Project Manager</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Ship Owner</th>
              <th>Ship Size</th>
              <th>Contract Start</th>
              <th>Contract End</th>
              <th>Status</th>
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
<div class="modal fade" id="modalProject" tabindex="-1" aria-hidden="true">
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
              <label for="code" class="form-label">Project Code*</label>
              <input required type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="ship_name" class="form-label">Ship Name*</label>
              <input required type="text" class="form-control" name="ship_name" id="ship_name" value="{{ old('ship_name') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="ship_owner" class="form-label">Ship Owner*</label>
              <input required type="text" class="form-control" name="ship_owner" id="ship_owner" value="{{ old('ship_owner') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="ship_size" class="form-label">Ship Size*</label>
              <input required type="text" class="form-control" name="ship_size" id="ship_size" value="{{ old('ship_size') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="contract_start" class="form-label">Contract Start*</label>
              <input required type="text" class="result form-control datePicker" name="contract_start" id="contract_start" value="{{ old('contract_start') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="contract_ended" class="form-label">Contract End*</label>
              <input required type="text" class="result form-control datePicker" name="contract_ended" id="contract_ended" value="{{ old('contract_ended') }}">
            </div>
            <div class="col-12 mb-3">
              <label for="user_id" class="form-label">Project Manager</label>
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id" id="user_id">
                <option selected="" disabled>--Choose PM--</option>
                @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
              </select>
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
    $('.addProject').on('click', function () {
      const baseUrl = window.location.origin;
      $('.modal-title').text('Add new project')
      $('.formModal').attr('action', baseUrl + '/project')
      $('input[name=code]').val('')
      $('input[name=ship_name]').val('')
      $('input[name=ship_owner]').val('')
      $('input[name=ship_size]').val('')
      $('input[name=contract_start]').val('')
      $('input[name=contract_ended]').val('')
      $('.formSubmit').text('Add project')
      $('option[disabled]').text('--Choose PM--')
    })
    $('.editProject').on('click', function () {
      const code = $(this).data('code');
      const baseUrl = window.location.origin;
      $.ajax({
        type: "GET",
        url: baseUrl + '/project/' + code,
        dataType: 'JSON',
        success: function (data) {
          $('.modal-title').text('Edit project ' + data.project.code)
          $('.formModal').attr('action', baseUrl + '/project/' + data.project.code)
          $('input[name=code]').val(data.project.code)
          $('input[name=ship_name]').val(data.project.ship_name)
          $('input[name=ship_owner]').val(data.project.ship_owner)
          $('input[name=ship_size]').val(data.project.ship_size)
          $('input[name=contract_start]').val(data.project.contract_start)
          $('input[name=contract_ended]').val(data.project.contract_ended)
          $('.formSubmit').text('Edit project')
          if (data.project.user_id) {
            $('option[disabled]').remove()
            $('select#user_id').prepend($('<option>', {
              value: data.project.user_id,
              text: data.user.name,
              selected: true,
              disabled: true
            }))
          }
        }
      })
    });
  </script>
@endsection