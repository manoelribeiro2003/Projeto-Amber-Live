<?php

include_once('./php/conexao.php');
include_once('./php/cores.php');
$mensagem = '';
if (isset($_POST['nome_usuario']) || isset($_POST['senha']) || isset($_POST['email'])) {

    if (strlen($_POST['nome_usuario']) == 0) {
        echo (blue('Preencha seu nome de usuário'));
    } elseif (strlen($_POST['senha']) == 0) {
        echo ('Preencha sua senha');
    } elseif (strlen($_POST['email']) == 0) {
        echo ('Preencha seu email');
    } else {

        $usuario = $_POST['nome_usuario'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result) {
            $linha = $result->num_rows;
            if ($linha == 0) {
                $sql_inserir = "INSERT INTO `usuarios`(`name`,`email`, `senha`) VALUES ('$usuario','$email','$senha')";
                if ($conn->query($sql_inserir)) {
                    $mensagem = green('Usuario cadastrado com sucesso');
                } else {
                    echo ('Erro ao cadastrar usuário! Erro: ' . $conn->error);
                }
            } else {
                $mensagem = red('Email já cadastrado');
            }
        } else {
            echo ("Erro na query: " . $conn->error);
        }
    }
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

    <title>Crie sua conta</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .grad {
            background-image: radial-gradient(circle, yellow, red);
        }
    </style>

</head>

<body class="grad">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-4 d-none d-lg-block "><img src="../imagens/Pin-HappyAnim.gif" width="400" height="400"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crie sua conta</h1>
                            </div>
                            <div class="text-center mb-4">
                                <div class="form-text"><?=$mensagem?></div>
                            </div>
                            <form action="./register.php" method="POST" class="user">
                                <div class="form-group">
                                    <input name="nome_usuario" type="text" class="form-control form-control-user" id="exampleInputUser" placeholder="Nome de usuário">
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Seu email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="senha" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Sua senha">
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <input name="repetirSenha" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repita a senha">
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Criar conta
                                </button>
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Criar com Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Criar com Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Esqueceu a Senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="./login.php">Ja tenho uma conta!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->

</body>

</html>