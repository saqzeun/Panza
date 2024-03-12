<?php
  class dbco {
    private $db;
    public function __construct($dbname, $login, $password) {
      try {
        $this->db = new PDO("mysql:host=localhost;dbname=" . $dbname . ";charset=utf8", $login, $password);
      } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
      }
    }
    public function SQLWithoutParam($sql) {
      $response = $this->db->query($sql);
      $data = $response->fetchAll();
      $response->closeCursor();
      return $data;
    }
    public function close() {
      $this->db = null;
    }
  }
?>