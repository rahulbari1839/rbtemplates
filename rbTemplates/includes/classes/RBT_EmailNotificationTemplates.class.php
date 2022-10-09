<?php 

class RBT_EmailNotificationTemplates {
	
	var $id;
	var $template_name;
	var $from_name;
	var $type;
	var $from_email;
	var $subject;
	var $body;
	var $date;
	var $send_copy;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getFromName() {
		return $this->from_name;
	}
	function setFromName($o) {
		$this->from_name = $o;
	}
	
	function getFromEmail() {
		return $this->from_email;
	}
	function setFromEmail($o) {
		$this->from_email = $o;
	}
	
	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}
	function getSubject() {
		return $this->subject;
	}
	function setSubject($o) {
		$this->subject = $o;
	}
	function getBody() {
		return $this->body;
	}
	function setBody($o) {
		$this->body = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}


	function getSendCopy() {
		return $this->send_copy;
	}
	
	function setSendCopy($o) {
		$this->send_copy = $o;
	}

	function getTemplateName() {
		return $this->template_name;
	}
	
	function setTemplateName($o) {
		$this->template_name = $o;
	}
	
	
	
	
	
	
	public function create(){
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$data = array(
				'template_name'=> $this->getTemplateName(),
				'from_name'=> $this->getFromName(),
				'from_email'=> $this->getFromEmail(),
				'type'=> $this->getType(),
				'send_copy'=> $this->getSendCopy(),
				'subject'=> $this->getSubject(),
				'body'=> $this->getBody(),				
			);
			 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: create,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: create , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
	public function update(){
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$data = array(
				'template_name'=> $this->getTemplateName(),
				'from_name'=> $this->getFromName(),
				'from_email'=> $this->getFromEmail(),
				'type'=> $this->getType(),
				'send_copy'=> $this->getSendCopy(),
				'subject'=> $this->getSubject(),
				'body'=> $this->getBody(),	
			); 
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: update,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: update , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			if(isset($row)){		
				$data = new RBT_EmailNotificationTemplates();
				
				$data->setId($row['id']);
				$data->setFromName($row['from_name']);
				$data->setFromEmail($row['from_email']);
				$data->setType($row['type']);
				$data->setSendCopy($row['send_copy']);
				$data->setSubject($row['subject']);
				$data->setBody($row['body']);
				$data->setTemplateName($row['template_name']);
				$data->setDate($row['date']);
				
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}

	public static function loadByType($type = '') {
		 
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$sql = "SELECT * FROM " . $tableName . " WHERE `type` ='".$type."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){			
					$obj = new RBT_EmailNotificationTemplates();
					$obj->setId($row['id']);
					$obj->setFromName($row['from_name']);
					$obj->setFromEmail($row['from_email']);
					$obj->setType($row['type']);
					$obj->setSendCopy($row['send_copy']);
					$obj->setSubject($row['subject']);
					$obj->setBody($row['body']);
					$obj->setTemplateName($row['template_name']);
					$obj->setDate($row['date']);
					$data[] = $obj;
				}				
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: loadById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: loadById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){		
					$obj = new RBT_EmailNotificationTemplates();
					$obj->setId($row['id']);
					$obj->setFromName($row['from_name']);
					$obj->setFromEmail($row['from_email']);
					$obj->setType($row['type']);
					$obj->setSendCopy($row['send_copy']);
					$obj->setSubject($row['subject']);
					$obj->setBody($row['body']);
					$obj->setTemplateName($row['template_name']);
					$obj->setDate($row['date']);
					$data[] =  $obj;
				}
			}
			
			return $data;
		 
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: load,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: load , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	public static function deleteById($id = 0) {
		
		try {
			global $wpdb, $rbt_table_email_notification_templates_global;
			$tableName = $wpdb->prefix . $rbt_table_email_notification_templates_global;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
			
		}catch (PDOException $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: deleteById,  ".$e->getMessage(), RBT_ERROR_LOG);
		} catch (Exception $e) {
			RBTlogToFile("RBT_EmailNotificationTemplates.php: deleteById , Error is".$e->getMessage(), RBT_ERROR_LOG);
		}
	}
	
	
}	
	
	
	
	
	
