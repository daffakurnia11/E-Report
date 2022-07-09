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
    <li class="{{ Request::is('/project') ?? 'mm-active' }}">
      <a href="/project">
        <div class="parent-icon"><i class="bi bi-diagram-3"></i>
        </div>
        <div class="menu-title">Project Management</div>
      </a>
    </li>
    @endcan

    @can('pm')
    <li class="menu-label">Project Manager</li>
    <li class="{{ Request::is('/my-project') ?? 'mm-active' }}">
      <a href="/my-project">
        <div class="parent-icon"><i class="bi bi-list-check"></i>
        </div>
        <div class="menu-title">Project Data</div>
      </a>
    </li>
    @endcan

    @can('pic')
    <li class="menu-label">Person In Charge</li>
    <li class="{{ Request::is('/my-block') ?? 'mm-active' }}">
      <a href="/my-block">
        <div class="parent-icon"><i class="bi bi-boxes"></i>
        </div>
        <div class="menu-title">Block Data</div>
      </a>
    </li>
    <li class="{{ Request::is('/equipment**') ?? 'mm-active' }}">
      <a class="has-arrow" href="javascript:;" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-plugin"></i>
        </div>
        <div class="menu-title">Equipment</div>
      </a>
      <ul class="mm-collapse {{ Request::is('/equipment**') ?? 'mm-show' }}" style="">
        <li class="{{ Request::is('/equipment/gas') ?? 'mm-active' }}"> 
          <a href="/equipment/gas" target="_blank">
            <i class="bi bi-arrow-right-short"></i> Gas
          </a>
        </li>
        <li class="{{ Request::is('/equipment/electric') ?? 'mm-active' }}"> 
          <a href="/equipment/electric" target="_blank">
            <i class="bi bi-arrow-right-short"></i> Electric
          </a>
        </li>
        <li class="{{ Request::is('/equipment/renewable') ?? 'mm-active' }}"> 
          <a href="/equipment/renewable" target="_blank">
            <i class="bi bi-arrow-right-short"></i> Renewable
          </a>
        </li>
      </ul>
    </li>
    @endcan

  </ul>
  <!--end navigation-->
</aside>
<!--end sidebar -->