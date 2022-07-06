<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="/img/logo-icon.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">E-Report</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li class="{{ Request::is('/') ?? 'mm-active' }}">
      <a href="/">
        <div class="parent-icon"><i class="bi bi-house-door"></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    @can('admin')
    <li class="menu-label">Administrator</li>
    <li class="{{ Request::is('/user') ?? 'mm-active' }}">
      <a href="/user">
        <div class="parent-icon"><i class="bi bi-people-fill"></i>
        </div>
        <div class="menu-title">User Management</div>
      </a>
    </li>    
    @endcan

    @can('gm')
    <li class="menu-label">General Manager</li>
    @endcan

    @can('pm')
    <li class="menu-label">Project Manager</li>
    @endcan

    @can('pic')
    <li class="menu-label">Person In Charge</li>
    @endcan

  </ul>
  <!--end navigation-->
</aside>
<!--end sidebar -->