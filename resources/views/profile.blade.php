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

    <style>
        .auth-card {
            max-width: 450px;
            margin: auto;
            margin-top: 20px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
        }
    </style>
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

                <div class="card auth-card">

                    <div class="card-body p-4">

                        <h2 class="text-center mb-4 fw-bold">Profile</h2>
                        <br>

                        <h5>Name: {{ isset($data->name) ? $data->name : '' }}</h5>
                        <br>
                        <h5>Email: {{ isset($data->email) ? $data->email : '' }} </h5>


                    </div>

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

</body>

</html>