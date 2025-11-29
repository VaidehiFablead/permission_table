@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .register-card {
            background: #fff;
            padding: 30px;
            max-width: 900px;
            margin: auto;
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
            padding: 10px 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #2e59d9;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle;
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

    <div class="container mt-4">

        <div class="register-card">

            <h3 class="mb-3"><i class="fa-solid fa-user me-4"></i>Create Staff</h3>

            <div id="message"></div>

            <!-- Staff Registration Form -->
            <form id="staffForm">

               
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" class="form-control" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" class="form-control" autocomplete="new-password">
                    </div>
                

                <h5 class="mt-4 mb-2">Module Permissions</h5>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Module</th>
                            <th>Create</th>
                            <th>View</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td>{{ $module->name }}</td>

                                <td><input type="checkbox" class="perm" data-module="{{ $module->id }}"
                                        data-type="create"></td>
                                <td><input type="checkbox" class="perm" data-module="{{ $module->id }}"
                                        data-type="view"></td>
                                <td><input type="checkbox" class="perm" data-module="{{ $module->id }}"
                                        data-type="update"></td>
                                <td><input type="checkbox" class="perm" data-module="{{ $module->id }}"
                                        data-type="delete"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-custom mt-3">Create Staff</button>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("#staffForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "/api/register",
                type: "POST",
                data: {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                },
                success: function(response) {

                    let user_id = response.user.id;

                    // Collect permissions
                    let permissions = [];

                    $(".perm:checked").each(function() {
                        let moduleId = $(this).data("module");
                        let type = $(this).data("type");

                        if (!permissions[moduleId]) {
                            permissions[moduleId] = {
                                module_id: moduleId,
                                create: 0,
                                view: 0,
                                update: 0,
                                delete: 0
                            };
                        }

                        permissions[moduleId][type] = 1;
                    });

                    let permArray = Object.values(permissions);

                    // Save permissions
                    $.ajax({
                        url: "/api/staff/store",
                        type: "POST",
                        data: {
                            user_id: user_id,
                            permissions: permArray
                        },
                        success: function(res2) {
                            $("#message").html(
                                `<div class="alert alert-success">Staff created successfully!</div>`
                                );
                            window.location.href = "/staff/list";
                        }
                    });

                },
                error: function(xhr) {
                    $("#message").html(`<div class="alert alert-danger">Staff not created!</div>`);
                }
            });

        });
    </script>
@endsection
