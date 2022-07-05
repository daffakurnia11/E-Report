@extends('layouts.main')

@section('content')
    
<main class="authentication-content">
  <div class="container-fluid">
    <div class="authentication-card">
      <div class="card shadow rounded-0 overflow-hidden">
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title">Sign In</h5>
          <p class="card-text mb-5">See your growth and get consulting support!</p>
          <form class="form-body">
            <div class="row g-3">
              <div class="col-12">
                <label for="inputEmailAddress" class="form-label">Email Address</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                      class="bi bi-envelope-fill"></i></div>
                  <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress"
                    placeholder="Email Address">
                </div>
              </div>
              <div class="col-12">
                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                <div class="ms-auto position-relative">
                  <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                      class="bi bi-lock-fill"></i></div>
                  <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword"
                    placeholder="Enter Password">
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                </div>
              </div>
              <div class="col-12">
                <p class="mb-0 text-center">
                  Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
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