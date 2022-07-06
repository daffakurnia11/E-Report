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
    <div class="breadcrumb-title pe-3">User Management</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="/user">
              <i class="bi bi-people-fill"></i> User Management
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $user->name }}
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <h6 class="mb-0 text-uppercase">Details of {{ $user->name }}</h6>
  <hr>
  <div class="card col-lg-8">
    <form action="/user/{{ $user->username }}" method="POST">
      @csrf
      @method("PUT")
      <div class="card-body">
        <h6 class="mb-0 text-uppercase">Credentials</h6>
        <hr>
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}">
          </div>
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" readonly class="form-control-plaintext" value="{{ $user->username }}">
          </div>
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="text" readonly class="form-control-plaintext" value="{{ $user->email }}">
          </div>
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Phone</label>
            <input type="text" readonly class="form-control-plaintext" value="{{ $user->phone }}">
          </div>
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Password</label>
            <a href="/user/{{ $user->username }}/resetpass" class="d-block py-2">Reset Password!</a>
          </div>
        </div>
        <h6 class="mb-0 mt-3 text-uppercase">Authorization</h6>
        <hr>
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Roles</label>
            <select class="form-select @error('roles') is-invalid @enderror" name="roles" aria-label="Default select example">
              <option selected="" disabled>--Choose a role--</option>
              <option {{ $user->roles == 'Admin' ? 'selected' : '' }} value="Admin">Administrator</option>
              <option {{ $user->roles == 'GM' ? 'selected' : '' }} value="GM">General Manager (GM)</option>
              <option {{ $user->roles == 'PM' ? 'selected' : '' }} value="PM">Project Manager (PM)</option>
              <option {{ $user->roles == 'PIC' ? 'selected' : '' }} value="PIC">PIC</option>
            </select>
            @error('roles')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-sm-6 mb-3">
            <label class="form-label fw-bold">Status</label>
            @if ($user->verified_at)
            <input type="text" readonly class="form-control-plaintext" value="Verified at {{ $user->verified_at }}">
            @else
            <div class="form-check py-2">
              <input class="form-check-input" type="checkbox" name="verify" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">Verify now!</label>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update!</button>
      </div>
    </form>
  </div>
  
</main>
<!--end page main-->

@endsection