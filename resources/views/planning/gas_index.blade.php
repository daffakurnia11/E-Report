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
            <i class="bi bi-calendar-week"></i> All Gas Planning
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Projects</h6>
    <div class="btn-group">
      <button class="btn btn-primary" disabled>All Gas Planning</button>
      <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-73px, 40px);">
        @foreach ($equipments as $equipment)
        <a class="dropdown-item" href="/planning/gas/{{ $equipment->id }}">{{ $equipment->name }}</a>
        @endforeach
        <div class="dropdown-divider"></div>	
        <a class="dropdown-item" href="/planning/gas">All Gas Planning</a>
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
              @foreach ($equipments as $equipment)
              <th>{{ $equipment->name }} Planning</th>
              @endforeach
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
              @foreach ($equipments as $equipment)
                @php
                  $planned = 0;
                  foreach ($project->project_plan as $plan) {
                    if ($plan->plan_type == 'Gas' && $plan->gas_equipment_id == $equipment->id && $plan->persen_plan) {
                        $planned++;
                    }
                  } 
                @endphp
                @if ($planned == 5)
                <td class="text-center align-middle">
                  <a href="/planning/gas/{{ $equipment->id }}/{{ $project->code }}" class="badge text-dark bg-success">Planned</a>
                </td>
                @else
                <td class="text-center align-middle">
                  <a href="/planning/gas/{{ $equipment->id }}/{{ $project->code }}" class="badge text-light bg-danger">Unplanned</a>
                </td>
                @endif
              @endforeach
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              @foreach ($equipments as $equipment)
              <th>{{ $equipment->name }} Planning</th>
              @endforeach
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
  {{-- <script>
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
  </script> --}}
@endsection