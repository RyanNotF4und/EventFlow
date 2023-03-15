<?php
    //Includes
    include("php/db.inc.php");
    include("php/events.inc.php");
    include("php/display.inc.php");
    include("php/user.inc.php");

    $select = new Select();

    if (!isset($_SESSION)) { //Se a sessão não existir, criar uma
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
    <link rel="stylesheet" href="css/logo-shine.css">
    <link rel="stylesheet" href="css/button-details.css">
    <link rel="icon" href="assets/favicon.png">

    <title>Event Flow | Inicio</title>
</head>

<body>
    <!--Cabeçalho-->
    <header>
        
        <!--Container-->
        <div class="navbar navbar-expand-lg navbar-light bg-white w-95 m-0 mx-auto"> 
            
            <!--Logo-->
            <a href="index.php" class="navbar-brand p-0 m-0"><div class="hover h-100"><figure><img src="assets/logo-transparente.png" alt="logo" style="width:12vw; min-width:150px"></figure></div></a>
            
            <!--Barra de Pesquisa Desktop-->
            <form id="form_desktop" class="align-items-center w-50 p-0 m-0">
                <input type="text" name="" class="mx-auto" id="search_bar_desktop" placeholder="Procurar eventos">
                <span class="bar"></span>
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

    <!--Abrir Evento-->
    <?php
        if (isset($_GET['event'])) {
            $event = $events->openEvent(); //Chamar Função Abrir Evento
            if ($event) {
                foreach ($event as $data) {
        ?>
        <div class="w-50 mx-auto pt-5">
            <img src="<?php echo $data['thumb_path'] ?>" alt="<?php echo $data['title'] ?>" class="w-100 rounded">
        </div>
        <div class="w-50 mx-auto">
            <h1 class="fw-bold text-center"><?php echo $data['title'] ?></h1>
            <p>Detalhes sobre o evento: <?php echo $data['description'] ?></p>
            <p>Estado: <?php echo $data['state'] ?></p>
            <p>Cidade: <?php echo $data['city'] ?></p>
            <p>Data do evento: <?php echo $data['date_event'] ?></p>
        </div>
        <div class="w-100 text-center pt-5 mt-3 mb-3">
        <button class="button"> Comprar ingresso </button>
        </div>
        <!--Barra Cinza-->
        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>

        <?php
                } //Foreach
            } //If
        ?>
            <?php
        } else if (isset($_GET['list'])) {
    ?>
        <!--Mostrar Todos os Eventos-->
        <div id="container">
            <main>
                <div class="thumbnail-container">
                    <?php
                        $event = $display->displayAll(); //Chamar Função Mostrar Todos os Eventos
                        if ($event) {
                            foreach ($event as $data) {
                    ?>
                    
                        <article class="thumbnail-preview ms-2 me-2">
                            <h3 class="fw-bold text-center"><?php echo $data['title'] ?></h3>
                            <div id="card" class="rounded" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;height:200px"></div>
                            <?php echo $data['state'] ?>, <?php echo $data['city'] ?>
                            <p>Data do evento: <?php echo $data['date_event'] ?></p>
                            <a class="text-decoration-none text-reset d-flex justify-content-center" href="?event=<?php echo $data['id'] ?>"><button class="detail"> Ver Detalhes <span></span></button></a>
                        </article>
                    </a>
                    <?php
                            } //Foreach
                        } //If
                    ?>
                </div> <!--Thumbnail Container-->
            </main>
        </div> <!--Container-->

    <?php
        } else {
    ?>
        <!--Pagina Inicial-->

        <!--Carrosel-->
        <div class="margin-top-bottom">
            <h1 class="text-black mx-auto w-50 margin-top-bottom">Eventos em destaque</h1>
            <div id="carouselExampleIndicators" class="carousel slide bg-black mx-auto" style="width:50vw; height:25vw">
                <div class="carousel-indicators">
                    <button type="button" style="width:5vw" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" style="width:5vw" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" style="width:5vw" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" style="width:5vw" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item slide active" data-bs-interval="10000">
                        <div class="background" style="background: url(assets/Design_sem_nome.png) no-repeat center;background-size:cover;height:24.5vw"></div>
                    </div>

                    <?php
                        $caroussel = $display->caroussel(); //Chamar Função Mostrar Eventos no Carrossel
                        if ($caroussel) {
                            foreach ($caroussel as $data) {
                    ?>

                    <div class="carousel-item" data-bs-interval="10000">
                        <a href="index.php?event=<?php echo $data['id'] ?>">
                            <div style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;height:24.5vw"></div>
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $data['title'] ?></h5>
                            <p><?php echo $data['description'] ?></p>
                        </div>
                    </div>

                    <?php
                            } //Foreach
                        } //If
                    ?>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="width:5vw">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="width:5vw">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div> <!--Carrosel-->

        <!--Barra Cinza-->
        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>
        
        <!--Mostrar Mais Destaques-->
        <h1 class="text-black margin-top-bottom ps-3" style="width: 95vw;">Eventos e shows</h1>
        <section>
            <div class="thumbnail-container-highlight ps-3">
                <?php
                    $event = $display->highLights(); //Chamar Função Mostrar Destaques
                    if ($event) {
                        foreach ($event as $data) {
                ?>
                    <a class="text-decoration-none text-reset" href="?event=<?php echo $data['id'] ?>">
                        <article class="thumbnail-preview ms-2 me-5 ">
                            <div id="card" class="rounded" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;height:200px"></div>
                            <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                            <p><?php echo $data['description'] ?></p>
                            <p>Estado: <?php echo $data['state'] ?></p>
                            <p>Cidade: <?php echo $data['city'] ?></p>
                            <p>Data do evento: <?php echo $data['date_event'] ?></p>
                        </article>
                    </a>
                <?php
                        } //Foreach
                    } //If
                ?>
            </div>
        </section>
        
        <!--Ver Todos os Eventos-->
        <a href="?list">
            <button class="btn border-0 ms-2">Ver mais</button>
        </a>

        <!--Barra Cinza-->
        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>

    <?php
        }
    ?>

</body>

</html>