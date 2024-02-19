<?php
include 'koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <style>
        body {
            background: url('background-image.jpg') center center fixed;
            background-size: cover;
        }

        .card {
            border-radius: 10px;
        }

        .card-body {
            border-radius: 10px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-user {
            border-radius: 8px;
        }
    </style>

</head>

<body class="bg-gradient-primary d-flex align-items-center">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login di Sini </h1>
                                    </div>
                                    <?php 
                                        if(isset($_POST['login'])){
                                            $username = htmlspecialchars($_POST['username']);
                                            $password = htmlspecialchars($_POST['password']);
                                            
                                            $admin = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
                                            
                                            if($data = mysqli_fetch_assoc($admin)){
                                                if(password_verify($password, $data['password'])){
                                                    $_SESSION['username'] = $data['username'];
                                                    
                                                    // Login Admin
                                                    if($data['role'] == 'admin'){
                                                        $_SESSION['user_id'] = $data['user_id'];
                                                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                                                        $_SESSION['role'] = $data['role'];
                                                        header('location: admin/index.php');
                                                        exit; // Penting untuk menghentikan eksekusi script setelah melakukan redirect
                                                    }
                                        
                                                    // Login Petugas
                                                    elseif($data['role'] == 'kasir'){ // Perhatikan perbedaan kapitalisasi di sini
                                                        $_SESSION['user_id'] = $data['user_id'];
                                                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                                                        $_SESSION['role'] = $data['role'];
                                                        header('location: kasir/index.php');
                                                        exit; // Penting untuk menghentikan eksekusi script setelah melakukan redirect
                                                    }
                                        
                                                } else {
                                                    echo "Username dan password salah";
                                                }
                                            } else {
                                                echo "Akun tidak ada";
                                            }
                                        }
                                        ?>
                                    <form method="POST" class="user">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>

                                    <div class="text-center">
                                        <a class="small" href="dashboard/forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="dashboard/register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sbadmin/js/sb-admin-2.min.js"></script>

</body>

</html>