<?php
class Groups extends Model {
	// Pega os grupos
	public function getList() {
		$array = array();
		$sql = "SELECT * FROM groups ORDER BY name ASC";
		$sql = $this->db->query($sql);
		$array = $sql->fetchAll(PDO::FETCH_ASSOC);

		return $array;
	}
	
	// WebService Função para criar novo grupo
	public function add($name) {
		$sql = "INSERT INTO groups (name) VALUES (:name)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":name", $name);
		$sql->execute();
	}

}