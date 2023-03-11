<?php
if (!isset($_SESSION)) {
    //Se a sessão não existir, criar uma
    session_start();
}

include("php/db.inc.php");
include("php/user.inc.php");

$user = new User();

if(isset($_POST["submit"])) {
    $user->register($_POST["email"],$_POST["uname"],$_POST["psw"],$_POST["confirm_psw"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Registrar</title>
</head>

<body style="max-height:100vh">
    <section class="h-100">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <a href="index.php"><img src="assets/logo-transparente.png" class="img-fluid" alt="Logo"></a>
                    <div class="form-outline mb-3">
                        <span class='text-warning'><?php if (isset($_SESSION['msg'])) { echo $_SESSION['msg'];unset($_SESSION['msg']) ;}?></span>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 border border-black rounded">
                    <form class="padding" method="POST">

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mb-0" style="font-size: 2rem;">Registrar</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="E-mail" required/>
                            <label class="form-label" for="form3Example3">Endereço E-mail</label>
                        </div>

                        <!-- User input -->
                        <div class="form-outline mb-4">
                            <input type="user" id="form3Example3" name="uname" class="form-control form-control-lg" placeholder="Usuário" required/>
                            <label class="form-label" for="form3Example3">Nome de Usuário</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="psw" class="form-control form-control-lg" placeholder="Senha" required/>
                            <label class="form-label" for="form3Example4">Senha</label>
                        </div>

                        <!-- Confirm Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="confirm_psw" class="form-control form-control-lg" placeholder="Confirmar Senha" required/>
                            <label class="form-label" for="form3Example4">Confirmar Senha</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-lg text-white" name="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#FF5402;">Registrar</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0 ">Já possui uma conta? <a href="login.php" class="link-danger">Fazer login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>