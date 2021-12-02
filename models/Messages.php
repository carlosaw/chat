<?php
class Messages extends Model {
	
  public function add($uid, $id_group, $msg) {

		$sql = "INSERT INTO messages (id_user, id_group, date_msg, msg) VALUES (:uid, :id_group, NOW(), :msg)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':uid', $uid);
		$sql->bindValue(':id_group', $id_group);
		$sql->bindValue(':msg', $msg);
		$sql->execute();
	}

}