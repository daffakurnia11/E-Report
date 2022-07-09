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
            Create new user
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <h6 class="mb-0 text-uppercase">Form creating a new user</h6>
  <hr>
  <div class="card col-xxl-8">
    <form action="/user" method="POST">
      @csrf
      <div class="card-body">
        <h6 class="mb-0 text-uppercase">Credentials</h6>
        <hr>
        <div class="row">
          <div class="col-12 col-lg-4 mb-3">
            <label for="name" class="form-label">Full Name*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-person-fill"></i>
              </div>
              <input type="text" class="form-control ps-5 @error('name') is-invalid @enderror" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
            </div>
            @error('name')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <label for="roles" class="form-label">Roles*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-person-badge"></i>
              </div>
              <select class="form-select ps-5 @error('roles') is-invalid @enderror" name="roles" id="roles">
                <option selected="" disabled>--Choose Roles--</option>
                <option value="Admin">Administrator</option>
                <option value="GM">General Manager</option>
                <option value="PM">Project Manager</option>
                <option value="PIC">Person In Charge</option>
              </select>
            </div>
            @error('roles')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <label for="phone" class="form-label">Phone*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                +62
              </div>
              <input type="text" class="form-control ps-5 @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            </div>
            @error('phone')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <label for="email" class="form-label">Email Address*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-envelope-fill"></i>
              </div>
              <input type="email" class="form-control ps-5 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
            </div>
            @error('email')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <label for="password" class="form-label">Password*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-lock-fill"></i>
              </div>
              <input type="password" class="form-control ps-5 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password">
            </div>
            @error('password')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <label for="repeat" class="form-label">Repeat Password*</label>
            <div class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-lock-fill"></i>
              </div>
              <input type="password" class="form-control ps-5 @error('repeat') is-invalid @enderror" name="repeat" id="repeat" placeholder="Repeat Password">
            </div>
            @error('repeat')
            <small class="d-block ms-2 mt-1 text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
        </div>
        <small class="text-danger">*) Field must be filled (required)</small>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create user</button>
      </div>
    </form>
  </div>
  
</main>
<!--end page main-->

@endsection