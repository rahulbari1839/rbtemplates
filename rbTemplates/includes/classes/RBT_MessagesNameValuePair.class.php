<?php 

class RBT_MessagesNameValuePair {
	
	var $id;
	
	var $type;
	var $name;
	var $value;
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
	
	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}
	
	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value = $o;
	}
	
	function getDate() {
		return $this->type;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
	
	
	
	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_name_message_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_message_name_value_pair_global;
			$data = array(
				'type'=> $this->getType(),
				'name'=> $this->getName(),
				'value'=> $this->getValue(),
				
				
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	public function update(){
		try {
			global $wpdb, $rbt_table_name_message_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_message_name_value_pair_global;
			$data = array(
				'type'=> $this->getType(),
				'name'=> $this->getName(),
				'value'=> $this->getValue(),
				
				
			); 
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: update,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: update , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $rbt_table_name_message_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_message_name_value_pair_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_MessagesNameValuePair();
				$data->setId($row['id']);
				$data->getType($row['type']);
				$data->setName($row['name']);
				$data->setValue($row['value']);
				
				$data->setDate($row['date']);
				
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_name_message_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_message_name_value_pair_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_MessagesNameValuePair();
					$obj->setId($row['id']);
					$obj->getType($row['type']);
					$obj->setName($row['name']);
					$obj->setValue($row['value']);
					
					$obj->setDate($row['date']);
					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteById($id = 0) {
		
		try {
			global $wpdb, $rbt_table_name_message_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_message_name_value_pair_global;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_MessagesNameValuePair.class.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
