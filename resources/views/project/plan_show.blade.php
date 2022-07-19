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
            <a href="/planning">
              <i class="bi bi-calendar-week"></i> Project Planning
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
    <div class="col-xl-6">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">Gas Plan Details</h6>
        <button type="button" class="btn btn-sm btn-primary addGasPlan" data-bs-toggle="modal" data-bs-target="#gasPlan">Add new plan</button>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Month</th>
                  <th>Gas Plan</th>
                  <th>Average</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gas_plans as $plan)
                <tr>
                  <td class="text-center align-middle">{{ $loop->iteration }}</td>
                  <td class="text-center align-middle">{{ $plan->month }}</td>
                  <td class="text-center align-middle">{{ $plan->gas_plan }}</td>
                  <td class="text-center align-middle">{{ ($plan->gas_plan) / 30 }}</td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn p-0 text-warning editGasPlan" data-bs-toggle="modal" data-bs-target="#gasPlan" data-plan="{{ $plan->id }}">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form action="/planning/{{ $project->code }}/{{ $plan->id }}" method="post" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Delete plan"><i class="bi bi-trash-fill"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Month</th>
                  <th>Gas Plan</th>
                  <th>Average</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-uppercase">Electric Plan Details</h6>
        <button type="button" class="btn btn-sm btn-primary addElectricPlan" data-bs-toggle="modal" data-bs-target="#electricPlan">Add new plan</button>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Month</th>
                  <th>Electric Plan</th>
                  <th>Average</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($electric_plans as $plan)
                <tr>
                  <td class="text-center align-middle">{{ $loop->iteration }}</td>
                  <td class="text-center align-middle">{{ $plan->month }}</td>
                  <td class="text-center align-middle">{{ $plan->electric_plan }}</td>
                  <td class="text-center align-middle">{{ ($plan->electric_plan) / 30 }}</td>
                  <td class="text-center align-middles">
                    <button type="button" class="btn p-0 text-warning editElectricPlan" data-bs-toggle="modal" data-bs-target="#electricPlan" data-plan="{{ $plan->id }}">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form action="/planning/{{ $project->code }}/{{ $plan->id }}" method="post" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Delete plan"><i class="bi bi-trash-fill"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Month</th>
                  <th>Electric Plan</th>
                  <th>Average</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

<!-- Gas Plan Modal -->
<div class="modal fade" id="gasPlan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="form-modal">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="code" class="form-label">Project Code*</label>
              <input required readonly type="text" class="form-control" value="{{ $project->code }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="plan_type" class="form-label">Planning Type*</label>
              <input required readonly type="text" class="form-control" name="plan_type" id="plan_type" value="Gas">
            </div>
            <div class="col-12 mb-3">
              <label for="month" class="form-label">Month*</label>
              <div class="input-group">
                <select required class="form-select" name="month" id="month" aria-label="Default select example">
									<option selected="" disabled>--Select a month--</option>
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
                <span class="input-group-text">Year</span>
                <input required type="number" class="form-control" name="year" placeholder="Enter a year">
              </div>
            </div>
            <div class="col-12 mb-3">
              <label for="gas_plan" class="form-label">Planning*</label>
              <input required type="text" class="form-control" name="gas_plan" id="gas_plan" value="{{ old('gas_plan') }}">
            </div>
          </div>
          <small class="text-danger">*) Field must be filled (required)</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary form-submit"></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Electric Plan Modal -->
<div class="modal fade" id="electricPlan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="form-modal">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="code" class="form-label">Project Code*</label>
              <input required readonly type="text" class="form-control" value="{{ $project->code }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="plan_type" class="form-label">Planning Type*</label>
              <input required readonly type="text" class="form-control" name="plan_type" id="plan_type" value="Electric">
            </div>
            <div class="col-12 mb-3">
              <label for="month" class="form-label">Month*</label>
              <div class="input-group">
                <select required class="form-select" name="month" id="month" aria-label="Default select example">
									<option selected="" disabled>--Select a month--</option>
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
                <span class="input-group-text">Year</span>
                <input required type="number" class="form-control" name="year" placeholder="Enter a year">
              </div>
            </div>
            <div class="col-12 mb-3">
              <label for="electric_plan" class="form-label">Planning*</label>
              <input required type="text" class="form-control" name="electric_plan" id="electric_plan" value="{{ old('electric_plan') }}">
            </div>
          </div>
          <small class="text-danger">*) Field must be filled (required)</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary form-submit"></button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('custom-js')
  <script>
    $('.addGasPlan').on('click', function () {
      const baseUrl = window.location.href;
      console.log(baseUrl);
      $('#gasPlan').find('.modal-title').text('Add a new gas plan')
      $('#gasPlan').find('.form-modal').attr('action', baseUrl)
      $('#gasPlan').find('.form-submit').text('Add plan')

      $('#gasPlan').find('option[selected]').removeAttr('selected')
      $('#gasPlan').find('option[disabled]').attr('selected', true)
      $('#gasPlan').find('input[name=year]').val('')
      $('#gasPlan').find('input[name=gas_plan]').val('')
    })
    $('.editGasPlan').on('click', function () {
      const getId = $(this).data('plan');
      const baseUrl = window.location.href;
      $.ajax({
        type: "GET",
        url: baseUrl + '/' + getId,
        dataType: 'JSON',
        success: function (data) {
          $('#gasPlan').find('.modal-title').text('Edit gas plan')
          $('#gasPlan').find('.form-modal').attr('action', baseUrl + '/' + getId)
          $('#gasPlan').find('.form-submit').text('Edit plan')

          var monthData = data.plan.month.split(" ");
          var month = monthData[0]
          var year = monthData[1]
          $('#gasPlan').find('option[selected]').removeAttr('selected')
          $('#gasPlan').find('option[value=' + month + ']').attr('selected', true)
          $('#gasPlan').find('input[name=year]').val(year)
          $('#gasPlan').find('input[name=gas_plan]').val(data.plan.gas_plan)
          console.log(data);
        }
      })
    });

    $('.addElectricPlan').on('click', function () {
      const baseUrl = window.location.href;
      console.log(baseUrl);
      $('#electricPlan').find('.modal-title').text('Add a new electric plan')
      $('#electricPlan').find('.form-modal').attr('action', baseUrl)
      $('#electricPlan').find('.form-submit').text('Add plan')

      $('#electricPlan').find('option[selected]').removeAttr('selected')
      $('#electricPlan').find('option[disabled]').attr('selected', true)
      $('#electricPlan').find('input[name=year]').val('')
      $('#electricPlan').find('input[name=electric_plan]').val('')
    })
    $('.editElectricPlan').on('click', function () {
      const getId = $(this).data('plan');
      const baseUrl = window.location.href;
      $.ajax({
        type: "GET",
        url: baseUrl + '/' + getId,
        dataType: 'JSON',
        success: function (data) {
          $('#electricPlan').find('.modal-title').text('Edit electric plan')
          $('#electricPlan').find('.form-modal').attr('action', baseUrl + '/' + getId)
          $('#electricPlan').find('.form-submit').text('Edit plan')

          var monthData = data.plan.month.split(" ");
          var month = monthData[0]
          var year = monthData[1]
          $('#electricPlan').find('option[selected]').removeAttr('selected')
          $('#electricPlan').find('option[value=' + month + ']').attr('selected', true)
          $('#electricPlan').find('input[name=year]').val(year)
          $('#electricPlan').find('input[name=electric_plan]').val(data.plan.electric_plan)
          console.log(data);
        }
      })
    });
  </script>
@endsection