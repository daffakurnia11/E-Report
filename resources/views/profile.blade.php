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
    <div class="breadcrumb-title pe-3">My Profile</div>
    <div class="ms-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="bi bi-house-door"></i> Dashboard
            </a>
          </li>
          <li class="breadcrumb-item active">
            My Profile
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <h6 class="mb-0 text-uppercase">Details of {{ auth()->user()->name }}</h6>
  <hr>
  <div class="card col-xxl-8">
    <form action="/profile/{{ auth()->user()->id }}/update" method="post">
      @csrf
      @method("PUT")
      <div class="card-body">
        <h6 class="mb-0 text-uppercase">Credentials</h6>
        <hr>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', auth()->user()->name) }}">
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', auth()->user()->email) }}">
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Phone</label>
            <div class="input-group"> 
              <span class="input-group-text" id="basic-addon1">+62</span>
              <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}">
            </div>
            @error('phone')
            <small class="text-danger">
              {{ $message }}
            </small>
            @enderror
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update!</button>
      </div>
    </form>
  </div>
  <div class="card col-xxl-8">
    <form action="/profile/{{ auth()->user()->id }}/changepass" method="post">
      @csrf
      @method("PUT")
      <div class="card-body">
        <h6 class="mb-0 mt-3 text-uppercase">Password Configuration</h6>
        <hr>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Old Password</label>
            <input type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" id="oldpass">
            @error('oldpass')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-4 col-sm-6 mb-3">
            <label class="form-label fw-bold">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-4 col-sm-6 mb-3">
            <label class="form-label fw-bold">Repeat Password</label>
            <input type="password" class="form-control @error('repeat') is-invalid @enderror" name="repeat" id="repeat">
            @error('repeat')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Change Password!</button>
      </div>
    </form>
  </div>
  <div class="card col-lg-8">
    <div class="card-body">
      <h6 class="mb-0 mt-3 text-uppercase">Authorization Status</h6>
      <hr>
      <div class="row">
        <div class="col-md-4 col-sm-6 mb-3">
          <label class="form-label fw-bold">Roles</label>
          <input type="text" readonly class="form-control-plaintext" value="{{ auth()->user()->roles ?: 'Not signed' }}">
        </div>
      </div>
    </div>
  </div>
  
</main>
<!--end page main-->

@endsection