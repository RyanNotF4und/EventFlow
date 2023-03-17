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
        $list ="<ul id=" . "options-mobile" . " class='list-group'>
                    <li class='list-group-item'><img src=" . "assets/coin-svgrepo-com.svg" . " class='ps-1 pe-2' style='height:3vh;'>0</li>
                    <a href='index.php?list'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>event</span>Ver eventos</li></a>
                    <a href='upload.php'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>add_box</span>Divulgar meu Evento</li></a>
                    <a href='user.php?perfil'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>settings</span>Configurações</li></a>
                    <a href='php/logout.inc.php' class='text-decoration-none text-black'><li class='list-group-item d-flex'><span class='pe-2 material-symbols-outlined'>logout</span>Sair</li></a>
                </ul>";
    } else {
        //Setar icone de usuário não logado
        $ImgPerfil = '<a href="login.php"><img src="assets/user-128.svg" style="height:3vw"></a>';
        //Opções para usuário não logado
        $list ="<ul class='list-group'>
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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
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
                                    <span class="pe-2 material-symbols-outlined">settings</span>Configurações
                                </li>
                            </a>
                            <a href="php/logout.inc.php">
                                <li class="list-group-item w-100 d-flex align-itens-center">
                                    <span class="pe-2 material-symbols-outlined">logout</span>
                                    Sair
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./scripts/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>