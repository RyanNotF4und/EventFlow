<?php
    if (!isset($_SESSION)) {
        //Se a sessão não existir, criar uma
        session_start();
    }

    include("php/db.inc.php");
    include("php/user.inc.php");
    include("php/uploadEvent.php");

    $select = new Select();

    if (isset($_POST['upload'])) {
        if ($_FILES['image']['error'] == 0) {
            $upload_event = new UploadEvent($_FILES);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/button-submit.css">
    <link rel="stylesheet" href="css/button-cancel.css">
    <link rel="stylesheet" href="css/file-input.css">
    <link rel="stylesheet" href="css/input-group.css">
    <link rel="stylesheet" href="css/logo-shine.css">
    <link rel="icon" href="assets/favicon.png">

    <title>Event Flow | Divulgar meu evento</title>
</head>

<style>
    .inputGroup {
        width: 450px;
    }

    #file-input {
        font-size: 10px;
    }

    #form {
        display: flex;
    }

    @media screen and (max-width: 990px) {
        #form {
            display: block;
        }
        .inputGroup {
            width: 75%;
        }
    }
    
</style>

<body style="height:auto">
    <?php
        if (isset($_SESSION["id"])) {
            //Selecionar usuario pelo ID
            $user = $select->selectUserById($_SESSION['id']);
            //Setar icone do perfil
            $ImgPerfil = "<div id='user' style='cursor:pointer;'><img src=" . $user['ImgPerfil'] . " style='height:1.9vw'><img src=" . "assets/coin-svgrepo-com.svg" . " style='height:1vw;padding-inline:3px'>0</div>";
            //Opções para usuário logado
            $list ="<ul id=" . "options-mobile" . " class='list-group'>
                        <li class='list-group-item'><img src=" . "assets/coin-svgrepo-com.svg" . " class='ps-1 pe-2' style='height:3vh;'>0</li>
                        <a href='index.php?list'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>event</span>Ver eventos</li></a>
                        <a href='upload.php'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>add_box</span>Divulgar meu Evento</li></a>
                        <a href='user.php?perfil'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>shop</span>Trocar coins</li></a>
                        <a href='user.php?perfil'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>settings</span>Configurações</li></a>
                        <a href='php/logout.inc.php' class='text-decoration-none text-black'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>logout</span>Sair</li></a>
                    </ul>";
    ?>
    <!--Cabeçalho-->
    <header>

        <!--Container-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto">

            <!--Logo-->
            <a href="index.php" class="navbar-brand p-0 m-0">
                <div class="hover">
                    <figure>
                        <img src="assets/logo-transparente.png" alt="logo" id="logo">
                    </figure>
                </div>
            </a>

            <!--Barra de Pesquisa-->
            <form id="form">
                <input type="text" name="q" id="search-input" placeholder="Procurar eventos">
            </form>

            <!--Opcoes Mobile-->
            <img id="ul-button" src="./assets/menu.svg">
            <?php echo $list ?>

            <!--Opcoes-->
            <div id="desktop_options">

                <ul id="options" class="m-0 float-end">

                    <li>
                        <select id="locate" class="form-select border-0" aria-label="Default select example">
                            <option selected>Pará de Minas</option>
                        </select>
                    </li>

                    <li>
                        <a href="index.php?list">
                            <span class="material-symbols-outlined">event</span>
                            Ver eventos
                        </a>
                    </li>

                    <li>
                        <a href="upload.php">
                            <span class="material-symbols-outlined">add_box</span>
                            Divulgar meu Evento
                        </a>
                    </li>

                    <li>
                        <?php echo $ImgPerfil ?>
                        <!-- Opções do Usuário -->
                        <ul id="user-options" class="list-group">
                            <a href="user.php?perfil">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">settings</span>
                                    <p class="m-0 p-0 d-flex align-items-center">Configurações</p> 
                                </li>
                            </a>
                            <a href="shop.php">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">monetization_on</span>
                                    <p class="m-0 p-0 d-flex align-items-center">Trocar moedas</p> 
                                </li>
                            </a>
                            <a href="php/logout.inc.php">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">logout</span>
                                    <p class="m-0 p-0 d-flex align-items-center">Sair</p> 
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    
    <section class="p-5">
        <h1 class="fw-bold">Loja</h1>
        <p class="mt-3 mb-0">Aqui você pode trocar suas moedas por cupons de descontos e outros produtos. <a href="about.php">Saiba mais.</a></p>

        <div id="container">
            <main>
                <div class="thumbnail-container">
                    <article class="thumbnail-preview ms-2 me-2 border border-black rounded h-100 text-center">
                        <h4 class="fw-bold">Produto 1</h4>
                        <p><img src="assets/coin-svgrepo-com.svg" width="20" alt="">: 0</p>
                        <button type="submit" name="upload" class="submit mx-auto"><span class="text">Resgatar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></span></button>
                    </article>
                    <article class="thumbnail-preview ms-2 me-2 border border-black rounded h-100 text-center">
                        <h4 class="fw-bold">Produto 2</h4>
                        <p><img src="assets/coin-svgrepo-com.svg" width="20" alt="">: 0</p>
                        <button type="submit" name="upload" class="submit mx-auto"><span class="text">Resgatar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></span></button>
                    </article>
                    <article class="thumbnail-preview ms-2 me-2 border border-black rounded h-100 text-center">
                        <h4 class="fw-bold">Produto 3</h4>
                        <p><img src="assets/coin-svgrepo-com.svg" width="20" alt="">: 0</p>
                        <button type="submit" name="upload" class="submit mx-auto"><span class="text">Resgatar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></span></button>
                    </article>
                    <article class="thumbnail-preview ms-2 me-2 border border-black rounded h-100 text-center">
                        <h4 class="fw-bold">Produto 4</h4>
                        <p><img src="assets/coin-svgrepo-com.svg" width="20" alt="">: 0</p>
                        <button type="submit" name="upload" class="submit mx-auto"><span class="text">Resgatar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></span></button>
                    </article>
                    <article class="thumbnail-preview ms-2 me-2 border border-black rounded h-100 text-center">
                        <h4 class="fw-bold">Produto 5</h4>
                        <p><img src="assets/coin-svgrepo-com.svg" width="20" alt="">: 0</p>
                        <button type="submit" name="upload" class="submit mx-auto"><span class="text">Resgatar</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></span></button>
                    </article>
                </div> <!--Thumbnail Container-->
            </main>
        </div> <!--Container-->
    </section>
    <?php
    } else { //Caso o Usuário não esteja logado
        //Setar Foto de Usuario Não Logado
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg" style="height:3vw"></a>';
        //Setar Opções de Usuario Não Logado
        $list ="<ul id=" . "options-mobile" . " class='list-group'>
                    <a href='index.php?list'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>event</span>Ver eventos</li></a>
                    <a href='upload.php'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>add_box</span>Divulgar meu Evento</li></a>
                </ul>";
    ?>
    <!--Cabeçalho-->
    <header>

        <!--Container-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto">

            <!--Logo-->
            <a href="index.php" class="navbar-brand p-0 m-0">
                <div class="hover">
                    <figure>
                        <img src="assets/logo-transparente.png" alt="logo" id="logo">
                    </figure>
                </div>
            </a>

            <!--Barra de Pesquisa-->
            <form id="form">
                <input type="text" name="q" id="search-input" placeholder="Procurar eventos">
            </form>

            <!--Opcoes Mobile-->
            <img id="ul-button" src="./assets/menu.svg">
            <?php echo $list ?>

            <!--Opcoes-->
            <div id="desktop_options">

                <ul id="options" class="m-0 float-end">

                    <li>
                        <select id="locate" class="form-select border-0" aria-label="Default select example">
                            <option selected>Pará de Minas</option>
                        </select>
                    </li>

                    <li>
                        <a href="index.php?list">
                            <span class="material-symbols-outlined">event</span>
                            Ver eventos
                        </a>
                    </li>

                    <li>
                        <a href="upload.php">
                            <span class="material-symbols-outlined">add_box</span>
                            Divulgar meu Evento
                        </a>
                    </li>

                    <li>
                        <?php echo $ImgPerfil ?>
                        <!-- Opções do Usuário -->
                        <ul id="user-options" class="list-group">
                            <a href="user.php?perfil">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">settings</span>
                                    <p class="m-0 p-0 d-flex align-items-center">Configurações</p> 
                                </li>
                            </a>
                            <a href="php/logout.inc.php">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">logout</span>
                                    <p class="m-0 p-0 d-flex align-items-center">Sair</p> 
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    
    <img class="rounded mx-auto d-block" src ="assets/avatar_click.svg">
    <br><h2 class='text-center'>Faça <a href='login.php' style='color: #FF5402'>Login</a> para divulgar um evento</h2><br>;

    <div class="d-flex justify-content-center pb-5">
        <a class="btn btn-lg text-white" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#FF5402" href="login.php" role="button">Fazer login</a>
    </div>

    <?php
        }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./scripts/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>