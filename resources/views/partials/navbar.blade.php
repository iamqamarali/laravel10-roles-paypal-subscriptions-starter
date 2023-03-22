<nav class="navbar navbar-expand py-3 bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('/imgs/fbacity.jpg') }}" style="width:120px" alt="">
      </a>
      
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a 
            @class([
                'nav-link',
                'active' => Route::is('admin.dashboard')
            ]) 
            href="{{ route('admin.dashboard') }}">
               Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a 
              @class([
                'nav-link',
                'active' => Route::is('admin.users.index')
              ]) 
              href="{{ route('admin.users.index') }}">
              Users
            </a>
          </li>            
         
          {{-- user shit here --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="@route('logout')">Logout</a></li>
            </ul>
          </li>
  
        </ul>
      </div>
  
    </div>
  </nav>