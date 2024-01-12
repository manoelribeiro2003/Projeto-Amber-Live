<?php

session_start();

if (!isset($_SESSION['logado'])) {
    $_SESSION['logado'] = FALSE;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--<style>
       body{
            background-color: linear-gradient(tobottom right, rgb(210, 7, 7),rgba(240, 240, 240, 0.546),rgb(221, 116, 4));
          }
    </style>-->
    <style>
        .grad {
            background-image: radial-gradient(circle, yellow, red);
        }
    </style>


</head>

<body class="grad">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-4 d-none d-lg-block "><img src="../imagens/amber.gif" width="400" height="400"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                                    </div>
                                    <?php
                                    if ($_SESSION['logado'] === 'naoEncontrado') {
                                        echo ('
                                        <div class="text-center">
                                            <label style="color: red;" class="form-text">Email ou senha incorretos</label>
                                        </div>
                                        ');
                                        unset($_SESSION['logado']);
                                    } elseif ($_SESSION['logado'] === FALSE) {
                                        echo ('');
                                    }elseif ($_SESSION['logado'] === TRUE) {
                                        header("Location:./index.php");
                                    }
                                    ?>


                                    <form action='./verificacao.php' method="POST">
                                        <div class="form-group">
                                            <input onblur="V_email(this)" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Digite seu email..." required>
                                            <div name="alertaEmail" id="alertaEmail" class="form-text"></div>
                                        </div>
                                        <div class="form-group">
                                            <input onblur="V_senha(this)" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Senha" name="senha" required>
                                            <div id="alertaSenha" class="form-text"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar Credenciais</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar">


                                        <!-- <hr> -->
                                        <!-- <a href="./index.php" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="./index.php" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Esqueceu a senha?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Crie uma conta!</a>
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
    <script src="./campos_obrigatorios.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>