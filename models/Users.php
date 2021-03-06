<?php class Users extends Model {

	private $uid;

	public function verifyLogin() {
		if(!empty($_SESSION['chathashlogin'])) {
			$s = $_SESSION['chathashlogin'];

			$sql = "SELECT * FROM users WHERE loginhash = :hash";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":hash", $s);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$data = $sql->fetch();
				$this->uid = $data['id'];
				
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function validateUsername($u) {
		if(preg_match('/^[a-z0-9]+$/', $u)) {
			return true;
		} else {
			return false;
		}
	}

	public function userExists($u) {

		$sql = "SELECT * FROM users WHERE username = :u";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u", $u);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	// Cadastrar Usuário
	public function registerUser($username, $pass) {
		$newpass = password_hash($pass, PASSWORD_DEFAULT);//Cria hash da senha
		$sql = "INSERT INTO users (username, pass) VALUES (:u, :p)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u", $username);
		$sql->bindValue(":p", $newpass);
		$sql->execute();
	}

	// Validação de LOGIN
	public function validateUser($username, $pass) {
		// Pega o usuário
		$sql = "SELECT * FROM users WHERE username = :username";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":username", $username);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$info = $sql->fetch();
			
			// Se fez login gera loginhash md5
			if(password_verify($pass, $info['pass'])) {
				$loginhash = md5(rand(0,99999).time().$info['id'].$info['username']);
				
				// Seta este login a este usuario
				$this->setLoginHash($info['id'], $loginhash);// Só loga um usuário
				$_SESSION['chathashlogin'] = $loginhash;// Salva na session

				return true;//Login deu Ok
				
			} else {
				return false;
			}			
		} else {
			return false;
		}
	}

	private function setLoginHash($uid, $hash) {
		$sql = "UPDATE users SET loginhash = :hash WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":hash", $hash);
		$sql->bindValue(":id", $uid);
		$sql->execute();
	}

	public function clearLoginHash() {
		$_SESSION['chathashlogin'] = '';
	}

	public function updateGroups($groups) {
		// Transf o array de groups em strings
		$groupstring = '';
		if(count($groups) > 0) {
			$groupstring = '!'.implode('!', $groups).'!';
		} 
		
		$sql = "UPDATE users SET last_update = NOW(), groups = :groups WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':groups', $groupstring);
		$sql->bindValue(':id', $this->uid);
		$sql->execute();
	}

	public function clearGroups() {
		$sql = "UPDATE users SET groups = '' WHERE last_update < DATE_ADD(NOW(), INTERVAL -2 MINUTE)";
		$this->db->query($sql);
	}

	public function getUsersInGroup($group) {
		$array = array();

		$sql = "SELECT username FROM users WHERE groups LIKE :groups";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':groups', '%!'.$group.'!%');
		$sql->execute();

		if($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($list as $item) {
				$array[] = $item['username'];
			}
		}
		return $array;
	}

	public function getCurrentGroups() {
		$array = array();

		$sql = "SELECT groups FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $this->uid);
		$sql->execute();
		$sql = $sql->fetch();
		/*print_r($sql['groups']);
		exit;*/
		// !4!3!1!
		$array = explode('!', $sql['groups']);
		if(count($array) > 0) {
			array_pop($array);
			array_shift($array);
			/*print_r($array);
			exit;*/
			$groups = new Groups();
			$array = $groups->getNameByArray($array);	
		}
		return $array;
	}
	
	public function getUid() {
		return $this->uid;
	}

	public function getName() {
		$sql = "SELECT username FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $this->uid);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();
			return $data['username'];
		}
		return '';
	}

}