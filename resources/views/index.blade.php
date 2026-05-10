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
  <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">

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
      <input type="text" id="keyword" placeholder="Search keyword...">

      <button id="searchBar" type="button">Search</button>
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
          @php $count = 0; @endphp

          @foreach($categories as $cat)
          @break($count == 5)
          @if($cat->posts_count>0)
          <li><a href="#" data-val="{{ $cat->title }}" class="blog_cat"><span class="cat-left"> <input type="checkbox" class="form-check-input category-filter" value="{{ $cat->id }}"> {{ $cat->title }}</span><span class="cat-count">{{ $cat->posts_count }}</span></a></li>
          @php $count++; @endphp
          @endif
          @endforeach
        </ul>
      </div>

      <div class="sidebar-card">
        <p class="card-heading">Post Date</p>
        <ul class="cat-list">
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="<?php echo date('Y-m-d'); ?>"> Today</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>"> This Week</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="<?php echo date('Y-m-d', strtotime('-1 month')); ?>"> This Month</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="<?php echo date('Y-m-d', strtotime('-3 month')); ?>"> Last Three Month</a></li>
          <li><a href="#"><span class="cat-left"><input type="checkbox" class="form-check-input date-filter" value="<?php echo date('Y-m-d', strtotime('-1 year')); ?>"> This Year</a></li>
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
  <script src="/sweet-alert2/sweetalert2.min.js"></script>

  <script>
    const ham = document.getElementById('ham');
    const mNav = document.getElementById('mobileNav');
    ham.addEventListener('click', () => mNav.classList.toggle('open'));
  </script>

  <script>
    let blogs = [];
    let filteredBlogs = [];

    let selectedCategories = [];
    let selectedDates = [];
    let searchKeyword = '';

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
          filteredBlogs = blogs;

          start = 0;
          limit = 5;

          renderTable(true);
        },
        error: function(xhr, status, code) {
          console.error(xhr);
        },
      });
    }

    fetchData();

    var windowHeight = $(window).height();

    $(window).on("scroll", function() {
      var windowTop = $(window).scrollTop() + 120;

      if (windowTop >= windowHeight) {
        windowHeight = $(window).height() + windowTop - 100;

        start += limit;
        limit += 5;

        renderTable(false);

      }
    });

    function applyFilters() {

      filteredBlogs = blogs.filter(blog => {

        let categoryMatch = true;

        if (selectedCategories.length > 0) {

          categoryMatch = selectedCategories.includes(
            blog.category.id.toString()
          );
        }

        let dateMatch = true;

        if (selectedDates.length > 0) {

          dateMatch = false;
          const blogDate = new Date(blog.created_at).toISOString().split('T')[0];
          // console.log(blogDate)
          selectedDates.forEach(function(date) {
            if (blogDate >= date) {
              dateMatch = true;
            }
          })
        }

        let keywordMatch = true;

        if (searchKeyword !== '') {

          keywordMatch =
            blog.title.toLowerCase().includes(searchKeyword) ||
            blog.short_description.toLowerCase().includes(searchKeyword);
        }

        return categoryMatch && dateMatch && keywordMatch;
      });

      // Reset Pagination

      start = 0;
      limit = 5;
      // console.log(filteredBlogs)
      renderTable(true);
    }

    $(document).on('change', '.category-filter', function() {

      selectedCategories = [];

      $('.category-filter:checked').each(function() {
        selectedCategories.push($(this).val());
      });
      console.log(selectedCategories)

      applyFilters();
    });

    $(document).on('change', '.date-filter', function() {

      selectedDates = [];

      $('.date-filter:checked').each(function() {

        selectedDates.push($(this).val());
      });
      console.log('selected_dates' + selectedDates)
      applyFilters();
    });

    $('#searchBar').on('click', function() {

      searchKeyword = $('#keyword').val().trim().toLowerCase();

      if (searchKeyword === '') {
        Swal.fire('error', 'Enter Any Keyword', 'error');
        return;
      }

      applyFilters();
    });


    function renderTable(clear = false) {
      const rows = filteredBlogs.slice(start, limit);
      const tbody = document.getElementById('tableBody');

      if (clear) {
        tbody.innerHTML = '';
      }

      result = false;
      tbody.innerHTML += rows.map(b => {
        result = true;
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

      if (!result) {
        tbody.innerHTML += `
      <div style="margin-top:5%;" class="text-center alert alert-danger alert-dismissible fade show">
        No Result Found
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`;
      }
    }
  </script>

</body>

</html>