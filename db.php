
<?php

Class Db {
  private $host;
  private $user;
  private $passwd;
  private $db;
  private $con;
  private $connected;

  public function __construct($host, $user, $passwd, $db)
  {
    $this->host = $host;
    $this->user = $user;
    $this->passwd = $passwd;
    $this->db = $db;
    $this->connected = false;
  }

  public function connect() {
    $this->con = new mysqli($this->host, $this->user, 
                            $this->passwd, $this->db);
    if (! $this->con->connect_errno) {
      $this->connected = true;
      return true;
    }
    return false;
  }

  public function isConnected() {
    return $this->connected;
  }

  public function exec($sql) {
    $res = null;
    if ($this->connected) {
      $res = $this->con->query($sql);
    }
    return $res;
  }

  public function prepare($sql) {
    $stmt = null;
    if ($this->connected) {
      $stmt = $this->con->prepare($sql);
    }
    return $stmt;
  }

  public function getLastID() {
    $id = null;
    if ($this->connected) {
      $id = $this->con->insert_id;
    }
    return $id;
  }

  public function __destruct() {
    if ($this->connected) {
      $this->con->close();
      $this->connected = false;
    }
  }

}



