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
    <div class="breadcrumb-title pe-3">Block Data</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-boxes"></i> Block Data
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Blocks</h6>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Code</th>
              <th>Ship Name</th>
              <th>Project Manager</th>
              <th>Block name</th>
              <th>Block weight (in Ton)</th>
              <th>Sequence</th>
              <th>Block File</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blocks as $block)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $block->project->code }}</td>
              <td class="align-middle">{{ $block->project->ship_name }}</td>
              <td class="align-middle">{{ $block->project->user->name }}</td>
              <td class="align-middle">{{ $block->block_name }}</td>
              <td class="text-center align-middle">{{ $block->block_weight }}</td>
              <td class="align-middle">{{ $block->sequence }}</td>
              <td class="text-center align-middle">
                @if ($block->filename)
                <a href="/files/block/{{ $block->filename }}" target="_blank">Open file</a>
                @else
                <span>No file</span>
                @endif
              </td>
              <td class="align-middle">
                <span class="badge bg-info text-dark">{{ $block->status }}</span>
              </td>
              <td class="text-center align-middle">
                @if ($block->status === 'Waiting for approval')
                <a href="/my-block/approval/{{ $block->id }}" class="btn btn-sm text-success confirmAlert" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Approve Block"><i class="bi bi-check2-circle"></i></a>
                @else
                <a href="/my-block/{{ $block->id }}" class="btn p-0 text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Edit Equipment">
                  <i class="bi bi-plugin"></i>
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Code</th>
              <th>Ship Name</th>
              <th>Project Manager</th>
              <th>Block name</th>
              <th>Block weight (in Ton)</th>
              <th>Sequence</th>
              <th>Block File</th>
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