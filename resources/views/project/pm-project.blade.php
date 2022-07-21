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
    <div class="breadcrumb-title pe-3">Project Data</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-list-check"></i> Project Data
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of My Projects</h6>
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
              <th>Ship Owner</th>
              <th>Ship Size</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">
                <span class="badge bg-success text-dark">{{ $project->code }}</span>
              </td>
              <td class="align-middle">{{ $project->ship_name }}</td>
              <td class="align-middle">{{ $project->ship_owner }}</td>
              <td class="align-middle">{{ $project->ship_size }}</td>
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
                <a href="/my-project/{{ $project->code }}/blocks" class="btn p-0 text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Create Block Division">
                  <i class="bi bi-boxes"></i>
                </a>
                <a href="/my-project/{{ $project->code }}/report" class="btn btn-sm text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Get usage report"><i class="bi bi-clipboard-data"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Project Code</th>
              <th>Ship Name</th>
              <th>Ship Owner</th>
              <th>Ship Size</th>
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