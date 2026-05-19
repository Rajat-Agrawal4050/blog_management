  <!-- HEADER -->
  <header>
    <div class="nav-inner">
      <a class="logo" href="#">
        <div class="logo-icon">JY</div>
        <span class="logo-text">JobYaari</span>
      </a>
      <nav>
        <a href="#">Home</a>
        <a href="#" class="nav-jobs">Jobs</a>
        <a href="#">Admit Card</a>
        <a href="#">Result</a>
        <a href="#">About</a>
        <a href="/admin_login" class="active">Admin</a>
        <a href="#">Contact</a>
      </nav>
      <a class="whatsapp-btn" href="#" title="WhatsApp"><i class="fab fa-whatsapp fa-lg"></i></a>

      @auth

      <div class="auth-area" id="authArea">

        <div class="user-btn" id="userBtn" style="display: flex;" onclick="toggleDropdown()">
          <div class="avatar" id="avatarCircle">{{ (isset(explode(' ',trim(auth()->user()->name))[0]) ? strtoupper(explode(' ',trim(auth()->user()->name))[0])[0] : '') . (isset(explode(' ',trim(auth()->user()->name))[1]) ? strtoupper(explode(' ',trim(auth()->user()->name))[1])[0] : '') }}</div>
          <span class="user-name" id="userName">{{ auth()->user()->name }}</span>
          <span class="user-chevron">▾</span>
        </div>

        <div class="dropdown" id="dropdown">
          <div class="dropdown-header">
            <div class="dropdown-avatar">{{ (isset(explode(' ',trim(auth()->user()->name))[0]) ? strtoupper(explode(' ',trim(auth()->user()->name))[0])[0] : '') . (isset(explode(' ',trim(auth()->user()->name))[1]) ? strtoupper(explode(' ',trim(auth()->user()->name))[1])[0] : '') }}</div>
            <div>
              <div class="dropdown-name">{{ auth()->user()->name }}</div>
              <div class="dropdown-email">{{ auth()->user()->email }}</div>
            </div>
          </div>
          <div class="dropdown-item text-center logout" onclick="window.location.href='/api/auth/logout'">
            <i class="ti ti-logout" aria-hidden="true"></i> Logout
          </div>

        </div>
      </div>
      @else
      <button class="login-btn" id="loginBtn" onclick="window.location.href='/auth/login'">
        <i class="ti ti-user" style="font-size:15px;"></i> Login
      </button>
      @endauth

      <button class="hamburger" id="ham" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
    <div class="mobile-nav" id="mobileNav">
      <a href="#">Home</a>
      <a href="#">Jobs ▾</a>
      <a href="#">Admit Card</a>
      <a href="#">Result</a>
      <a href="#">About</a>
      <a href="#" style="color:var(--blue)">Blogs</a>
      <a href="#">Contact</a>
    </div>
  </header>