<?php

class Login {
  
  public static function getUserLogin($name) {
    return Database::returnAllLogin($name);
  }
}

?>