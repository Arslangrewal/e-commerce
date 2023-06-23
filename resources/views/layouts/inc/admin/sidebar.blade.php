<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item" {{ Request::is('admin/dashboard') ? 'active': ''}}>
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-view-dashboard menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" {{ Request::is('admin/orders') ? 'active': ''}}>
        <a class="nav-link" href="{{ url('admin/orders') }}">
          <i class="mdi mdi-multiplication-box menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item"  {{ Request::is('admin/products') ? 'active': ''}}>
        <a class="nav-link" data-bs-toggle="collapse" 
        href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi  mdi-reproduction menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/products')}}">Products</a></li>
            <li class="nav-item"> <a class="nav-link    " href="pages/ui-features/typography.html">Product Image</a></li>
          </ul>
        </div>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/category')}}">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">Categories</span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/brands')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/colors')}}">
          <i class="mdi mdi-invert-colors menu-icon"></i>
          <span class="menu-title">Colors</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/sliders')}}">
          <i class="mdi mdi-view-carousel menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/settings')}}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Site Setting</span>
        </a>
      </li>
    </ul>
  </nav>