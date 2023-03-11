<?php
include("php/db.inc.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/user.css">
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Usuário</title>
</head>

<body>

    <?php
    include("header.php");
    ?>

    <header>
        <div class="navbar navbar-expand-lg navbar-light" style="background-color:#FF5402">

            <div class="w-100">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item border-none bg-transparent border-0"><a class="text-white" href="?perfil">Meu Perfil</a></li>
                    <li class="list-group-item border-none bg-transparent border-0"><a class="text-white" href="?myevents">Meus Eventos</a></li>
                </ul>
            </div>
        </div>
    </header>

    <?php
    if (isset($_GET['myevents'])) {
    ?>
        <main>
            <div class="d-block">
                <?php
                $event = $select->displayUserEvents($_SESSION['id']);
                if ($event) {
                    foreach ($event as $data) {
                ?>
                        <article class="thumbnail-preview ms-2 me-5 d-flex w-auto h-100 justify-content-start">
                            <div id="userCard" class="rounded me-5" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;width:500px;height:300px"></div>
                            <div>
                                <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                                <p><?php echo $data['description'] ?></p>
                                <p>Estado: <?php echo $data['state'] ?></p>
                                <p>Cidade: <?php echo $data['city'] ?></p>
                                <p>Data do evento: <?php echo $data['date_event'] ?></p>
                            </div>
                        </article>
                        <div>
                            <a href="?edit=<?php echo $data['id'] ?>">Editar</a>
                            <a href="?delet=<?php echo $data['id'] ?>">Deletar</a>
                        </div>
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