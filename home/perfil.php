<?php
include_once('./php/conexao.php');

session_start();
if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] === 'naoEncontrado') {
        $_SESSION['logado'] = FALSE;
        header("Location:./index.php");
    } elseif ($_SESSION['logado'] == TRUE) {

        $id = $_SESSION['id'];
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = $conn->query($sql);
        $linha = mysqli_fetch_array($resultado);

        $sql_streamers_online = "SELECT * FROM usuarios 
                                WHERE id IN (SELECT id_seguido FROM seguidores
                                WHERE id_seguidor = $id) AND status = TRUE;
                                ";

        $sql_streamers_offline = "SELECT * FROM usuarios 
                                WHERE id IN (SELECT id_seguido FROM seguidores
                                WHERE id_seguidor = $id) AND status = FALSE;
                                ";

        $result_online = $conn->query($sql_streamers_online);
        $result_offline = $conn->query($sql_streamers_offline);

        // while ($linha_streamer_online = mysqli_fetch_assoc($result_online)) {
        //     echo $linha_streamer_online['name'];
        // }

    } elseif ($_SESSION['logado'] === FALSE) {
        header('Location:./index.php');
    }
} else {
    $_SESSION['logado'] = FALSE;
    header('Location:./index.php');
}

if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] === TRUE) {

        if (isset($_POST['nomeUsuario']) && isset($_POST['descricao'])) {
            // if (!empty($_POST['nomeUsuario']) XOR !empty($_POST['descricao'])) {
            $sql = "UPDATE usuarios SET ";
            if (!empty($_POST['nomeUsuario'])) {
                $newUserName = $_POST['nomeUsuario'];
                $newUserNameScaped = $conn->real_escape_string($newUserName);
                $sql .= "name = '$newUserNameScaped',";
            }
            if (!empty($_POST['descricao'])) {
                $descricao = $_POST['descricao'];
                $descricaoScaped = $conn->real_escape_string($descricao);
                $sql .= "descricao = '$descricaoScaped',";
            }
            $final = substr($sql, -1);
            if ($final === ',') {
                $sql = substr($sql, 0, -1);
            }
            $sql .= " WHERE id = $id";
            echo ($sql);
            if (!empty($_POST['nomeUsuario']) and !empty($_POST['descricao'])) {
                $conn->query($sql);
            }
            // }
        }


        if (isset($_FILES['arquivo'])) {
            $arquivo = $_FILES['arquivo'];
            $nomeDoArquivo =  $arquivo['name'];
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
            if ($extensao == 'jpg' || $extensao == 'png') {
                if ($arquivo['error']) {
                    die('Falha ao enviar arquivo');
                } else {
                    $DoisMegaBytes = 2097152;
                    if ($arquivo['size'] > $DoisMegaBytes) {
                        die('Arquivo muito grande! Max: 2MB.');
                    } else {
                        $pasta = 'imagens/';

                        $novoNomeDoArquivo = uniqid();


                        $path = $pasta . $novoNomeDoArquivo . '.' . $extensao;
                        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);

                        if ($deu_certo) {
                            echo ('Deu certo');
                            $conn->query("UPDATE usuarios SET imagem='$path' WHERE id = $id") or die('Erro: ' . $conn->error);
                        } else {
                            echo '<p style="color: red;">Falha ao enviar arquivo</p>';
                        }
                    }
                }
            } else {
            }
        }

        $result = $conn->query('SELECT * FROM usuarios') or die($conn->error);
    }
}

