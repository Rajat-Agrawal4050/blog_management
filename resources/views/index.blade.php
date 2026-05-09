<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobYaari – Blogs</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>

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
        <a href="#" class="active">Blogs</a>
        <a href="#">Contact</a>
      </nav>
      <a class="whatsapp-btn" href="#" title="WhatsApp"><i class="fab fa-whatsapp fa-lg"></i></a>
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

  <!-- HERO BANNER -->
  <div class="hero">
    <h1>Blogs</h1>
    <div class="breadcrumb d-flex justify-content-center">
      <a href="#">Home</a>
      <span>/</span>
      <span>Blogs</span>
    </div>

    <!-- Search Bar -->
    <div class="search-wrap">
      <svg width="18" height="18" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <input type="text" placeholder="Search keyword...">

      <button type="button">Search</button>
    </div>
  </div>

  <!-- MAIN -->
  <div class="main-wrapper">

    <!-- BLOG LIST -->
    <main class="blog-list" id="tableBody">
    </main>

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <div class="sidebar-card">
        <p class="card-heading">Blogs Categories</p>
        <ul class="cat-list">
          @foreach($categories as $cat)
          <li><a href="#" data-val="{{ $cat->title }}" class="blog_cat"><span class="cat-left"> <input type="checkbox" class="form-check-input category-filter" value="{{ $cat->id }}">  {{ $cat->title }}</span><span class="cat-count">{{ $cat->posts()->count() }}</span></a></li>
          @endforeach
        </ul>
      </div>

      <div class="sidebar-card">
        <p class="card-heading">Post Date</p>
        <ul class="cat-list">
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="today"> Today</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="this_week"> This Week</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="this_month"> This Month</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="last_three_month"> Last Three Month</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="this_year"> This Year</a></li>
        </ul>
      </div>

      <!-- Recent Blogs -->
      <div class="sidebar-card">
        <p class="card-heading">Recent Blogs</p>
        <ul class="recent-list">
          @foreach($posts as $p)
          <li>
            <div class="post-thumb">
              <img src="/uploads/{{ $p->image }}" alt="Central Bank of India AGM">
            </div>
            <div class="post-meta">
              <a class="post-title" href="#">{{ $p->title }}</a>
              <span class="post-date"> {{ $p->created_at->format('d M Y') }}</span>
            </div>
          </li>
          @endforeach
        </ul>
      </div>

    </aside>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script>
    const ham = document.getElementById('ham');
    const mNav = document.getElementById('mobileNav');
    ham.addEventListener('click', () => mNav.classList.toggle('open'));
  </script>

  <script>
    let blogs = [];
    let limit = 5;
    let start = 0;

    function fetchData() {
      $.ajax({
        type: 'GET',
        url: '{{ route("get_blogs") }}',
        beforeSend: function() {},
        success: function(resp) {
          console.log(resp)
          blogs = resp;
          renderTable();
        },
        error: function(xhr, status, code) {
          console.error(xhr);
        },
      });
    }

    fetchData();

    var windowHeight = $(window).height();

    $(window).on("scroll", function() {
      var windowTop = $(window).scrollTop() + 1;

      if (windowTop >= windowHeight) {
        windowHeight = $(window).height() + windowTop - 100;

        start += limit;
        limit += 5;
        fetchData();

      }
    });

    function renderTable() {
      const rows = blogs.slice(start, limit);
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML += rows.map(b => {
        const date = new Date(b.created_at);

        const formatted = date.toLocaleDateString('en-GB', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });
        return `
         <article class="blog-card">
        <div class="blog-thumb-placeholder" style="background-image: url('uploads/${b.image}');">
      
        </div>
        <div class="blog-content">
          <h2><a href="#">${b.title}</a></h2>
          <p class="blog-excerpt">${b.short_description}</p>
            <div class="read_more_div">
                <a href="/blog-detail/${b.id}" class="read-more">Read More</a>
          <span class="post-date1">${formatted}</span>
            </div>
        
        </div>
      </article>
    `
      }).join('');
    }

   
  </script>

</body>

</html>