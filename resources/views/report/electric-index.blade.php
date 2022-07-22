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
    <div class="breadcrumb-title pe-3">Project Planning</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-graph-up-arrow"></i> Project Reports
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
              <th>Project Manager</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="text-center align-middle">
                <span class="badge bg-success text-dark">{{ $project->code }}</span>
              </td>
              <td class="align-middle">{{ $project->ship_name }}</td>
              <td class="align-middle">{{ $project->user->name }}</td>
              <td class="align-middle">{{ $project->status }}</td>
              <td class="align-middle text-center">
                <a href="/reports/electric/{{ $project->code }}" class="btn btn-sm text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Get usage report"><i class="bi bi-clipboard-data"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Project Manager</th>
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

@endsection

@section('custom-js')
  <script>
    $(function () {
      $('.electric-plan-form').submit(function (e) {
        e.preventDefault();
        const val = $(this).find('input[name=total_kWh]').val();
        const _token = $(this).find('input[name=_token]').val();
        const project = $(this).data('project');
        const url = window.location.href;
        $.ajax({
          type: "POST",
          url: url + '/create/' + project,
          data: {
            total_kWh: val,
            _token: _token
          },
          dataType: 'JSON',
          beforeSend: function() {
            Swal.fire({
              title: 'Sending Data!',
              showCancelButton: false,
              showConfirmButton: false,
              allowOutsideClick: false
            })
          },
          success: function (data) {
            if (data.message == 'Planning failed') {
              Swal.fire({
                icon: 'error',
                title: data.message,
                text: 'Please fill the input!',
                confirmButtonColor: '#3461ff'
              })
            } else {
              $(this).find('input[name=_token]').val(data.plan);
              Swal.fire({
                icon: 'success',
                title: data.message,
                text: 'Planning has stored successful',
                confirmButtonColor: '#3461ff'
              })
            }
          }
        })
      });
    });
  </script>
@endsection