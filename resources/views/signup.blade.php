@extends('layouts.main')

@section('content')
    
<main class="authentication-content">
  <div class="container-fluid">
    <div class="authentication-card">
      <div class="card shadow rounded-0 overflow-hidden">
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title">Sign Up</h5>
          <p class="card-text mb-3">Please fill this form completely!</p>
          <form method="post" action="" class="form-body">
            @csrf
            <div class="row g-3">
              <div class="col-12">
                <label for="name" class="form-label">Full Name</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <input type="text" class="form-control radius-30 ps-5 @error('name') is-invalid @enderror" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
                </div>
                @error('name')
                <small class="d-block ms-2 mt-1 text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <input type="text" class="form-control radius-30 ps-5 @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                </div>
                @error('username')
                <small class="d-block ms-2 mt-1 text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <i class="bi bi-envelope-fill"></i>
                  </div>
                  <input type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                </div>
                @error('email')
                <small class="d-block ms-2 mt-1 text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <i class="bi bi-lock-fill"></i>
                  </div>
                  <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password">
                </div>
                @error('password')
                <small class="d-block ms-2 mt-1 text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="col-12">
                <label for="repeat" class="form-label">Repeat Password</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <i class="bi bi-lock-fill"></i>
                  </div>
                  <input type="password" class="form-control radius-30 ps-5 @error('repeat') is-invalid @enderror" name="repeat" id="repeat" placeholder="Repeat Password">
                </div>
                @error('repeat')
                <small class="d-block ms-2 mt-1 text-danger">
                  {{ $message }}
                </small>
                @enderror
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary radius-30">Sign Up</button>
                </div>
              </div>
              <div class="col-12">
                <p class="mb-0 text-center">
                  Already have an account? <a href="/signin">Sign in here</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection