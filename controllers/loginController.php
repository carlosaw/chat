<?php
class loginController extends controller {

	public function index() {
		$data = array(
			'msg' => ''
		);
		if(!empty($_GET['error'])) {
			if($_GET['error'] == '1') {
				$data['msg'] = 'Usuário e/ou senha inválidos!';
			}
		}	
		$this->loadView('login', $data);
	}
	// Login
	public function signin() {

		if(!empty($_POST['username'])) {
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];

			$users = new Users();// Valida os dados
			if($users->validateUser($username, $pass)) {
				header("Location: ".BASE_URL);
				exit;
			} else {// Se não deu certo volta pra login com msg
				header("Location: ".BASE_URL."login?error=1");
				exit;
			}

		} else {// Se não enviar dados
			header("Location: ".BASE_URL."login");
			exit;
		}
	}

	public function signup() {
		$data = array(
			'msg' => ''
		);
			
		if(!empty($_POST['username'])) {
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];

			$users = new Users();

			if($users->validateUsername($username)) {// Se validar usuário
				if(!$users->userExists($username)) {//Verifica se usuario existe
					$users->registerUser($username, $pass);//Se não existir manda user e pass
					header("Location: ".BASE_URL."login");
				} else {
					$data['msg'] = 'Usuário já existente!';
				}
			} else {
				$data['msg'] = 'Usuário não válido! (Digite apenas letras e números)';
			}
		}

		$this->loadView('signup', $data);
	}
}