<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
        }

        .register-card {
            background: #fff;
            padding: 30px;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.12);
            animation: fadeIn 0.6s ease-in-out;
        }

        .register-card h3 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            background: #4e73df;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #2e59d9;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="register-card">
        <h3 class="text-center">Login</h3>

        <div id="message"></div>

        <form id="loginForm">

            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-custom w-100 mt-2">
                <i class="fa-solid fa-paper-plane me-1"></i> Login
            </button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#loginForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('auth.login') }}",
                type: "POST",
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $("#message").html(`<div class="alert alert-success">${res.message}</div>`);
                    window.location.href = "{{ route('dashboard') }}";
                },
                error: function(xhr) {
                    $("#message").html(
                        `<div class="alert alert-danger">${xhr.responseJSON.message}</div>`);
                }
            });
        });
    </script>
