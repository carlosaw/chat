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
      $data = array(
        'name' => $this->user->getName(),
        'current_groups' => $this->user->getCurrentGroups()
      );
      /*print_r($data['current_groups']);
      exit;*/
      //$this->user->clearGroups();// Limpa os grupos
      
      $this->loadTemplate('home', $data);
  }
}