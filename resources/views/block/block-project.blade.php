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
    <div class="breadcrumb-title pe-3">Blocks Data</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/my-project">
              <i class="bi bi-list-check"></i> Project Data
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Blocks Data
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <div class="d-flex justify-content-between align-items-center">
    <h6 class="mb-0 text-uppercase">List of Blocks for {{ $project->ship_name }}</h6>
    <button type="button" class="btn btn-sm btn-primary addBlock" data-bs-toggle="modal" data-bs-target="#modalBlock">Create new block</button>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Block name</th>
              <th>Block weight (in Ton)</th>
              <th>Sequence</th>
              <th>PIC</th>
              <th>Block File</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blocks as $block)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $block->block_name }}</td>
              <td class="text-center align-middle">{{ $block->block_weight }}</td>
              <td class="align-middle">{{ $block->sequence }}</td>
              <td class="align-middle">
                <span class="badge bg-success">{{ $block->user->name }}</span>
              </td>
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
                <button type="button" class="btn p-0 text-warning editBlock" data-bs-toggle="modal" data-bs-target="#modalBlock" data-block-id="{{ $block->id }}">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <form action="/my-project/{{ $project->code }}/block/{{ $block->id }}" method="post" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="deleteConfirm text-danger btn p-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete project"><i class="bi bi-trash-fill"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Block name</th>
              <th>Block weight (in Ton)</th>
              <th>Sequence</th>
              <th>PIC</th>
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

<!-- Modal -->
<div class="modal fade" id="modalBlock" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="formModal" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="block_name" class="form-label">Block name*</label>
              <input required type="text" class="form-control" name="block_name" id="block_name" value="{{ old('block_name') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="block_weight" class="form-label">Block Weight*</label>
              <div class="input-group">
                <input required type="number" class="form-control" name="block_weight" id="block_weight" value="{{ old('block_weight') }}">
                <span class="input-group-text" id="basic-addon2">Ton</span>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="sequence" class="form-label">Erection Sequence*</label>
              <input required type="text" class="form-control" name="sequence" id="sequence" value="{{ old('sequence') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="user_id" class="form-label">Project Manager*</label>
              <select required class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id" id="user_id">
                <option selected="" disabled>--Choose PIC--</option>
                @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="build_start" class="form-label">Build Start*</label>
              <input required type="text" class="result form-control datePicker" name="build_start" id="build_start" value="{{ old('build_start') }}">
            </div>
            <div class="col-sm-6 mb-3">
              <label for="build_ended" class="form-label">Build End*</label>
              <input required type="text" class="result form-control datePicker" name="build_ended" id="build_ended" value="{{ old('build_ended') }}">
            </div>
            <div class="col-12 mb-3">
              <label for="filename" class="form-label d-block mb-1">Block File</label>
              <span id="currentFile" class="text-primary mb-1">
                Current file : 
                <a href="" target="_blank"></a>
              </span>
              <input class="form-control" type="file"name="filename" id="filename" accept=".jpg,.jpeg,.png,.pdf">
              <small class="text-danger">Format : .jpg, .jpeg, .png, .pdf max 5MB</small>
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
    const baseUrl = window.location.href;
    $('.addBlock').on('click', function () {
      $('.modal-title').text('Create new block')
      $('.formModal').attr('action', baseUrl)
      $('input[name=block_name]').val('')
      $('input[name=block_weight]').val('')
      $('input[name=sequence]').val('')
      $('input[name=build_start]').val('')
      $('input[name=build_ended]').val('')
      $('#currentFile').css('display', 'none');
      $('.formSubmit').text('Create block')
      $('option[disabled]').text('--Choose PIC--')
    })
    $('.editBlock').on('click', function () {
      const id = $(this).data('block-id');
      $.ajax({
        type: "GET",
        url: baseUrl + '/' + id,
        dataType: 'JSON',
        success: function (data) {
          $('.modal-title').text('Edit block ' + data.block.block_name)
          $('.formModal').attr('action', baseUrl + '/' + data.block.id)
          $('input[name=block_name]').val(data.block.block_name)
          $('input[name=block_weight]').val(data.block.block_weight)
          $('input[name=sequence]').val(data.block.sequence)
          $('input[name=build_start]').val(data.block.build_start)
          $('input[name=build_ended]').val(data.block.build_ended)
          $('.formSubmit').text('Edit block')
          if (data.block.user_id) {
            $('option[disabled]').remove()
            $('select#user_id').prepend($('<option>', {
              value: data.block.user_id,
              text: data.user.name,
              selected: true,
              disabled: true
            }))
          }
          if (data.block.filename) {
            $('#currentFile')
              .css('display', 'block')
              .find('a')
              .text(data.block.filename)
              .attr('href', '/files/block/' + data.block.filename);
          } else {
            $('#currentFile').css('display', 'none');
          }
        }
      })
    });
  </script>
@endsection