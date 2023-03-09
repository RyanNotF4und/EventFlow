<?php

class Display extends db
{
    public function caroussel()
    {
        $result = $this->connect()->query("SELECT * FROM events ORDER BY views DESC LIMIT 0,3");
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function highLights()
    {
        $result = $this->connect()->query("SELECT * FROM events ORDER BY views DESC LIMIT 3,5");
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function displayAll()
    {
        $result = $this->connect()->query("SELECT * FROM events ORDER BY views DESC");
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
