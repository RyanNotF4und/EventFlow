<?php
    include("php/db.inc.php");
    include("php/events.inc.php");
    include("php/display.inc.php");
    include("php/user.inc.php");

    $select = new Select();

    if (!isset($_SESSION)) {
        //Se a sessão não existir, criar uma
        session_start();
    }

    //Se o ID de usuario existir
    if (isset($_SESSION["id"])) {
        //Selecionar usuario pelo ID
        $user = $select->selectUserById($_SESSION['id']);
        //Setar icone do perfil
        $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=" . $user['ImgPerfil'] . " style='height:1.9vw'><img src=" . "assets/coin-svgrepo-com.svg" . " style='height:1vw;padding-inline:3px'>0</div>";
        //Opções para usuário logado
        $list =
            "<ul class='list-group'>
                <a href='index.php?list'><li class='list-group-item'>Ver eventos</li></a>
                <a href='upload.php'><li class='list-group-item'>Divulgar meu Evento</li></a>
                <a href='user.php?perfil'><li class='list-group-item'>Configurações</li></a>
                <a href='php/logout.inc.php' class='text-decoration-none text-black'><li class='list-group-item'>Sair</li></a>
                <li class='list-group-item'><img src=" . "assets/coin-svgrepo-com.svg" . " style='height:1.3vw;padding-inline:3px'>0</li>
            </ul>";
    } else {
        //Setar icone de usuário não logado
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg" style="height:3vw"></a>';
        //Opções para usuário não logado
        $list =
            "<ul class='list-group'>
                <a href='index.php?list'><li class='list-group-item'>Ver eventos</li></a>
                <a href='upload.php'><li class='list-group-item'>Divulgar meu Evento</li></a>
            </ul>";
    }

    $events = new Events();
    $display = new Display();
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
    <link rel="stylesheet" href="css/button-cancel.css">
    <link rel="stylesheet" href="css/button-edit.css">
    <link rel="stylesheet" href="css/logo-shine.css">
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Usuário</title>
</head>

<style>
    .list-group a {
        text-decoration: none;
    }

    .list-group a:hover {
        text-decoration: underline;
    }
</style>

<body>

    <!--Cabeçalho-->
    <header>
        
        <!--Container-->
        <div class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto"> 
            
        <a href="index.php" class="navbar-brand p-0 m-0"><div class="hover h-100"><figure><img src="assets/logo-transparente.png" alt="logo" style="width:12vw; min-width:150px"></figure></div></a>
            
            <!--Barra de Pesquisa Desktop-->
            <form id="form_desktop" class="align-items-center w-50 p-0 m-0">
                <input type="text" name="" class="mx-auto" id="search_bar_desktop" placeholder="Procurar eventos">
            </form>

            <!--Botoes Mobile-->
            <div id="mobile" class="w-25 justify-content-end pe-3">
                <img id="search" src="./assets/search_FILL0_wght400_GRAD0_opsz48.svg">
                <img id="options" src="./assets/menu.svg" width="24px">
                <?php echo $list ?>
            </div>
            <!--Botoes Mobile-->

            <!--Opcoes Desktop-->
            <div id="options_desktop" class="w-50" style="height:6vw">
                <!--UL da opções-->
                <ul class="h-100 p-0 m-0 align-items-center justify-content-end d-flex w-100">
                    <!--Select com Localizações-->
                    <li>
                        <select id="localizacao" class="form-select border-0" aria-label="Default select example">
                            <option selected>Pará de Minas</option>
                        </select>
                    </li>
                    <li><a href="index.php?list">Ver eventos</a></li>
                    <li><a href="upload.php">Divulgar meu Evento</a></li>
                    <li><?php echo $ImgPerfil ?></li> <!--Foto de Perfil-->

                    <!--UL de Opções de Usuário Logado Mobile-->
                    <ul id="userUl" class="list-group">
                        <a href="user.php?perfil" class="text-decoration-none text-black">
                            <li class="list-group-item">Configurações</li>
                        </a>
                        <a href="php/logout.inc.php" class="text-decoration-none text-black">
                            <li class="list-group-item">Sair</li>
                        </a>
                    </ul> <!--UL de Opções de Usuário Logado Mobile-->
                </ul> <!--UL da opções-->
            </div> <!--Opcoes Desktop-->
        </div> <!--Container-->
        
        <!--Barra Pesquisa Mobile-->
        <form id="form_mobile" class="form-inline">
            <input type="text" name="" id="mobile_search_bar" placeholder="Pesquisar eventos">
            <img src="assets/close_FILL0_wght400_GRAD0_opsz20.svg" id="close" alt="close" style="cursor:pointer">
        </form>

    </header>

    <section>
        <div class="navbar navbar-expand-lg navbar-light" style="background-color:#FF5402">

            <div class="w-100">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item border-none bg-transparent border-0"><a class="text-white" href="?perfil">Meu Perfil</a></li>
                    <li class="list-group-item border-none bg-transparent border-0"><a class="text-white" href="?myevents">Meus Eventos</a></li>
                </ul>
            </div>
        </div>
    </section>

    <?php
    if (isset($_GET['myevents'])) {
    ?>
        <main>
            <div class="d-block">
                <h1 class="fw-bold ms-4 mt-4">Meus Eventos</h1>
                <?php
                $event = $select->displayUserEvents($_SESSION['id']);
                if ($event) {
                    foreach ($event as $data) {
                ?>
                        <article class="thumbnail-preview ms-2 me-5 d-flex w-auto h-100 justify-content-start">
                            <div>
                                <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                                <div id="userCard" class="rounded me-5" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;width:500px;height:300px"></div>
                            </div>
                            <div>
                                <a class="text-decoration-none" href="?edit=<?php echo $data['id'] ?>"><div class="edit noselect m-1"><span class="text">Editar</span><span class="icon"><svg fill="#000000" width="32px" height="32px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" ><title>edit</title><path d="M320 112L368 64 448 144 400 192 320 112ZM128 304L288 144 368 224 208 384 128 304ZM96 336L176 416 64 448 96 336Z" /></svg></span></div>
                                <a class="text-decoration-none" href="?delet=<?php echo $data['id'] ?>"><div class="cancel noselect m-1"><span class="text">Deletar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span></div></a>
                            </div>
                        </article>
                <?php
                    }
                }
                ?>
            </div>
        </main>
        </div>
    <?php
    } else if (isset($_GET['perfil'])) {
    ?>
        <h1 class="text-center fw-bold mt-5">Meu Perfil</h1>
        <div class="d-block pt-5">
            <div class="border w-25 mx-auto rounded-circle" style="background-image: url('<?php echo $user['ImgPerfil'] ?>');background-size:200px 200px;background-position:center;background-repeat:no-repeat;height:25vw;"></div>
            <p class="text-center pt-4"><?php echo $user['uname'] ?></p>
        </div>

        <div class="d-block pt-2">
            <p class="text-center">Suas moedas: 0 <img src="assets/coin-svgrepo-com.svg" width="10px"></p>
        </div>

    <?php
    }
    ?>

</body>

</html>