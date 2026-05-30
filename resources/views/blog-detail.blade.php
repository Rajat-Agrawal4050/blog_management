<?php

use App\Models\Comment;
use App\Models\Post;

$post = Post::where('id', $id)->first();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog Site – Blogs</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">

</head>
<style>
  .jy-wrap {
    font-family: 'Nunito', sans-serif;
    max-width: 900px;
    padding: 0 0 2rem;
  }

  .jy-section-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .jy-count-badge {
    background: #1a5dc8;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 2px 10px;
    border-radius: 20px;
  }

  .jy-comment-card {
    background: var(--color-background-primary);
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-lg);
    padding: 1.1rem 1.25rem;
    margin-bottom: 1rem;
    display: flex;
    gap: 14px;
    transition: border-color 0.2s;
  }

  .jy-comment-card:hover {
    border-color: var(--color-border-secondary);
  }

  .jy-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 15px;
    color: #fff;
  }

  .jy-meta {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin-bottom: 6px;
    flex-wrap: wrap;
  }

  .jy-name {
    font-weight: 700;
    font-size: 14px;
    color: var(--color-text-primary);
  }

  .jy-date {
    font-size: 12px;
    color: var(--color-text-secondary);
  }

  .jy-text {
    font-size: 14px;
    color: var(--color-text-secondary);
    line-height: 1.65;
  }

  .jy-actions {
    display: flex;
    gap: 14px;
    margin-top: 10px;
  }

  .jy-btn-like,
  .jy-btn-reply {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
    font-weight: 600;
    color: var(--color-text-secondary);
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 4px 0;
    transition: color 0.2s;
  }

  .jy-btn-like:hover {
    color: #e3445a;
  }

  .jy-btn-reply:hover {
    color: #1a5dc8;
  }

  .jy-btn-like.liked {
    color: #e3445a;
  }

  .jy-like-count {
    min-width: 14px;
  }

  .jy-form-wrap {
    background: var(--color-background-primary);
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-lg);
    padding: 1.4rem 1.5rem;
    margin-bottom: 2rem;
  }

  .jy-form-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 1.1rem;
  }

  .jy-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 12px;
  }

  .jy-field label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--color-text-secondary);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .jy-field input,
  .jy-field textarea {
    width: 100%;
    border: 0.5px solid var(--color-border-secondary);
    border-radius: var(--border-radius-md);
    padding: 9px 13px;
    font-size: 14px;
    font-family: 'Nunito', sans-serif;
    color: var(--color-text-primary);
    background: var(--color-background-secondary);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    resize: none;
  }

  .jy-field input:focus,
  .jy-field textarea:focus {
    border-color: #1a5dc8;
    box-shadow: 0 0 0 3px rgba(26, 93, 200, 0.1);
  }

  .jy-field textarea {
    height: 96px;
  }

  .jy-submit {
    background: #1a5dc8;
    color: #fff;
    border: none;
    border-radius: var(--border-radius-md);
    padding: 10px 28px;
    font-size: 14px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    display: flex;
    align-items: center;
    gap: 7px;
  }

  .jy-submit:hover {
    background: #1550b0;
  }

  .jy-submit:active {
    transform: scale(0.98);
  }

  .jy-submit:disabled {
    background: #8ba8d6;
    cursor: not-allowed;
  }

  .jy-toast {
    display: none;
    background: #eaf3de;
    border: 0.5px solid #97c459;
    color: #3b6d11;
    padding: 10px 16px;
    border-radius: var(--border-radius-md);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 1rem;
    align-items: center;
    gap: 8px;
  }

  .jy-toast.show {
    display: flex;
  }

  .jy-empty {
    text-align: center;
    padding: 2rem;
    color: var(--color-text-secondary);
    font-size: 14px;
  }

  .jy-reply-form {
    margin-top: 12px;
    display: none;
  }

  .jy-reply-form.open {
    display: block;
  }

  .jy-reply-input {
    width: 100%;
    border: 0.5px solid var(--color-border-secondary);
    border-radius: var(--border-radius-md);
    padding: 8px 12px;
    font-size: 13px;
    font-family: 'Nunito', sans-serif;
    color: var(--color-text-primary);
    background: var(--color-background-secondary);
    outline: none;
    resize: none;
    height: 70px;
    transition: border-color 0.2s;
  }

  .jy-reply-input:focus {
    border-color: #1a5dc8;
    box-shadow: 0 0 0 3px rgba(26, 93, 200, 0.1);
  }

  .jy-reply-submit {
    background: #1a5dc8;
    color: #fff;
    border: none;
    border-radius: var(--border-radius-md);
    padding: 6px 16px;
    font-size: 12px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    cursor: pointer;
    margin-top: 7px;
  }

  .jy-replies {
    margin-top: 12px;
    border-top: 0.5px solid var(--color-border-tertiary);
    padding-top: 12px;
  }

  .jy-reply-item {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
  }

  .jy-reply-item .jy-avatar {
    width: 34px;
    height: 34px;
    font-size: 12px;
  }

  .jy-reply-text {
    font-size: 13px;
    color: var(--color-text-secondary);
    line-height: 1.6;
  }

  .jy-reply-name {
    font-weight: 700;
    font-size: 13px;
    color: var(--color-text-primary);
    margin-bottom: 3px;
  }

  .jy-sort-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 1.2rem;
  }

  .jy-sort-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--color-text-secondary);
  }

  .jy-sort-btn {
    background: none;
    border: 0.5px solid var(--color-border-secondary);
    border-radius: 20px;
    padding: 4px 14px;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
    cursor: pointer;
    color: var(--color-text-secondary);
    transition: all 0.2s;
  }

  .jy-sort-btn.active {
    background: #1a5dc8;
    color: #fff;
    border-color: #1a5dc8;
  }

  @media (max-width: 560px) {
    .jy-row {
      grid-template-columns: 1fr;
    }
  }
