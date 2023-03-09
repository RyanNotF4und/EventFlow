<?php
class User extends db
{
    public $user_id;
    public $error;

    public function idUser()
    {
        return $this->user_id;
    }

    public function register($email, $uname, $psw, $confirm_psw)
    {
        $duplicate = $this->connect()->query("SELECT * FROM users WHERE uname = '$uname' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return $this->error = '<div class="alert alert-danger" role="alert">Email ou Nome de Usuário já existentes!</div>';
        } else {
            if ($psw == $confirm_psw) {
                $query = "INSERT INTO users VALUES('0','$email','$uname','$psw','assets/user-128.svg')";
                mysqli_query($this->connect(), $query);
                $_SESSION['msg'] = '<div class="alert alert-success rounded-0" role="alert">Registro realizado com sucesso!</div>';
                header("Location: login.php");
                exit();
            } else {
                return $this->error = '<div class="alert alert-danger" role="alert">As senhas não coincidem!</div>';
            }
        }
    }

    public function login($uname_email, $psw)
    {
        $result = $this->connect()->query("SELECT * FROM users WHERE uname = '$uname_email' OR email = '$uname_email'");
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            if ($psw == $row['psw']) {
                $this->user_id = $row['id'];
                if (!isset($_SESSION)) {
                    session_start();
                }
                return 1;
            } else {
                return $this->error = '<div class="alert alert-danger" role="alert">Senha incorreta!</div>';
            }
        } else {
            return $this->error = '<div class="alert alert-danger" role="alert">Usuário não registrado!</div>';
        }
    }
}

class Select extends db
{

    public function selectUserById($user_id)
    {
        $result = $this->connect()->query("SELECT * FROM users WHERE id = '$user_id'");
        return mysqli_fetch_assoc($result);
    }
}