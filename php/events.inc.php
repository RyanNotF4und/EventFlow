<?php
class Events extends db
{
    protected function getUserIp()
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        return $user_ip;
    }

    protected function getEventId()
    {
        $page_id = mysqli_real_escape_string($this->connect(), $_GET['event']);
        return $page_id;
    }

    public function openEvent()
    {
        $page_id = $this->getEventId();
        $data = $this->connect()->query("SELECT * FROM events WHERE id = '$page_id'");
        while ($row = $data->fetch_assoc()) {
            echo $row['title'];
            ?>
            <img src="<?php echo $row['thumb_path'] ?>">
<?php
        }
        $this->countView($page_id);
    }
    protected function countView($page_id)
    {
        $user_ip = $this->getUserIp();
        $check_ip = $this->connect()->query("SELECT user_ip FROM pageview WHERE page_id='$page_id' AND user_ip='$user_ip'");
        $ip_row = $check_ip->num_rows;
        if ($ip_row < 1) {
            $this->connect()->query("INSERT INTO pageview values('$page_id','$user_ip')");
            $this->connect()->query("UPDATE events SET views = views+1 WHERE id ='$page_id'");
        }
    }
}


?>