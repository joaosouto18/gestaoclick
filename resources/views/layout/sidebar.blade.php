<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ url('assets/images/faces/face8.jpg') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{isset($user->name) ? $user->name : ""}}</p>
            <div class="dropdown" data-display="static">
   
              <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>
                <a class="dropdown-item" href="{{ url('/logout') }}"> Sair</a>
              </div>                                
            </div>
          </div>
        </div>
      
      </div>
    </li>
    
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">  
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">  
      <a class="nav-link" href="{{ url('list-users') }}">
        <i class="menu-icon mdi mdi-account-key"></i>
        <span class="menu-title">Usuários</span>
      </a>
    </li>

    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">  
      <a class="nav-link" href="{{ url('/list-products') }}">
        <i class="menu-icon mdi mdi-panda"></i>
        <span class="menu-title">Produtos</span>
      </a>
    </li>

    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}" style="display:none">  
      <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-dna"></i>
        <span class="menu-title">Basic UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="basic-ui">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Buttons</a>
          </li>
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Dropdowns</a>
          </li>
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/basic-ui/typography') }}">Typography</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
      <a class="nav-link" href="{{ url('/report') }}">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Relatório</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}" style="display:none">  
      <a class="nav-link" href="{{ url('/tables/basic-table') }}">
        <i class="menu-icon mdi mdi-table-large"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}" style="display:none">  
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-emoticon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}" style="display:none">  
      <a class="nav-link" data-toggle="collapse" href="#user-pages"  aria-controls="user-pages">
        <i class="menu-icon mdi mdi-lock-outline"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="user-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/user-pages/login') }}">Login</a>
          </li>
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/user-pages/register') }}">Register</a>
          </li>
          <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"> 
            <a class="nav-link" href="{{ url('/user-pages/lock-screen') }}">Lock Screen</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item" style="display:none">
      <a class="nav-link" href="https://www.bootstrapdash.com/demo/star-laravel-free/documentation/documentation.html" target="_blank">
        <i class="menu-icon mdi mdi-file-outline"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>