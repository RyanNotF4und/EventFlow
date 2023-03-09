<?php
if (!isset($_SESSION)) {
    session_start();
}
include("php/user.inc.php");
$select = new Select();

if(isset($_SESSION["id"])) {
    $user = $select->selectUserById($_SESSION['id']);

    $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=".$user['ImgPerfil']."></div>";
} else {
    $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg"></a>';
}
?>

<link rel="stylesheet" href="css/header.css">

<header>
    <div class="navbar navbar-expand-lg navbar-light bg-white">
        <a href="index.php" class="navbar-brand" style="margin-left:25px"><img src="assets/logo-transparente.png" alt="Logo"></a>
        <form id="desktop" class="form-inline" style="width: 35vw">
            <input type="text" name="" id="barraPesquisa" placeholder="Oque esta Procurando?">
        </form>
        <div id="mobile" style="margin-right:20px;cursor:pointer">
            <img id="search" src="./assets/search_FILL0_wght400_GRAD0_opsz48.svg">
            <img id="menu" src="./assets/menu.svg" width="24px">
            <ul>
                <a href="index.php?list"><li>Ver eventos</li></a>
                <a href="upload.php"><li>Divulgar meu Evento</li></a>
                <a href="#"><li>Configurações</li></a>
                <a href="php/logout.inc.php" class="text-decoration-none text-black"><li>Sair</li></a>
            </ul>
        </div>
        <div id="ops" class="w-50 h-100 margin-bottom-0">
            <ul class="h-100 align-items-center">
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
        <input type="text" name="" id="barraPesquisa" placeholder="Oque esta Procurando?">
    </form>
</header>