<?php
    include("php/user.inc.php");
    $select = new Select();

    if (!isset($_SESSION)) {
        //Se a sessão não existir, criar uma
        session_start();
    }

    //Se o id de usuario existir
    if(isset($_SESSION["id"])) {
        //Selecionar usuario pelo id
        $user = $select->selectUserById($_SESSION['id']);
        //Setar icone do perfil
        $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=".$user['ImgPerfil']." style='height:3vw'><img src="."assets/coin-svgrepo-com.svg"." style='height:1.3vw;padding-inline:3px'>0</div>";
        $list = 
        "<ul>
            <a href='index.php?list'><li>Ver eventos</li></a>
            <a href='upload.php'><li>Divulgar meu Evento</li></a>
            <a href='#'><li>Configurações</li></a>
            <a href='php/logout.inc.php' class='text-decoration-none text-black'><li>Sair</li></a>
            <li><img src="."assets/coin-svgrepo-com.svg"." style='height:1.3vw;padding-inline:3px'>0</li>
        </ul>";
    } else {
        //Setar icone de usuario nao logado
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg" style="height:2vw"></a>';
        $list = 
        "<ul>
            <a href='index.php?list'><li>Ver eventos</li></a>
            <a href='upload.php'><li>Divulgar meu Evento</li></a>
        </ul>";
    }
?>

<header>

    <div class="navbar navbar-expand-lg navbar-light bg-white">
        <!--Logo-->
        <a href="index.php" class="navbar-brand p-0 m-0"><img src="assets/logo-transparente.png" alt="logo" style="width:20vw"></a>
        <!--Barra de Pesquisa-->
        <form id="desktop" class="align-items-center w-50 ms-5 me-5 p-0 m-0" style="height:6vw">
            <input type="text" name="" id="search_bar" placeholder="Procurar evento">
        </form>

        <div id="mobile" style="margin-right:20px;cursor:pointer">
            <img id="search" src="./assets/search_FILL0_wght400_GRAD0_opsz48.svg">
            <img id="menu" src="./assets/menu.svg" width="24px">
            <?php echo $list ?>
        </div>

        <div id="options_desktop" class="w-50" style="height:6vw">
            <ul class="h-100 p-0 m-0 align-items-center justify-content-end d-flex w-100">
                <li><a href="index.php?list">Ver eventos</a></li>
                <li><a href="upload.php">Divulgar meu Evento</a></li>
                <li><?php echo $ImgPerfil ?></li>
                <ul id="userUl">
                    <a href="user.php" class="text-decoration-none text-black"><li>Configurações</li></a>
                    <a href="php/logout.inc.php" class="text-decoration-none text-black"><li>Sair</li></a>
                </ul>
            </ul>
        </div>
    </div>

    <form id="mobile" class="form-inline">
        <input type="text" name="" id="mobile_search_bar" placeholder="Oque esta Procurando?">
    </form>
</header>

<div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>