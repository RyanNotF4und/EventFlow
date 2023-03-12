<?php
    if (!isset($_SESSION)) {
        //Se a sessão não existir, criar uma
        session_start();
    }

    include("php/db.inc.php");
    include("php/user.inc.php");
    include("php/uploadEvent.php");

    $select = new Select();

    if (isset($_POST['upload-image'])) {
        if ($_FILES['image']['error'] == 0) {
            $upload_event = new UploadEvent($_FILES);
        }
    }
    if (isset($_SESSION["id"])) {
        $user = $select->selectUserById($_SESSION['id']);
        $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=" . $user['ImgPerfil'] . "></div>";
        
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./scripts/jquery-3.6.3.min.js"></script>
    <script src="./scripts/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Divulgar meu evento</title>
</head>

<style>
    section {
        margin-inline: 5vh;
        margin-top: 5vh;
        margin-bottom: 5vh;
    }
    @media screen and (max-width:900px) {
        h4 {
            font-size: 12px;
        }

        .form-control-lg {
            min-height: calc(0.5em + 1rem + calc(var(--bs-border-width) * 2));
            padding: 0.5rem 1rem;
            font-size: 10px;
            border-radius: 0.5rem;
        }

        #file {
            width: 120px;
        }

        #botao {
            width: 5vw;
        }

        section {
            margin: 0;
            padding: 0;
        }
    }
</style>

<body style="height:auto">
<!--Cabeçalho-->
    <header>
        <div class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto">
            <!--Logo-->
            <a href="index.php" class="navbar-brand p-0 m-0"><img src="assets/logo-transparente.png" alt="logo" style="width:12vw; min-width:150px"></a>
            <!--Barra de Pesquisa Desktop-->
            <form id="desktop" class="d-flex align-items-center ms-3 w-50 p-0 m-0">
                <input type="text" name="" id="search_bar" placeholder="Procurar evento">
            </form>
            <!--Botoes Mobile-->
            <div id="mobile" style="margin-right:20px;cursor:pointer">
                <img id="search" src="./assets/search_FILL0_wght400_GRAD0_opsz48.svg">
                <img id="menu" src="./assets/menu.svg" width="24px">
                <?php echo $list ?>
            </div>
            <!--Opcoes Desktop-->
            <div id="options_desktop" class="w-50" style="height:6vw">
                <ul class="h-100 p-0 m-0 align-items-center justify-content-end d-flex w-100">
                    <li>
                        <select id="localizacao" class="form-select border-0" aria-label="Default select example">
                            <option selected>Pará de Minas</option>
                        </select>
                    </li>
                    <li><a href="index.php?list">Ver eventos</a></li>
                    <li><a href="upload.php">Divulgar meu Evento</a></li>
                    <li><?php echo $ImgPerfil ?></li>
                    <ul id="userUl" class="list-group">
                        <a href="user.php?perfil" class="text-decoration-none text-black">
                            <li class="list-group-item">Configurações</li>
                        </a>
                        <a href="php/logout.inc.php" class="text-decoration-none text-black">
                            <li class="list-group-item">Sair</li>
                        </a>
                    </ul>
                </ul>
            </div>
        </div>
        <!--Barra Pesquisa Mobile-->
        <form id="mobile" class="form-inline">
            <input type="text" name="" id="mobile_search_bar" placeholder="Oque esta Procurando?">
            <img src="assets/close_FILL0_wght400_GRAD0_opsz20.svg" id="close" alt="" style="cursor:pointer">
        </form>
    </header>
    
    <section class="p-1">
        <h1 style="width:100%;font-size:24px;font-weight:bolder">Divulgar um evento</h1>
        <p style="font-size:12px">Com a Event Flow é extremamente simples criar e divulgar seus eventos !<br>Preencha o que se pede e seu evento estará visivel para milhares de pessoas !</p>
        <span class="text-warning" style="font-size:12px";>*Será feito uma verificação antes de ser lançado*</span>
        <span class='text-warning'><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];unset($_SESSION['msg']);} else {echo @$upload_event->error;} ?></span>
        <hr>
        <form method="POST" enctype="multipart/form-data" class="border border-black w-100 border-0 margin-top-bottom">
            <table class="align-middle table w-100">
                <tr>
                    <td colspan="3" class="border-0">
                        <h4>Escolha uma imagem para ser capa do seu evento</h4>
                    <td colspan="100" class="border-0"><input id="file" class="form-control form-control-lg" type="file" name="image" accept="image/*" required /></td>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td class="border-0">
                        <h4>Titulo:</h4>
                    </td>
                    <td colspan="100" class="border-0">
                        <input class="form-control form-control-lg w-100" type="text" name="title" required />
                    </td>
                </tr>
                <tr>
                    <td class="border-0">
                        <h4>Estado: </h4>
                    </td>
                    <td class="border-0">
                        <select class="form-select form-control-lg w-100" name="state" id="">
                            <option value="MG">
                                <h4>MG</h4>
                            </option>
                        </select>
                    </td>
                    <td class="border-0">
                        <h4 class="text-end">Cidade: </h4>
                    </td>
                    <td class="border-0">
                        <select class="form-select form-control-lg w-100" name="city" id="">
                            <option value="Para de Minas">
                                <h4>Pará de Minas</h4>
                            </option>
                        </select>
                    </td>
                    <td class="border-0">
                        <h4 class="text-end">Data do evento: </h4>
                    </td>
                    <td class="border-0">
                        <input class="form-control form-control-lg w-100" type="date" name="date_event" required />
                    </td>
                <tr>
                    <td class="border-0">
                        <h4>Endereço: </h4>
                    </td>
                    <td colspan="100" class="border-0">
                        <input class="form-control form-control-lg w-100" type="text" name="adress" required />
                    </td>
                </tr>
                <tr>
                    <td class="border-0">
                        <h4>Descrição: </h4>
                    </td>
                    <td colspan="100" class="border-0"><textarea class="form-control form-control-lg w-100" name="description" id="" cols="30" rows="10" required></textarea></td>
                </tr>
            </table>
            <div class="d-flex justify-content-end">
                <button type="submit" name="upload-image" class="border-0"><img src="assets/confirm-icon.svg" alt="" srcset="" id="botao"></button>
                <a href="index.php"><img src="assets/red-x-icon.svg" alt="" srcset="" id="botao"></a>
            </div>
        </form>
        <hr>
    </section>
    <?php
    } else {
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg"></a>';
        echo '<br><img class="rounded mx-auto d-block" src ="assets/avatar_click.svg" width="300vh" height="300vh">',
        "<br><h2 class='text-center'>Faça <a href='login.php' style='color: #FF5402'>Login</a> para divulgar um evento</h2><br>";
    ?>
        <div class="d-flex justify-content-center pb-5">
            <a class="btn btn-lg text-white" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#FF5402" href="login.php" role="button">Fazer login</a>
        </div>
    <?php
    }
    ?>
</body>

</html>