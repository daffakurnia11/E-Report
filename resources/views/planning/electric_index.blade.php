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
            <i class="bi bi-calendar-week"></i> Project Planning
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
              <th>Contract Start</th>
              <th>Contract End</th>
              <th>Period</th>
              <th>Electric Plan</th>
              <th>Planning Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            @php
              $start = Carbon\Carbon::parse($project->contract_start);
              $ended = Carbon\Carbon::parse($project->contract_ended);
              $diff = $start->diffInMonths($ended);

              $total_kWh = 0;
              $planned = false;
              foreach ($project->project_plan as $plan) {
                $total_kWh = $plan->total_kWh;
                if ($plan->electric_plan) {
                  $planned = true;
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
              <td class="text-center align-middle">
                <form action="" class="electric-plan-form" data-project={{ $project->code }}>
                  @csrf
                  <div class="input-group input-group-sm">
                    <input type="number" min="0" class="form-control" placeholder="Total kWh" name="total_kWh" value="{{ $total_kWh }}">
                    <button class="btn btn-primary electric-plan-submit" type="submit">Add</button>
                  </div>
                </form>
              </td>
              @if ($planned)
              <td class="text-center align-middle">
                <a href="/planning/electric/{{ $project->code }}" class="badge text-dark bg-success">Planned - See planning</a>
              </td>
              @else
              <td class="text-center align-middle">
                <a href="/planning/electric/{{ $project->code }}" class="badge text-light bg-danger">Unplanned - Create planning</a>
              </td>
              @endif
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
              <th>Electric Plan</th>
              <th>Planning Status</th>
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