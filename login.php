<?php

    if (!isset($_SESSION)) { //Se a sessão não existir, criar uma
        session_start();
    }

    //Includes
    include("php/db.inc.php");
    include("php/user.inc.php");

    $user = new User();

    //Ao pressionar o botão de confirmar
    if(isset($_POST["submit"])) {
        $result = $user->login($_POST["uname_email"],$_POST["psw"]); //Enviar dados

        if($result == 1) { //Se retornar 1, o usuário loga e redireciona para o index
            $_SESSION["login"] = true;
            $_SESSION["id"] = $user->idUser();
            header("Location: index.php");
        }
    }

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
    <link rel="icon" href="assets/favicon.png">
    <title>Event Flow | Login</title>

</head>

<body style="max-height:100vh">
    <section class="h-100">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <a href="index.php"><img src="assets/logo-transparente.png" class="img-fluid" alt="Logo"></a>
                    <div class="form-outline mb-3">
                        <!--Avisos-->
                        <span class='text-warning'><?php if (isset($_SESSION['msg'])) { echo $_SESSION['msg'];unset($_SESSION['msg']) ;}?></span>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 border border-black rounded">
                    <form class="padding" method="POST">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Fazer login com</p>
                            <button type="button" class="btn btn-floating mx-1">
                               <img src="assets/facebook-icon.svg" alt="Facebook" srcset="">
                            </button>

                            <button type="button" class="btn btn-floating mx-1">
                                <img src="assets/Instagram-logo.png" width="32" alt="Instragram" srcset="">
                            </button>

                            <button type="button" class="btn btn-floating mx-1">
                                <img src="assets/twitter-icon.svg" width="32" alt="Twitter" srcset="">
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Ou</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" name="uname_email" class="form-control form-control-lg" placeholder="E-mail ou Usuário" required/>
                            <label class="form-label" for="form3Example3">Endereço E-mail ou Usuário</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="psw" class="form-control form-control-lg" placeholder="Senha" required/>
                            <label class="form-label" for="form3Example4">Senha</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Lembrar
                                </label>
                            </div>
                            <a href="#!" class="text-body">Esqueceu sua senha?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" name="submit" class="btn btn-lg text-white" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#FF5402;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0 ">Não possui uma conta? <a href="register.php" class="link-danger">Registrar</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>