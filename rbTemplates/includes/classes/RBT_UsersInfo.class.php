<?php 

class RBT_UsersInfo {
	
	var $id;
	var $name;
	var $email;
	var $type;
	var $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}
	
	function getEmail() {
		return $this->email;
	}
	function setEmail($o) {
		$this->email = $o;
	}
	
	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
	
	
	
	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_name_users_info_global;
			$tableName = $wpdb->prefix . $rbt_table_name_users_info_global;
			$data = array(
				'name'=> $this->getName(),
				'email'=> $this->getEmail(),
				'type'=> $this->getType()
				
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_UsersInfo.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_UsersInfo.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	public function update(){
		try {
			global $wpdb, $rbt_table_name_users_info_global;
			$tableName = $wpdb->prefix . $rbt_table_name_users_info_global;
			$data = array(
				'name'=> $this->getName(),
				'email'=> $this->getEmail(),
				'type'=> $this->getType()
			); 
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_UsersInfo.php: update,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_UsersInfo.php: update , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $rbt_table_name_users_info_global;
			$tableName = $wpdb->prefix . $rbt_table_name_users_info_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_UsersInfo();
				$data->setId($row['id']);
				$data->setName($row['name']);
				$data->setEmail($row['email']);
				$data->setType($row['type']);
				$data->setDate($row['date']);
				
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_UsersInfo.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_UsersInfo.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_name_users_info_global;
			$tableName = $wpdb->prefix . $rbt_table_name_users_info_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_UsersInfo();
					$obj->setId($row['id']);
					$obj->setName($row['name']);
					$obj->setEmail($row['email']);
					$obj->setType($row['type']);
					$obj->setDate($row['date']);
					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_UsersInfo.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_UsersInfo.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteById($id = 0) {
		
		try {
			global $wpdb, $rbt_table_name_users_info_global;
			$tableName = $wpdb->prefix . $rbt_table_name_users_info_global;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_UsersInfo.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_UsersInfo.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
