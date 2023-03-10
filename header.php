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
        $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=".$user['ImgPerfil']." style='height:1.9vw'><img src="."assets/coin-svgrepo-com.svg"." style='height:1vw;padding-inline:3px'>0</div>";
        $list = 
        "<ul class='list-group'>
            <a href='index.php?list'><li class='list-group-item'>Ver eventos</li></a>
            <a href='upload.php'><li class='list-group-item'>Divulgar meu Evento</li></a>
            <a href='#'><li class='list-group-item'>Configurações</li></a>
            <a href='php/logout.inc.php' class='text-decoration-none text-black'><li class='list-group-item'>Sair</li></a>
            <li class='list-group-item'><img src="."assets/coin-svgrepo-com.svg"." style='height:1.3vw;padding-inline:3px'>0</li>
        </ul>";
    } else {
        //Setar icone de usuario nao logado
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg" style="height:3vw"></a>';
        $list = 
        "<ul class='list-group'>
            <a href='index.php?list'><li class='list-group-item'>Ver eventos</li></a>
            <a href='upload.php'><li class='list-group-item'>Divulgar meu Evento</li></a>
        </ul>";
    }
?>

<header>

    <div class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto">
        <!--Logo-->
        <a href="index.php" class="navbar-brand p-0 m-0"><img src="assets/logo-transparente.png" alt="logo" style="width:12vw; min-width:150px" ></a>
        <!--Barra de Pesquisa-->
        <form id="desktop" class="align-items-center ms-3 w-50 p-0 m-0" style="height:6vw">
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
                <ul id="userUl" class="list-group">
                    <a href="user.php" class="text-decoration-none text-black"><li class="list-group-item">Configurações</li></a>
                    <a href="php/logout.inc.php" class="text-decoration-none text-black"><li class="list-group-item">Sair</li></a>
                </ul>
            </ul>
        </div>
    </div>

    <form id="mobile" class="form-inline">
        <input type="text" name="" id="mobile_search_bar" placeholder="Oque esta Procurando?">
        <img src="assets/close_FILL0_wght400_GRAD0_opsz20.svg" id="close" alt="" style="cursor:pointer">
    </form>
</header>