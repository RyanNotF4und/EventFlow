<?php
class UploadEvent extends User
{
    private $image_name; //Nome da imagem
    private $image_type; //Tipo da imagem
    private $image_size; //Tamanho da imagem
    private $image_temp; //Local temporario
    private $uploads_folder = "uploads/event/"; //Pasta de destino;
    private $upload_max_size = 5 * 1024 * 1024; //Setando o tamanho maximo da imagem para 5MB
    public $user_id; //ID do usuário

    private $title; //Titulo do evento
    private $description; //Descricao do evento
    private $state; //Estado do evento
    private $city; //Cidade do evento
    private $adress; //Endereco do evento
    private $date_event; //Data do evento
    private $final_date_event; //Data do termino do evento
 
    private $allowed_image_types = ["image/jpeg", "image/jpg", "image/png"];

    public $error;

    public function __construct($files)
    {
        $this->image_name = $files['image']['name'];
        $this->image_type = $files['image']['type'];
        $this->image_size = $files['image']['size'];
        $this->image_temp = $files['image']['tmp_name'];
        $this->uploads_folder = $this->uploads_folder.uniqid().$this->image_name;

        $this->user_id = $_SESSION['id'];
        $this->title = $_POST['title'];
        $this->description = $_POST['description'];
        $this->state = $_POST['state'];
        $this->city = $_POST['city'];
        $this->adress = $_POST['adress'];
        $this->date_event = $_POST['date_event'];
        $this->final_date_event = $_POST['final_date_event'];

        $this->isImage();
        $this->imageNameValidation();
        $this->sizeValidation();

        if($this->error == null){
            $this->moveFile();
        }

        if($this->error == null){
            $this->recordEvent();
        }
    }

    private function isImage()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $this->image_temp);
        if(!in_array($mime, $this->allowed_image_types)){
            return $this->error = '<div class="alert alert-danger" role="alert">Ops! A capa precisa ser em JPG, JPEG ou em PNG</div>';
        }
        finfo_close($finfo);
    }

    private function imageNameValidation()
    {
        return $this->image_name = filter_var($this->image_name, FILTER_SANITIZE_STRING);
    }

    private function sizeValidation()
    {
        if($this->image_size > $this->upload_max_size){
            return $this->error = '<div class="alert alert-danger" role="alert">Ops! Você excedeu o tamanho da capa *Max: 5MB*</div>';
        }
    }

    private function checkFile()
    {
        if(file_exists($this->uploads_folder.$this->image_name)){
            return $this->error = "Arquivo já existente"; 
        }
    }

    private function moveFile()
    {
        if(!move_uploaded_file($this->image_temp, $this->uploads_folder)){
            return $this->error = '<div class="alert alert-danger" role="alert">Ops! Identificamos um erro, por favor tente novamente :( </div>';
        }
    }

    private function recordEvent()
    {
        $this->connect()->query("INSERT INTO events VALUES ('0','$this->user_id','$this->title','$this->uploads_folder','$this->description','$this->state','$this->city','$this->adress','$this->date_event', '$this->final_date_event', NOW(),'0','no')");
        $_SESSION['msg'] = '<div class="alert alert-success rounded-0" role="alert">Evento enviado com sucesso!</div>';
        sleep(3);
        header("Location: upload.php");
        exit();
    }

}
