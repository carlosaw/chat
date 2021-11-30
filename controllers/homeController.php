<?php
class homeController extends controller {

  private $user;

  public function __construct() {
  
      $this->user = new Users();

    if(!$this->user->verifyLogin()) {
      header("Location: ".BASE_URL."login");
      exit;
    }
  }

  public function index() {
      $data = array();               
      
      $this->loadTemplate('home', $data);
  }
}