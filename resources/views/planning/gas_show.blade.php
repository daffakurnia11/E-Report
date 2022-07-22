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
    <div class="breadcrumb-title pe-3">Project {{ $project->code }} Plan</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/planning/gas/{{ $equipment->id }}">
              <i class="bi bi-calendar-week"></i> {{ $equipment->name }} Planning
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $project->code }} Plan
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="row">
    <div class="col-xl-9">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">Gas Plan Details</h6>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gas Plan</th>
                  <th>Period</th>
                  <th>Persentage</th>
                  <th>Kg Plan</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $data = [];
                @endphp
                @foreach ($gas_plans as $plan)
                @php
                  $total =  ($plan->persen_plan / 100) * $plan->total_plan;
                  $data[] = $total;
                @endphp
                <tr>
                  <td class="text-center align-middle">{{ $loop->iteration }}</td>
                  <td class="text-center align-middle">{{ $plan->total_plan }}</td>
                  <td class="text-center align-middle">{{ $plan->period_interval }}</td>
                  <td class="text-center align-middle">
                    <form class="gas-plan-form" data-planning={{ $plan->id }}>
                      @csrf
                      <div class="input-group input-group-sm">
                        <input type="number" min="0" max="100" class="form-control" placeholder="Gas Persentage" name="persen_plan" value="{{ $plan->persen_plan }}">
                        <button class="btn btn-primary gas-plan-submit" type="submit">Add</button>
                      </div>
                    </form>
                  </td>
                  @if ($plan->persen_plan)
                  <td class="text-center align-middle kg-plan{{ $plan->id }}">{{ $total }} kg</td>
                  @else
                  <td class="text-center align-middle kg-plan{{ $plan->id }}">0 kg</td>
                  @endif
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Gas Plan</th>
                  <th>Period</th>
                  <th>Persentage</th>
                  <th>Kg Plan</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      @php
      @endphp
      <h6 class="mb-0 text-uppercase">Planning Chart</h6>
      <hr/>
      <div class="card">
        <div class="card-body">
          <div class="chart-container1">
            <canvas id="planningChart" height="400" data-chart={{ implode(';', $data) }}></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection

@section('custom-js')
  <script>
    const value = $('#planningChart').data('chart');
    const data = value.split(";");
    $(function () {
      $('.gas-plan-form').submit(function (e) {
        e.preventDefault();
        const val = $(this).find('input[name=persen_plan]').val();
        const _token = $(this).find('input[name=_token]').val();
        const project = $(this).data('planning');
        const url = window.location.origin;
        $.ajax({
          type: "POST",
          url: url + '/planning/gas/' + project,
          data: {
            persen_plan: val,
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
              const kg = data.plan.total_plan * (data.plan.persen_plan / 100);
              $('.kg-plan' + data.plan.id).text(kg + ' kg');
              Swal.fire({
                icon: 'success',
                title: data.message,
                text: 'Planning has stored successful',
                confirmButtonColor: '#3461ff'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            }
          }
        })
      });
    });
    const ctx = document.getElementById('planningChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0.2 T', '0.4 T', '0.6 T', '0.8 T', '1 T'],
            datasets: [{
                label: 'Gas Usage Planning',
                data: data,
                borderColor: '#3461ff',
                lineTension: 0.25
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            maintainAspectRatio: false
        }
    });
  </script>
@endsection