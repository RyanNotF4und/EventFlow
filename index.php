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
    <?php include("php/imports.inc.php"); ?>
    <title>Event Flow | Inicio</title>
</head>

<body>
    <?php
    include("header.php");
    if (isset($_GET['event'])) {
        $events->openEvent();
    } else if (isset($_GET['list'])) {
    ?>
        <div class="container margin-top-bottom">
            <?php
            $i = 0;
            $event = $display->displayAll();
            if ($event) {
                foreach ($event as $data) {
                    $i++;
                    if ($i % 2 != 0) {
            ?>
                        <div class="row w-100">
                            <div class="col-sm m-3">
                                <a class="text-decoration-none text-reset" href="?event=<?php echo $data['id'] ?>">
                                    <div id="card" class="mx-auto rounded mt-2 mb-2" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;" ></div>
                                </a>
                                <div class="card-body">
                                    <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                                    <p><?php echo $data['description'] ?></p>
                                    <p>Estado: <?php echo $data['state'] ?></p>
                                    <p>Cidade: <?php echo $data['city'] ?></p>
                                    <p>Data do evento: <?php echo $data['date_event'] ?></p>
                                </div>
                            </div>

                        <?php
                    } else {
                        ?>
                            <div class="col-sm m-3">
                                <a class="text-decoration-none text-reset" href="?event=<?php echo $data['id'] ?>">
                                    <div id="card" class="card mx-auto rounded mt-2 mb-2" style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;"></div>
                                </a>
                                <div class="card-body">
                                    <h3 class="fw-bold"><?php echo $data['title'] ?></h3>
                                    <p><?php echo $data['description'] ?></p>
                                    <p>Estado: <?php echo $data['state'] ?></p>
                                    <p>Cidade: <?php echo $data['city'] ?></p>
                                    <p>Data do evento: <?php echo $data['date_event'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
            <?php
                }
            }
            ?>
        </div>
    <?php
    } else {

    ?>
        <div class="margin-top-bottom">
            <h1 class="text-black mx-auto w-50" style="font-size: 3.5vw;">Eventos em destaque</h1>
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

        <div class="card-group">
            <?php
            $event = $display->highLights();
            if ($event) {
                foreach ($event as $data) {
            ?>
                    <div class="col-sm m-1">
                        <a class="text-decoration-none text-reset" href="?event=<?php echo $data['id'] ?>">
                            <div style="background: url(<?php echo $data['thumb_path'] ?>) no-repeat center;background-size:cover;width:350px;height:200px" class="ms-3 rounded mt-2 mb-2"></div>
                        </a>
                        <div class="card-body ms-3">
                            <h5 class="ml-2 mx-auto d-flex fw-bold"><?php echo $data['title'] ?></h5>
                            <p class="mx-auto d-flex"><?php echo $data['description'] ?></p>
                            <p class="mx-auto d-flex">Estado: <?php echo $data['state'] ?></p>
                            <p class="mx-auto d-flex">Cidade: <?php echo $data['city'] ?></p>
                            <p>Data do evento: <?php echo $data['date_event'] ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <a href="?list"><button class="btn border-0 ms-2">Ver mais</button></a>

        <div class="container-fluid" style="height:5vw;background-color:#dbdbdb"></div>
    <?php
    }
    ?>
</body>

</html>