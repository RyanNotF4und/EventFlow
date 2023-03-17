<?php
class User extends db
{
    public $user_id;

    public function idUser()
    {
        return $this->user_id;
    }

    public function register($email, $uname, $psw, $confirm_psw)
    {
        $duplicate = $this->connect()->query("SELECT * FROM users WHERE uname = '$uname' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            $_SESSION['msg'] = '<div class="alert alert-danger rounded-0" role="alert">Usuário já existente!</div>';
            header("Location: register.php");
            exit();
        } else {
            if ($psw == $confirm_psw) {
                $query = "INSERT INTO users VALUES('0','$email','$uname','$psw','assets/user-128.svg')";
                mysqli_query($this->connect(), $query);
                $_SESSION['msg'] = '<div class="alert alert-success rounded-0" role="alert">Registro realizado com sucesso!</div>';
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['msg'] = '<div class="alert alert-danger rounded-0" role="alert">As senhas não coincidem!</div>';
                header("Location: register.php");
                exit();
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
                $_SESSION['msg'] = '<div class="alert alert-danger rounded-0" role="alert">Senha incorreta!</div>';
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger rounded-0" role="alert">Usuário não registrado!</div>';
                header("Location: login.php");
                exit();
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

    public function displayUserEvents($user_id)
    {
        $result = $this->connect()->query("SELECT * FROM events WHERE user_id = '$user_id'");
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleteEvent($user_id) {
        $event_id = $_GET['delete'];
        $result = $this->connect()->query("SELECT * FROM events WHERE user_id = '$user_id' AND id = '$event_id'");
        $archive = $result->fetch_assoc();
        if($result->num_rows > 0) {
            $delete = $this->connect()->query("DELETE FROM events WHERE user_id = '$user_id' AND id = '$event_id'");
            unlink($archive['thumb_path']);
            if ($delete) {
                header("user.php?myevents");
            }
        } else {
            return false;
        }
    }
}
