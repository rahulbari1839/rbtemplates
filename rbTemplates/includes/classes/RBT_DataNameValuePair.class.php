<?php 

class RBT_DataNameValuePair {
	
	var $id;
	var $parent_id;
	var $type;
	var $data_type;
	var $name;
	var $value;
	var $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getParentId() {
		return $this->parent_id;
	}
	function setParentId($o) {
		$this->parent_id = $o;
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
	
	function getDataType() {
		return $this->data_type;
	}
	
	function setDataType($o) {
		$this->data_type = $o;
	}
	
	
	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$data = array(
				'type'=> $this->getType(),
				'name'=> $this->getName(),
				'value'=> $this->getValue(),
				'data_type'=> $this->getDataType(),
				'parent_id'=> $this->getParentId()
				
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	public function update(){
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$data = array(
				'type'=> $this->getType(),
				'name'=> $this->getName(),
				'value'=> $this->getValue(),
				'data_type'=> $this->getDataType(),
				'parent_id'=> $this->getParentId()
				
			); 
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: update,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: update , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_DataNameValuePair();
				$data->setId($row['id']);
				$data->getType($row['type']);
				$data->setName($row['name']);
				$data->setValue($row['value']);
				$data->setParentId($row['parent_id']);
				$data->setDate($row['date']);
				$data->setDataType($row['data_type']);

				
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}

	public static function loadByParentId($id) {
		 
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `parent_id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_DataNameValuePair();
					$obj->setId($row['id']);
					$obj->getType($row['type']);
					$obj->setName($row['name']);
					$obj->setValue($row['value']);
					$obj->setParentId($row['parent_id']);
					$obj->setDate($row['date']);
					$obj->setDataType($row['data_type']);
					$data[] =  $obj;
				}
			}
			
			return $data;
			
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_DataNameValuePair();
					$obj->setId($row['id']);
					$obj->getType($row['type']);
					$obj->setName($row['name']);
					$obj->setValue($row['value']);
					$obj->setParentId($row['parent_id']);
					$obj->setDate($row['date']);
					$obj->setDataType($row['data_type']);
					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteById($id = 0) {
		
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}

	public static function deleteByParentId($parent_id = 0) {
		
		try {
			global $wpdb, $rbt_table_name_data_name_value_pair_global;
			$tableName = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
			$wpdb->delete($tableName, array( 'parent_id' => $parent_id ) );
			return $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: deleteByParentId,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_DataNameValuePair.class.php: deleteByParentId , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
