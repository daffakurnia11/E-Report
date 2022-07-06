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
          <li class="breadcrumb-item active" aria-current="page">
            <i class="bi bi-people-fill"></i> User Management
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End of Title Page -->

  <h6 class="mb-0 text-uppercase">List of Users</h6>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Roles</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td class="text-center align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $user->name }}</td>
              <td class="align-middle">{{ $user->username }}</td>
              <td class="align-middle">{{ $user->email }}</td>
              <td class="align-middle">{{ $user->phone }}</td>
              <td class="text-center align-middle">{{ $user->roles ?: 'Not signed' }}</td>
              <td class="text-center align-middle">{{ $user->verified_at ?: 'Not verified' }}</td>
              <td class="text-center align-middle">
                <a href="/user/{{ $user->username }}/edit" class="btn p-0 text-warning">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <form action="/user/{{ $user->username }}" method="post" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="deleteConfirm text-danger btn p-0"><i class="bi bi-trash-fill"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Roles</th>
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