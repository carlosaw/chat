<?php
class ajaxController extends controller {

  private $user;

  public function __construct() {  
    $this->user = new Users();

    if(!$this->user->verifyLogin()) {
      $array = array(
				'status' => '0'
			);
			echo json_encode($array);
			exit;
    }
  }

  public function index() {}
	// Pega os grupos
	public function get_groups() {
		$array = array('status' => '1');		
		$groups = new Groups();

		$array['list'] = $groups->getList();

		echo json_encode($array);
		exit;
	}

// WebService Função para criar novo grupo
	public function add_group() {
		$array = array('status' => '1', 'error' => '0');
		$groups = new Groups();

		if(!empty($_POST['name'])) {
			$name = $_POST['name'];

			$groups->add($name);
		} else {
			$array['error'] = '1';
			$array['errorMsg'] = 'Falta o NOME do grupo.';
		}
		echo json_encode($array);
		exit;
	}
}