if (isset($_POST['idEntrarAoVivo'])) {
    $id = $_POST['idEntrarAoVivo'];
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $conn->query($sql);
    if ($conn->affected_rows) {
        # code...
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
    <link rel="icon" href="../imagens/Pin-Happy.png">
    <link rel="icon" href="<?=$linha['imagem']?>" type="image/x-icon">

    <title><?= $linha['name'] ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-image: linear-gradient(#F28066, #FEEC32);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img style="height: 50px;" src="../imagens/Pin-Happy.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Amber Live</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Lives</span></a>
            </li>



            <!--------------------------------- STREAMERS ONLINE ------------------------------->
            <?php
            if ($_SESSION['logado'] === TRUE) {
                echo ("
                <div class='sidebar-heading'>
                    Streamers Online
                </div>
                ");
                foreach ($result_online as $streamer_online) {
                    echo "
                <form method='post' action='./user.php'>
                    <li class='nav-item'>
                        <button type='submit' class='nav-link collapsed streamerButton'>
                            <img src='./$streamer_online[imagem]' alt='' style='width: 30px; border-radius: 15px;'>
                            <span>$streamer_online[name]</span>
                            <input name='idStreamer' type='hidden' value='$streamer_online[id]'>
                        </button>
                    </li>
                </form>
                ";
                }
            }
            ?>
            <!--------------------------------- STREAMERS OFFLINE ------------------------------->
            <?php
            if ($_SESSION['logado'] === TRUE) {
                echo ("
                <div class='sidebar-heading'>
                    Streamers Offline
                </div>
                ");
                foreach ($result_offline as $streamer_offline) {
                    echo "
                    <form method='post' action='./user.php'>
                    <li class='nav-item'>
                        <button type='submit' class='nav-link collapsed streamerButton'>
                            <img src='./$streamer_offline[imagem]' alt='' style='width: 30px; border-radius: 15px;'>
                            <span>$streamer_offline[name]</span>
                            <input name='idStreamer' type='hidden' value='$streamer_offline[id]'>
                        </button>
                    </li>
                </form>
                ";
                }
            }

            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 style="background-color: rgb(255, 153, 51);" class="dropdown-header">
                                    Notificações
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 style="background-color: rgb(255, 153, 51);" class="dropdown-header">
                                    Mensagens
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php isset($linha) ? $logado = TRUE : $logado = FALSE; ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                    if ($logado) {
                                        echo ($linha['name']);
                                    } else {
                                        echo ('Acessar');
                                    }
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= $linha['imagem'] ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <?php
                                if ($logado) {
                                    echo ('
                                        <a class="dropdown-item" href="./perfil.php">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Perfil
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Configurações
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lojinha
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Sair
                                        </a>
                                        ');
                                } else {
                                    echo ('
                                        <a class="dropdown-item" href="./register.php">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Criar Conta
                                        </a>
                                        <a class="dropdown-item" href="./login.php">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Entrar
                                        </a>
                                        ');
                                }
                                ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content of Streamer Perfil-->
                <style>
                    .red {
                        box-sizing: border-box;

                        display: flex;
                        flex-direction: column;
                    }

                    .yellow {
                        display: flex;
                        flex-direction: column;
                    }

                    .green {
                        box-sizing: border-box;
                        margin: 0px 10px 10px 10px;
                        padding: 10px 10px;
                        display: flex;
                        flex-direction: row;
                        justify-content: space-between;
                        background-image: linear-gradient(to right, #F28066, #FEEC32);
                        border-radius: 20px;
                    }


                    .green-info {
                        background-color: #f28066;
                        border-radius: 30px;
                    }


                    .orange {
                        display: flex;
                        box-sizing: border-box;
                        flex-direction: row;
                        justify-content: flex-start;
                    }

                    .blue {
                        display: flex;
                        box-sizing: border-box;

                    }

                    .img-profile {
                        align-items: center;
                        width: 150px;
                    }


                    .name-profile {
                        font-family: 'Comic Neue', sans-serif;
                        font-weight: bold;
                        font-size: 40px;
                        text-shadow: gray 5px 5px 5px;
                        color: white;
                    }

                    .container-name-profile {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        justify-content: center;
                    }

                    .botoes {
                        box-sizing: content-box;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        justify-content: flex-end;
                    }

                    .btn-live,
                    .btn-editar {
                        margin: 5px 5px;
                        padding: 10px;
                        border-radius: 4px;
                        border-style: none;
                    }

                    .btn-editar {
                        background-color: cornflowerblue;
                        color: white;
                    }

                    .btn-live {
                        background-color: #ff5555;
                        color: white;
                    }

                    .botoes-info,
                    .botoes-info li {
                        list-style: none;
                        display: flex;
                        flex-direction: row;
                    }

                    .botoes-info li {
                        margin-right: 20px;
                        margin-left: 20px;
                    }

                    .botoes-info li a {
                        text-decoration: none;
                        color: white;
                        font-family: 'Comic Neue', sans-serif;
                        font-weight: bold;
                        text-decoration: none;
                    }

                    .botoes-info li:last-child {
                        margin-right: 0px;
                    }

                    .botoes-info li:first-child {
                        margin-left: 30px;
                    }

                    @media(max-width:940px) {

                        .botoes {
                            flex-wrap: wrap;
                            flex-direction: column;
                            justify-content: flex-start;
                            align-items: flex-end;
                            align-content: center;
                            margin: 0, 0;
                            padding: 0, 0;
                        }
                    }

                    @media(max-width:870px) {

                        .orange {
                            flex-direction: column;
                        }

                        .botoes {
                            flex-wrap: wrap;
                            flex-direction: column;
                            justify-content: flex-start;
                            align-items: flex-end;
                            align-content: center;
                            margin: 0, 0;
                            padding: 0, 0;
                        }
                    }

                    .yellow-conteudo {
                        display: flex;
                        padding: 20px;
                        border: 1px solid black;
                        margin: 15px 15px;
                        border-radius: 20px;
                        background-color: lightyellow;
                    }
                </style>

                <div class="red">

                    <div class="yellow">
                        <div class="green">
                            <div class="orange info-perfil">
                                <div class="blue">
                                    <img class="img-profile" src="<?= $linha['imagem'] ?>" alt="Imagem de <?= $linha['name'] ?>">
                                </div>
                                <div class="blue container-name-profile">
                                    <span class="name-profile"><?= $linha['name'] ?></span>
                                </div>
                            </div>
                            <div class="orange botoes">
                                <div class="blue">
                                    <button class="btn-live">
                                        <i class="fa fa-play"></i>
                                        Live!
                                    </button>
                                </div>
                                <div class="blue">
                                    <button id="" class="btn-editar" onclick="abrirModalEditar(<?= $linha['id'] ?>)">
                                        <i class='fa fa-edit'></i>
                                        Editar Perfil
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="green green-info">
                            <nav class="botoes-info">
                                <li class="btn-inicio"><a href="#">Início</a></li>
                                <li class="btn-sobre"><a href="#">Sobre</a></li>
                                <li class="btn-videos"><a href="#">Vídeos</a></li>
                            </nav>
                        </div>
                    </div>


                    <div class="yellow">
                        <div class="yellow-conteudo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque aut itaque possimus culpa numquam adipisci deleniti, vero impedit veniam quos sequi totam eos incidunt necessitatibus voluptatem in at exercitationem corrupti.</div>
                    </div>
                </div>

                <!-- End Page Content of Streamer Perfil-->

            </div>

            <!----------------- Start Modal Editar --------------->
            <style>
                /*Propriedades do botao editar imagem*/
                input[type="file"] {
                    display: none;
                }

                .custom-file-upload {
                    border: 1px solid #ccc;
                    display: inline-block;
                    padding: 6px 12px;
                    cursor: pointer;
                    border-radius: 100px;
                    transition: transform 0.3s ease;
                    background-color: white;
                }

                .custom-file-upload:hover {
                    transform: scale(1.1);
                }

                #container-botao {
                    position: absolute;
                    width: fit-content;
                    box-sizing: content-box;
                    /* overflow: hidden; */
                    top: 68%;
                    left: 72%;
                    z-index: 2;
                }

                .cont-img-modal {
                    z-index: 1;
                    width: fit-content;
                    position: relative;
                }

                #file-upload {
                    color: white;
                }
            </style>
            <div class="modal fade" id='modalEditar' tabindex="-1" role="dialog" aria-label="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" action="./perfil.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar Perfil</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">

                                    <div class="blue cont-img-modal">
                                        <div id="container-botao">
                                            <label for="file-upload" class="custom-file-upload">
                                                <i class="fa fa-pencil"></i>
                                            </label>
                                            <input name="arquivo" id="file-upload" type="file" />
                                        </div>
                                        <img class="img-profile" src="<?= $linha['imagem'] ?>" alt="Imagem de <?= $linha['name'] ?>">
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <label>Nome de Usuário</label>
                                    <input type="text" id="editarName" name="nomeUsuario" class="form-control" value="<?= $linha['name'] ?>">
                                </div>
                                <div class="form-floating mb-3">
                                    <label>Descrição</label>
                                    <textarea name="descricao" id="editarDescricao" cols="30" rows="5" class="form-control"><?= $linha['descricao'] ?></textarea>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type='hidden' name='editar' value='editar'></input>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="fecharModalEditar()">Fechar</button>
                                    <input type="submit" class="btn btn-primary" value="Editar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!----------------- End Modal Editar --------------->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


    <script>
        function abrirModalEditar(id) {
            //------------  MODAL EDITAR  ------------
            $("#modalEditar").modal("show");

            produto = document.getElementById("produtos" + id);
            valor = document.getElementById("valor" + id);
            quantidade = document.getElementById("quantidade" + id);
            validade = document.getElementById("validade" + id);

            editarId = document.getElementById("editarId");
            editarProduto = document.getElementById("editarProduto");
            editarValor = document.getElementById("editarValor");
            editarQuantidade = document.getElementById("editarQuantidade");
            editarValidade = document.getElementById("editarValidade");

            editarId.value = id;
            editarProduto.value = produto.value;
            editarValor.value = valor.value;
            editarQuantidade.value = quantidade.value;
            editarValidade.value = validade.value;
        }

        function fecharModalEditar() {
            $("#modalEditar").modal("hide");
        }



        //------------  ENTRAR AO VIVO  ------------
    </script>
</body>

</html>