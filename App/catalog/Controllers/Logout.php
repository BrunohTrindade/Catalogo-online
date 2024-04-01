<?php

namespace Catalog\Controllers;

class Logout{

  public function index()
  {
    unset($_SESSION['type'], $_SESSION['nome']);

    session_destroy();
    header("Location: " . URL . "home");
  }
}