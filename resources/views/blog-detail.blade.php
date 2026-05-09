<?php

use App\Models\Post;

$post=Post::where('id',$id)->first();

?>
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

  <div class="heading"><h5>{{ $post->title }}</h5></div>
  <div class="description"><p class="description">{{ $post->short_description }}</p></div>

            <div class="content"><?php echo $post->content ?></div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script>
    const ham = document.getElementById('ham');
    const mNav = document.getElementById('mobileNav');
    ham.addEventListener('click', () => mNav.classList.toggle('open'));
  </script>
</body>

</html>