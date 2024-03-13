<?php
  class MySQL {
    static private $oPDO = NULL;
    static private $oInstance = NULL;
    private function __construct() {
      self::$oPDO = new PDO("mysql:host=localhost;dbname=panza;charset=utf8", "root", "root");
      self::$oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$oPDO->query("SET NAMES 'utf8'");
    }
    public function __call($method, $params)
    {
      if (self::$oPDO == NULL) {
        self::__construct();
      }
      return call_user_func_array(array(self::$oPDO, $method), $params);
    }
    static public function getInstance() {
      if (!(self::$oInstance instanceof self)) {
        self::$oInstance = new self();
      }
      return self::$oInstance;
    }
  }
?>