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

    if (isset($_GET['upload'])) {
    ?>
        <h1>Cadastrar Evento</h1>

        <form enctype="multipart/form-data" method="POST" autocomplete="off">

            <p>
                <label for="formThumb">Capa</label>
                <input type="file" id="formThumb" name="img" accept="image/*">
            </p>

            <p>
                <label for="formTitle">Titulo</label>
                <input type="text" id="formTitle" name="title">
            </p>

            <p>
                <label for="formTitle">Descrição</label>
                <input type="text" id="formTitle" name="description">
            </p>

            <p>
                <label for="formTitle">Data do evento</label>
                <input type="text" id="formTitle" name="date_event">
            </p>

            <p>
                <button type="submit"><img src="./assets/confirm-icon.svg" alt="Enviar"></button>
            </p>
        </form>

        <main>
            <h1>Gerenciamento dos Eventos</h1>
            <section>
                <a href="panel.php?upload">Upload</a>
                <a href="panel.php?list">Listar</a>
            </section>
        </main>
    <?php
    }
    ?>
</body>

</html>