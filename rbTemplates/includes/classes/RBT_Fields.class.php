<?php 

class RBT_Fields {
	
	var $id;
	var $name;
	var $label;
	var $type;
	var $value;
	var $placeholder;
	var $date;
	var $is_required;
	var $required_msg;
	
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
	
	function getLabel() {
		return $this->label;
	}
	function setLabel($o) {
		$this->label = $o;
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
	
	function getPlaceholder() {
		return $this->placeholder;
	}
	function setPlaceholder($o) {
		$this->placeholder = $o;
	}
	
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	

	function getIsRequired() {
		return $this->is_required;
	}
	function setIsRequired($o) {
		$this->is_required = $o;
	}
	

    function getRequiredMsg() {
		return $this->required_msg;
	}
	function setRequiredMsg($o) {
		$this->required_msg = $o;
	}
	
	function getCreatedBy() {
		return $this->created_by;
	}
	function setCreatedBy($o) {
		$this->created_by = $o;
	}
	


	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$data = array(
				'name'=> $this->getName(),
				'type'=> $this->getType(),
				'label'=> $this->getLabel(),
				'value'=> $this->getValue(),
				'placeholder'=> $this->getPlaceholder(),
				'is_required'=> $this->getIsRequired(),
				'required_msg'=> $this->getRequiredMsg(),
				'created_by'=> $this->getCreatedBy()
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	public function update(){
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$data = array(
				'name'=> $this->getName(),
				'type'=> $this->getType(),
				'label'=> $this->getLabel(),
				'value'=> $this->getValue(),
				'placeholder'=> $this->getPlaceholder(),
				'is_required'=> $this->getIsRequired(),
				'required_msg'=> $this->getRequiredMsg(),
				//'created_by'=> $this->getCreatedBy()
			); 
			// don't update the name and type column value in edit mode
			if(1){
				unset($data['name']);
				unset($data['type']);
			}
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: update,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: update , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_Fields();
				$data->setId($row['id']);
				$data->setName($row['name']);
				$data->setType($row['type']);
				$data->setLabel($row['label']);
				$data->setValue($row['value']);
				$data->setPlaceholder($row['placeholder']);
				$data->setDate($row['date']);
				$data->setIsRequired($row['is_required']);
				$data->setRequiredMsg($row['required_msg']);
				$data->setCreatedBy($row['created_by']);
				

			}
			
			
			return $data;
		 
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadByFieldName($field_name = '') {
		 
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$field_name."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_Fields();
				$data->setId($row['id']);
				$data->setName($row['name']);
				$data->setType($row['type']);
				$data->setLabel($row['label']);
				$data->setValue($row['value']);
				$data->setPlaceholder($row['placeholder']);
				$data->setDate($row['date']);
				$data->setIsRequired($row['is_required']);
				$data->setRequiredMsg($row['required_msg']);
				$data->setCreatedBy($row['created_by']);
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					
					$obj = new RBT_Fields();
					$obj->setId($row['id']);
					$obj->setName($row['name']);
					$obj->setType($row['type']);
					$obj->setLabel($row['label']);
					$obj->setValue($row['value']);
					$obj->setPlaceholder($row['placeholder']);
					$obj->setDate($row['date']);
					$obj->setIsRequired($row['is_required']);
					$obj->setRequiredMsg($row['required_msg']);
					$obj->setCreatedBy($row['created_by']);

					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteById($id = 0) {
		
		try {
			global $wpdb, $rbt_table_name_fields_global;
			$tableName = $wpdb->prefix . $rbt_table_name_fields_global;
			$hasData = self::loadById($id);
			if(isset($hasData) && $hasData->getCreatedBy() != 'default'){
				$wpdb->delete($tableName, array( 'id' => $id ) );
			}
			return $id;
			
		}catch (PDOException $e) {
			RBlogToFile("RBT_Form.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Form.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
