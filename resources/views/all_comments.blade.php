<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog Site – Admin Panel</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">
  <link rel="stylesheet" href="/css/style.css">

</head>

<body>

  @include('header')

  <!-- HERO BANNER -->
  <div class="hero">
    <h1>Admin</h1>
    <div class="breadcrumb d-flex justify-content-center">
      <a href="#">Home</a>
      <span>/</span>
      <span>Admin Panel</span>
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
            <li><a href="/dashboard"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Dashboard</span></a></li>
            <li><a href="/add_blog"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Add Blogs</span></a></li>
            <li><a href="/all_comments"><span class="cat-left"><span class="cat-arrow">&#9658;</span> All Comments</span></a></li>
            <li><a href="/api/auth/logout"><span class="cat-left"><span class="cat-arrow">&#9658;</span> Logout</span></a></li>

          </ul>
        </div>
      </div>

      <div class="col-md-9">

        <div class="container-fluid py-4 px-4">

          <!-- Top Buttons -->
          <div class="d-flex gap-2 mb-3">
            <H5>All Comments</H5>
            <!-- <button onclick="window.location.href='/add_blog'" class="btn btn-add btn-sm px-3">
              <i class="bi bi-plus-lg me-1"></i> Add Blogs
            </button> -->
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
                      <th>Blog Post <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Commenter <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
                      <th>Comment <span class="sort-icon"><i class="bi bi-arrow-down-up"></i></span></th>
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



  <!-- ── Edit Comment Modal ── -->
  <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:500px">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="editCommentModalLabel">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              viewBox="0 0 16 16" class="me-2" style="vertical-align:-.15em">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0
                     0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0
                     1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5
                     0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5
                     0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0
                     0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
            </svg>
            Edit Comment
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Meta strip -->
        <div class="meta-strip">
          <div class="avatar2" id="modalAvatar">RA</div>
          <div>
            <div class="meta-name" id="modalCommenterName">Rajat Agrawal</div>
            <div class="meta-sub" id="modalCommenterDate">18 May 2026</div>
          </div>
          <div class="badge-blog" id="modalBlogBadge">New Blog11 · ID #8</div>
        </div>

        <!-- Body -->
        <div class="modal-body">
          <input type="hidden" id="modalCommentId" />

          <div class="mb-3">
            <label class="form-label" for="modalCommentText">Comment</label>
            <textarea class="form-control" id="modalCommentText" rows="4"
              maxlength="500" placeholder="Write your comment…"></textarea>
            <div class="char-count" id="charCount">0 / 500</div>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-save" id="saveCommentBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
              viewBox="0 0 16 16" class="me-1" style="vertical-align:-.15em">
              <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4.414A1 1
                     0 0 0 14.707 4L12 1.293A1 1 0 0 0 11.293 1zm9 1 2 2v.293H2V2zM4 8h8v5H4z" />
            </svg>
            Save Changes
          </button>
        </div>

      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="/sweet-alert2/sweetalert2.min.js"></script>
  <script src="/js/custom-js.js"></script>

  <script>
    let comments = [];

    function fetchData() {
      $.ajax({
        type: 'GET',
        url: '{{ route("get_comments") }}',
        beforeSend: function() {},
        success: function(resp) {
          console.log(resp)

          comments = resp.comments;
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
      const rows = comments.slice(start, start + perPage);
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML = rows.map(b => {
        const formatted = new Date(b.created_at).toLocaleDateString('en-IN', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });
        return `
      <tr>
       <td class="text-center"><input class="form-check-input row-check" type="checkbox"></td>
        <td class="post-title-cell">
          <strong>${b.post?.title}</strong>
          <span class="post-id-badge">ID #${b.post?.id}</span>
        </td>
    
        <td>
        <div class="commenter">
            <div class="avatar" style="background:#0891b2">${ b.user?.name?.split(' ')?.[0]?.[0] ?? '' }${ b.user?.name?.split(' ')?.[1]?.[0] ?? '' }</div>
            <div>
              <div class="commenter-name">${b.user?.name}</div>
              <div class="commenter-date">${formatted}</div>
            </div>
          </div>
          </td>

          <td class="comment-text-cell"><div id="commentCell-${b.id}" class="comment-text">${b.body}</div></td>
        <td>
          <button class="btn-action edit" onclick="openEditModal(${b.id})" title="Edit"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
          <button class="btn-action delete" data-id="${b.id}" onclick="deleteComment(this)" title="Delete"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6l-1 14H6L5 6"></path><path d="M10 11v6M14 11v6"></path><path d="M9 6V4h6v2"></path></svg></button>
        </td>
      </tr>
    `
      }).join('');
    }

    function renderPagination() {
      const totalPages = Math.ceil(comments.length / perPage);
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
      const total = Math.ceil(comments.length / perPage);
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

    // Open modal
    let activeId = null;

    function openEditModal(id) {
      const c = comments.find(x => x.id == id);
      if (!c) return;
      activeId = id;
      // console.log(c)
      // return

      const formatted = new Date(c.created_at).toLocaleDateString('en-IN', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });

      document.getElementById('modalCommentId').value = c.id;
      document.getElementById('modalAvatar').textContent = `${ c.user?.name?.split(' ')?.[0]?.[0] ?? '' }${ c.user?.name?.split(' ')?.[1]?.[0] ?? '' }`;
      document.getElementById('modalCommenterName').textContent = c.user.name;
      document.getElementById('modalCommenterDate').textContent = formatted;
      document.getElementById('modalBlogBadge').textContent = `${c.post.title} · ID #${c.post.id}`;
      document.getElementById('modalCommentText').value = c.body;
      updateCharCount(c.body.length);

      new bootstrap.Modal(document.getElementById('editCommentModal')).show();
    }

    // Char counter
    function updateCharCount(len) {
      const el = document.getElementById('charCount');
      el.textContent = `${len} / 500`;
      el.classList.toggle('warn', len > 450);
    }
    document.getElementById('modalCommentText').addEventListener('input', function() {
      updateCharCount(this.value.length);
    });

    // Save Edit Modal
    document.getElementById('saveCommentBtn').addEventListener('click', () => {
      const newText = document.getElementById('modalCommentText').value.trim();
      if (!newText) {
        document.getElementById('modalCommentText').classList.add('is-invalid');
        return;
      }
      document.getElementById('modalCommentText').classList.remove('is-invalid');

      // Update in DB

      $.ajax({
        url: '/api/comments/' + activeId,
        method: "PUT",
        data: {
          id: activeId,
          updateComment: true,
          text: newText,
          _token: '{{ csrf_token() }}',
        },
        success: function(data) {
          console.log(data)

          if (data.data) {

            // Update data
            const c = comments.find(x => x.id == activeId);
            if (c) {
              c.body = newText;
            }

            // Update cell in table
            const cell = document.getElementById(`commentCell-${activeId}`);
            if (cell) cell.innerHTML = newText;

            bootstrap.Modal.getInstance(document.getElementById('editCommentModal')).hide();
            Swal.fire('success', 'Edited Successfully', 'success');
          }
        },
        error: function(xhr, status, code) {
          console.error(xhr.responseText);
          if (xhr.status === 401 || xhr.status === 403) {

            let response = JSON.parse(xhr.responseText);
            Swal.fire('error', response.message, 'error');
          }

          const errors = xhr.responseJSON?.errors;
          if (errors?.text) {
            document.getElementById('modalCommentText').classList.add('is-invalid');
          }
        }

      })

    });
  </script>


  <script>
    function deleteComment(ele) {
      let id = ele.getAttribute('data-id');

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this Comment!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '/api/comments/' + id,
            method: "DELETE",
            data: {
              id: id,
              deletePost: true,
              _token: '{{ csrf_token() }}',
            },
            success: function(data) {
              console.log(data)

              Swal.fire({
                title: 'Deleted!',
                text: 'This Comment has been deleted.',
                icon: 'success',
                confirmButtonText: 'OK'

              })
              ele.closest('tr').remove();

            },
            error: function(xhr, status, code) {
              console.error(xhr.responseText);
              if (xhr.status === 401 || xhr.status === 403) {

                let response = JSON.parse(xhr.responseText);
                Swal.fire('error', response.message, 'error');
              }
            }

          })


        }
      })

    }
  </script>
</body>

</html>
