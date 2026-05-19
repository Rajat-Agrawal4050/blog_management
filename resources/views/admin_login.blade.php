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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/sweet-alert2/sweetalert2.min.css">
</head>

<body>

  @include('header')

    <!-- HERO BANNER -->
    <div class="hero">
        <h1>Blogs</h1>
        <div class="breadcrumb d-flex justify-content-center">
            <a href="#">Home</a>
            <span>/</span>
            <span>Login</span>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-wrapper d-flex">

        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">

                <div class="card shadow login-card p-4">

                    <div class="text-center mb-4">
                        <h2 class="login-title">Admin Login</h2>
                        <p class="text-muted">Sign in to continue</p>
                    </div>

                    <form id="userLoginForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-login">
                                Login
                            </button>
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
    <script src="/sweet-alert2/sweetalert2.min.js"></script>
   <script src="/js/custom-js.js"></script>

    <script>
        $("#userLoginForm").on("submit", function(e) {
            e.preventDefault();

            let email = $('#email').val().trim();

            let pass = $('#password').val().trim();

            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === '' || !regex.test(email)) {
                Swal.fire('error', 'Please Enter valid Email', 'error');
                return;
            }
            if (pass === '') {
                Swal.fire('error', 'Please Enter Password', 'error');
                return;
            }

            let form = $(this)[0];
            let form_data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '{{ route("auth.processLogin") }}',
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {},
                success: function(resp) {
                    console.log(resp)
                    if (resp.status) {
                        window.location.href = '/all_blogs';
                    } else {
                        Swal.fire('error', resp.message, 'error');
                    }
                },
                error: function(xhr, status, code) {
                    console.error(xhr);

                let response = JSON.parse(xhr.responseText);
                if(response?.message)
                Swal.fire('error', response.message, 'error');
              
                },
            });



        });
    </script>
</body>

</html>