<?php

include("php/db.inc.php");
include("php/events.inc.php");
include("php/display.inc.php");

$events = new Events();
$display = new Display();

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
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Inicio</title>
</head>

<body>
    <?php
    include("header.php");
    if (isset($_GET['event'])) {
        $events->openEvent();
    } else if (isset($_GET['list'])) {
    ?>
        <div id="container">
            <main>
                <div class="thumbnail-container">
                    <?php
                    $event = $display->displayAll();
                    if ($event) {
                        foreach ($event as $data) {
                    ?>
                            <a class="text-decoration-none text-reset" href="?event=<?php echo $data['id'] ?>">
                                <article class="thumbnail-preview ms-2 me-2 ">
                                    <div id="card" class="rounded" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;height:200px"></div>
                                    <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                                    <p><?php echo $data['description'] ?></p>
                                    <p>Estado: <?php echo $data['state'] ?></p>
                                    <p>Cidade: <?php echo $data['city'] ?></p>
                                    <p>Data do evento: <?php echo $data['date_event'] ?></p>
                                </article>
                            </a>
                    <?php
                        }
                    }
                    ?>
                </div>
            </main>
        </div>
    <?php
    } else {

    ?>
        <div class="margin-top-bottom">
            <h1 id="eventosD" class="text-black mx-auto w-50 margin-top-bottom">Eventos em destaque</h1>
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
                    $caroussel = $display->caroussel();
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
                        }
                    }
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
        </div>

        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>

        <h1 class="text-black margin-top-bottom ps-3" style="width: 95vw;">Eventos e shows</h1>

        <main>
            <div class="thumbnail-container-highlight ps-3">
                <?php
                $event = $display->highLights();
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
                    }
                }
                ?>
            </div>
        </main>


        <a href="?list"><button class="btn border-0 ms-2">Ver mais</button></a>

        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>
    <?php
    }
    ?>
</body>

</html>