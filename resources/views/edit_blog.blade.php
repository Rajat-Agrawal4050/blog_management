<?php

use App\Models\Post;

$post=Post::where('id',$id)->first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JobYaari – Admin Panel</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">

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

                <div style="max-width:900px;margin:0 auto;">
                    <form id="editForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Row 1: Title + Category -->
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:18px;">
                            <div>
                                <label class="form-label">Title <span class="req">*</span></label>
                                <input type="text" value="{{ $post->title }}" name="title" class="form-control" placeholder="Write Blog title">
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div>
                                <label class="form-label">Categories</label>
                                <select name="category" class="form-select">
                                    <option value="" disabled="" selected="">Select Category</option>
                                     @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category==$category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
                                  
                                </select>
                                <span class="text-danger error-text category_error"></span>
                            </div>
                        </div>

                        <!-- Row 2: Tag -->
                        <div style="margin-bottom:18px;">
                            <label class="form-label">Short Description</label>
                            <div class="tag-input-wrap">
                                <input type="text" id=""  value="{{ $post->short_description }}" name="short_description" class="tag-real-input" placeholder="Short Description">
                            </div>
                            <span class="text-danger error-text short_description_error"></span>
                        </div>

                        <!-- Row 3: Image Upload -->
                        <div style="margin-bottom:18px;">
                            <label class="form-label">
                                Upload The image <i class="ti ti-help-circle help-icon" aria-label="Image upload help"></i>
                            </label>
                            <div class="">

                                <img src="{{ $post->image ? '/uploads/'.$post->image : '/images/choose_image.jpeg' }}" id="img_output" onclick="document.getElementById('image').click();"
                                    alt="image" style="width: 250px; height: 150px">
                                     <br>
                                <span class="text-danger error-text image_error"></span>
                                <input id="image" hidden
                                    onchange="document.querySelector('#img_output').src=window.URL.createObjectURL(this.files[0])"
                                    name="image" type="file" style="" />

                            </div>

                        </div>

                        <!-- Rich Text Editor -->
                        <div style="margin-bottom:18px;">
                            <label class="form-label">Content</label>
                            <textarea name="content" id="myEditor">{{  $post->content  }}</textarea>
                            <span class="text-danger error-text content_error"></span>
                        </div>

                        <!-- Actions -->
                        <div class="action-row">
                             <input type="hidden" name="blog_id" value="{{ $post->id }}">
                            <button type="submit" class="btn-publish"><i class="ti ti-send" style="font-size:15px" aria-hidden="true"></i>
                                Edit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="/sweet-alert2/sweetalert2.min.js"></script>

    <script>
        $('#myEditor').summernote({
            height: 400,
        });
    </script>
 <script src="/js/custom-js.js"></script>

    <script>
        $(document).ready(function() {

            $('#editForm').submit(function(e) {

                e.preventDefault();

                let formData = new FormData(this);

                $('.error-text').text('');

                $.ajax({

                    url: "{{ route('blog.edit') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)

                        if (response.status == true) {
                            Swal.fire('success', response.message, 'success');
                        }
                    },

                    error: function(xhr) {
  if (xhr.status === 401 || xhr.status === 403) {

                let response = JSON.parse(xhr.responseText);
                Swal.fire('error', response.message, 'error');
              }
                        if (xhr.status == 422) {

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {

                                $('.' + key + '_error').text(value[0]);

                            });
                        }
                    }

                });

            });

        });
    </script>

    <!-- <script>
        const tagInput = document.getElementById('tagInput');
        const tagWrap = document.getElementById('tagWrap');
        const tags = [];

        tagInput.addEventListener('keydown', e => {
            if (e.key === 'Enter' && tagInput.value.trim()) {
                e.preventDefault();
                addTag(tagInput.value.trim());
                tagInput.value = '';
            }
            if (e.key === 'Backspace' && !tagInput.value && tags.length) {
                removeTag(tags.length - 1);
            }
        });

        function addTag(val) {
            if (tags.includes(val)) return;
            tags.push(val);
            const pill = document.createElement('span');
            pill.className = 'tag-pill';
            pill.dataset.idx = tags.length - 1;
            pill.innerHTML = `${val}<button onclick="removeTag(${tags.length - 1})" aria-label="Remove tag ${val}"><i class="ti ti-x"></i></button>`;
            tagWrap.insertBefore(pill, tagInput);
        }

        function removeTag(idx) {
            tags.splice(idx, 1);
            renderTags();
        }

        function renderTags() {
            tagWrap.querySelectorAll('.tag-pill').forEach(p => p.remove());
            tags.forEach((t, i) => {
                const pill = document.createElement('span');
                pill.className = 'tag-pill';
                pill.innerHTML = `${t}<button onclick="removeTag(${i})" aria-label="Remove tag ${t}"><i class="ti ti-x"></i></button>`;
                tagWrap.insertBefore(pill, tagInput);
            });
        }
    </script> -->

</body>

</html>