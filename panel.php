<?php
session_start();
include("php/db.inc.php");
include("php/events.inc.php");
$events = new Events;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/panel">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <title>Panel</title>
</head>

<body>

    <header>
        <a href="index.php"><img src="assets/logo-transparente.png" alt="Logo"></a>
    </header>

    <?php

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
        <main>
            <h1>Gerenciamento dos Eventos</h1>
            <section>
                <a href="panel.php?upload">Upload</a>
                <a href="panel.php?list">Listar</a>
            </section>
        </main>
</body>

</html>