</style>

<body>

  @include('header')

  <!-- HERO BANNER -->
  <div class="hero">
    <h1>Blogs</h1>
    <div class="breadcrumb d-flex justify-content-center">
      <a href="#">Home</a>
      <span>/</span>
      <span>Blog Detail</span>
    </div>

  </div>

  <!-- MAIN -->
  <div class="main-wrapper">

    <!-- BLOG DETAIL -->
    <main class="blog-list">

      <div class="img_container" style="background-image: url('/uploads/{{ $post->image }}');">
      </div>

      <div><span class="post-date3">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span></div>

      <div class="heading">
        <h5>{{ $post->title }}</h5>
      </div>
      <div class="description">
        <p class="description">{{ $post->short_description }}</p>
      </div>

      <div class="content"><?php echo $post->content ?></div>

      <div class="jy-wrap">
        <h2 class="sr-only">Comments section for blog post</h2>

        <div class="jy-form-wrap mt-3">
          <form id="commentForm" method="post">
            @csrf
            <p class="jy-form-title"><i class="ti ti-message-circle" style="font-size:18px;vertical-align:-2px;margin-right:6px;color:#1a5dc8" aria-hidden="true"></i>Leave a comment</p>
            <div id="jy-toast" class="jy-toast"><i class="ti ti-circle-check" style="font-size:16px" aria-hidden="true"></i><span>Comment posted successfully!</span></div>
            <div class="jy-row">
              <div class="jy-field">
                <label for="jy-name">Your name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" class="form-control" placeholder="Name" maxlength="60" />
              </div>
              <div class="jy-field">
                <label for="jy-email">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email ?? '' }}" id="email" placeholder="example@gmail.com" maxlength="100" />
              </div>
            </div>
            <div class="jy-field" style="margin-bottom:14px">
              <label for="jy-msg">Comment</label>
              <textarea id="msg" name="msg" class="form-control" placeholder="Share your thoughts about this post…" maxlength="800"></textarea>
            </div>
            <input type="hidden" name="blog_id" value="{{ $id }}">
            <button type="submit" class="jy-submit" id="jy-post-btn">
              <i class="ti ti-send" style="font-size:15px" aria-hidden="true"></i> Post comment
            </button>

          </form>
        </div>

        @php
        $total_comments=Comment::where('post_id',$id)->count();
        @endphp
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:1.1rem;">
          <p class="jy-section-title" style="margin-bottom:0">
            <i class="ti ti-messages" style="font-size:20px;color:#1a5dc8" aria-hidden="true"></i>
            Comments <span class="jy-count-badge" id="jy-count">{{ $total_comments }}</span>
          </p>

        </div>

        <div id="jy-comments-list" style="margin-top: 50px;">
          @if(!$total_comments)
          <div class="jy-empty"><i class="ti ti-message-off" style="font-size:32px;display:block;margin:0 auto 8px" aria-hidden="true"></i>No comments yet. Be the first!</div>
          @endif
          @foreach(Comment::with('user')->where('post_id',$id)->latest()->get() as $c)
          <div class="jy-comment-card" id="card-1">
            <div class="jy-avatar" style="background:#1a5dc8;">{{ (isset(explode(' ',trim($c->user->name))[0]) ? strtoupper(explode(' ',trim($c->user->name))[0])[0] : '') . (isset(explode(' ',trim($c->user->name))[1]) ? strtoupper(explode(' ',trim($c->user->name))[1])[0] : '') }}</div>
            <div style="flex:1;min-width:0">
              <div class="jy-meta">
                <span class="jy-name">{{ $c->user->name }}</span>
                <span class="jy-date"><i class="ti ti-clock" style="font-size:11px;vertical-align:-1px" aria-hidden="true"></i>{{ $c->created_at->format('d M, Y') }}</span>
              </div>
              <div class="jy-text">{{ $c->body }}</div>
              <div class="jy-actions">
                <!-- <button class="jy-btn-like liked" aria-label="Like this comment">
                  <i class="ti ti-heart" style="font-size:14px" aria-hidden="true"></i>
                  <span class="jy-like-count">2</span>
                </button> -->
                <!-- <button class="jy-btn-reply" aria-label="Reply to comment">
                  <i class="ti ti-corner-down-right" style="font-size:14px" aria-hidden="true"></i> Reply
                </button> -->
              </div>

            </div>
          </div>
          @endforeach
        </div>

    </main>

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <!-- Categories -->
      <div class="sidebar-card">
        <p class="card-heading">Categories</p>
        <div class="cat-grid">
          @foreach($categories as $cat)
          <a href="javascript:Void(0)" class="cat-pill">{{ $cat->title }}</a>
          @endforeach
        </div>
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
  <script src="/js/custom-js.js"></script>
  <script src="/sweet-alert2/sweetalert2.min.js"></script>

  <script>
    $(document).on('submit', '#commentForm', function(e) {
      console.log('ok')
      e.preventDefault();

      // const BLOG_ID = '{{ $id }}';
      // console.log(BLOG_ID)

      const name = $('#name').val().trim();
      const email = $('#email').val().trim();
      const text = $('#msg').val().trim();

      $('#name, #msg, #email').css('border', '');

      if (!name) {
        $('#name').css('border', '1px solid #e3445a');
      }
      if (!email) {
        $('#email').css('border', '1px solid #e3445a');
      }
      if (!text) {
        $('#msg').css('border', '1px solid #e3445a');
      }
      if (!name || !email || !text) return;

      const btn = $('#jy-post-btn');
      btn.prop('disabled', true).html('<i class="ti ti-loader"></i> Posting…');

      $.ajax({
        url: '{{ route("comment.store",$id) }}',
        method: 'POST',
        data: $(this).serialize(),
        success(res) {
          console.log(res)

          if (res.data) {
            $('#msg').val('');
            Swal.fire('success', 'Comment posted successfully!', 'success');
            setTimeout(function() {
              location.reload()
            },1000)

          }
        },
        error(xhr) {
          if (xhr.status === 403) {

            let response = JSON.parse(xhr.responseText);

            Swal.fire('error', response.message, 'error');

            console.log(response);

          }
          if (xhr.status === 401) {

            let response = JSON.parse(xhr.responseText);

            Swal.fire('error', response.message, 'error');

            console.log(response);

          }
          const errors = xhr.responseJSON?.errors;
          if (errors?.name) {
            $('#name').css('border', '1px solid #e3445a');
          }
          if (errors?.msg) {
            $('#msg').css('border', '1px solid #e3445a');
          }
          if (errors?.email) {
            $('#email').css('border', '1px solid #e3445a');
          }
        },
        complete() {
          btn.prop('disabled', false)
            .html('<i class="ti ti-send"></i> Post comment');
        }
      });

    });
  </script>
</body>

</html>