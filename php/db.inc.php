<?php
class db
{
	private $host;
	private $user;
	private $password;
	private $database;

	protected function connect()
	{
		$this->host = "localhost";
		$this->user = "root";
		$this->password = "";
		$this->database = "event_flow";

		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		return $conn;
	}
}
