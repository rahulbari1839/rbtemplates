<?php 

class RBT_Logs {
	
	var $id;
	var $log;
	var $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getLog() {
		return $this->log;
	}
	function setLog($o) {
		$this->log = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	
	
	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_name_logs_global;
			$tableName = $wpdb->prefix . $rbt_table_name_logs_global;
			$data = array(
				'log'=> $this->getLog()
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBlogToFile("RBT_Logs.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Logs.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	
	
	
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_name_logs_global;
			$tableName = $wpdb->prefix . $rbt_table_name_logs_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_Logs();
					$obj->setId($row['id']);
					$obj->setLog($row['log']);
					$obj->setDate($row['date']);
					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBlogToFile("RBT_Logs.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Logs.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadHtml() {
		
		$html  = '';
		try {
			global $wpdb, $rbt_table_name_logs_global;
			$tableName = $wpdb->prefix . $rbt_table_name_logs_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$html .= $row['date']. ': '. $row['log'].'<br>';
				}
			}
			return $html;
		 
		}catch (PDOException $e) {
			RBlogToFile("RBT_Logs.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Logs.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteAll() {
		
		try {
			global $wpdb, $rbt_table_name_logs_global;
			$tableName = $wpdb->prefix . $rbt_table_name_logs_global;
			$wpdb->query("TRUNCATE TABLE `".$tableName."`");
			
		}catch (PDOException $e) {
			RBlogToFile("RBT_Logs.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBlogToFile("RBT_Logs.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
