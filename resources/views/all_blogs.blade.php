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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">
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
      <span>All Blogs</span>
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
  <div class="container-fluid blogs_container">
    <div class="row">

      <!-- SIDEBAR -->
      <div class="col-md-3">

        <div class="sidebar-card" style="min-height: 100vh;">
          <p class="card-heading">Admin - Rajat Agrawal</p>
          <ul class="cat-list">
            <li><a href="#"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Dashboard</span></a></li>
            <li><a href="#"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Add Blogs</span></a></li>
            <li><a href="#"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Logout</span></a></li>

          </ul>
        </div>
      </div>

      <div class="col-md-9">

        <div class="container-fluid py-4 px-4">

          <!-- Top Buttons -->
          <div class="d-flex gap-2 mb-3">
            <button onclick="window.location.href='/add_blog'" class="btn btn-add btn-sm px-3">
              <i class="bi bi-plus-lg me-1"></i> Add Blogs
            </button>
            <!-- <button class="btn btn-outline-secondary btn-sm px-3 btn-export">
      <i class="bi bi-box-arrow-up me-1"></i> Export
    </button> -->
          </div>

          <!-- Table Card -->
          <div class="card">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-bordered mb-0" id="blogsTable">
                  <thead>
                    <tr>
                      <th class="check-col text-center">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                      </th>
                      <th>Blog ID <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Blog Title <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Category <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Image <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableBody">
                    <!-- Rows injected by JS -->
                  </tbody>
                </table>
              </div>

              <!-- Footer: Show entries + Pagination -->
              <div class="d-flex justify-content-between align-items-center px-3 py-2 border-top flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2 text-muted" style="font-size:13px;">
                  Show
                  <select class="form-select form-select-sm select-entries" id="entriesSelect">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  entries
                </div>
                <nav>
                  <ul class="pagination pagination-sm mb-0" id="pagination"></ul>
                </nav>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

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

    function fetchData(){
$.ajax({
      type: 'GET',
      url: '{{ route("get_blogs") }}',
      beforeSend: function() {},
      success: function(resp) {
        console.log(resp)
        blogs = resp;
        renderTable();
        renderPagination();
      },
      error: function(xhr, status, code) {
        console.error(xhr);
      },
    });
    }

    fetchData();
    
    let perPage = 10,
      currentPage = 1;

    function renderTable() {
      const start = (currentPage - 1) * perPage;
      const rows = blogs.slice(start, start + perPage);
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML = rows.map(b => `
      <tr>
        <td class="text-center"><input class="form-check-input row-check" type="checkbox"></td>
        <td>${b.id}</td>
        <td><div class="blog-title" title="${b.title}"><a class="blog-title" style="text-decoration:none;color:#333;" href="/blog-detail/${b.id}">${b.title}</a></div></td>
        <td><span class="badge-category">${b.category.title}</span></td>
        <td class="text-center"><img src="/uploads/${b.image}" height="50px" width="50px" class="" alt="thumb"></td>
        <td>
          <button class="btn-action edit" onclick="window.location.href='/edit-blog/${b.id}'" title="Edit"><i class="bi bi-pencil-square"></i></button>
          <button class="btn-action delete" data-id="${b.id}" onclick="deletePost(this)" title="Delete"><i class="bi bi-trash"></i></button>
        </td>
      </tr>
    `).join('');
    }

    function renderPagination() {
      const totalPages = Math.ceil(blogs.length / perPage);
      const ul = document.getElementById('pagination');
      let html = `<li class="page-item ${currentPage===1?'disabled':''}">
      <a class="page-link" href="#" onclick="goPage(${currentPage-1})">Previous</a></li>`;
      for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i===currentPage?'active':''}">
        <a class="page-link ${i===currentPage?'text-white':''}" href="#" onclick="goPage(${i})">${i}</a></li>`;
      }
      html += `<li class="page-item ${currentPage===totalPages?'disabled':''}">
      <a class="page-link text-primary" href="#" onclick="goPage(${currentPage+1})">Next</a></li>`;
      ul.innerHTML = html;
    }

    function goPage(p) {
      console.log('go page')
      const total = Math.ceil(blogs.length / perPage);
      if (p < 1 || p > total) return;
      currentPage = p;
      fetchData();
      renderTable();
      renderPagination();
    }

    document.getElementById('entriesSelect').addEventListener('change', function() {
      perPage = parseInt(this.value);
      currentPage = 1;
      fetchData();
      renderTable();
      renderPagination();
    });

    document.getElementById('checkAll').addEventListener('change', function() {
      document.querySelectorAll('.row-check').forEach(c => c.checked = this.checked);
    });
  </script>

  
<script>
  function deletePost(ele) {
    let id = ele.getAttribute('data-id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You want to delete this Post!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({
          url: '{{ route("delete_post") }}',
          method: "DELETE",
          data: {
            id: id,
            deletePost: true,
            _token: '{{ csrf_token() }}',
          },
          success: function(data) {
            console.log(data)
            if (data.trim() == '1') {
              Swal.fire({
                title: 'Deleted!',
                text: 'This Post has been deleted.',
                icon: 'success',
                confirmButtonText: 'OK'

              })
              ele.closest('tr').remove(); 
            } else if (data.trim() == '-2') {
              Swal.fire('Post Not Found', '', 'error');
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          },
          error: function(xhr, status, code) {
            console.error(xhr.responseText);
          }

        })


      }
    })

  }
</script>
</body>

</html>