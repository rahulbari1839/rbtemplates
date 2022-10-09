<?php

//install tables
function RBTCreateTables() {
	global  $wpdb,
	$rbt_table_name_users_info_global,
	$rbt_table_name_fields_global,
	$rbt_table_name_logs_global,
	$rbt_table_name_form_global,
	$rbt_table_name_data_name_value_pair_global,
	$rbt_table_name_messages_name_value_pair_global,
	$rbt_table_email_notification_templates_global,
	$rbt_table_email_notification_send_global;

    $rbt_table_name_users_info = $wpdb->prefix . $rbt_table_name_users_info_global;
    $rbt_table_name_fields = $wpdb->prefix . $rbt_table_name_fields_global;
    $rbt_table_name_logs = $wpdb->prefix . $rbt_table_name_logs_global;
    $rbt_table_name_form = $wpdb->prefix . $rbt_table_name_form_global;
    $rbt_table_name_data_name_value_pair = $wpdb->prefix . $rbt_table_name_data_name_value_pair_global;
    $rbt_table_name_messages_name_value_pair = $wpdb->prefix . $rbt_table_name_messages_name_value_pair_global;
    $rbt_table_email_notification_templates = $wpdb->prefix . $rbt_table_email_notification_templates_global;
    $rbt_table_email_notification_send = $wpdb->prefix . $rbt_table_email_notification_send_global;
   
    $charset_collate = $wpdb->get_charset_collate();

    try {

		$rbt_table_name_logs_sqb = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_logs . " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`log` text NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_logs_sqb); 
	}
	catch (PDOException $e) {
		echo ("install.php: table exists: ".$e->getMessage());
		die;
	} catch (Exception $e) {
		echo ("install.php: exception(), Error is".$e->getMessage());
		die;
	}

try{
		
		$rbt_table_name_users_info_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_users_info . " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(255) NULL DEFAULT NULL,
			`email` VARCHAR(255) NULL DEFAULT NULL,
			`type` VARCHAR(255) NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_users_info_sql); 
		
	}
	catch (PDOException $e) {
		RBlogToFile("install.php: table exists: ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBlogToFile("install.php: exception(), Error is".$e->getMessage(), RBT_ERROR_LOG);
	}
	
	try{
		
		$rbt_table_name_form_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_form . " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(255) NOT NULL,
			`type` VARCHAR(255) NULL DEFAULT NULL,
			`display_type` VARCHAR(255) NULL DEFAULT NULL,
			`html` BLOB NULL DEFAULT NULL,
			`html2` text NULL DEFAULT NULL,
			`customizer_values` VARCHAR(255) NULL DEFAULT NULL,
			`template_no` VARCHAR(255) NULL DEFAULT NULL,
			`email_template_id` INT(11) NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_form_sql); 
	}
	catch (PDOException $e) {
		RBlogToFile("install.php: table exists: ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBlogToFile("install.php: exception(), Error is".$e->getMessage(), RBT_ERROR_LOG);
	}
	
	try{
		
		$rbt_table_name_fields_sqb = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_fields . " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(200) NOT NULL UNIQUE,
			`type` VARCHAR(255) NOT NULL,
			`value` VARCHAR(255) NULL DEFAULT NULL,
			`label` VARCHAR(255) NULL DEFAULT NULL,
			`placeholder` VARCHAR(255) NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`is_required` char(1) NULL DEFAULT NULL,
			`required_msg` VARCHAR(255) NULL DEFAULT NULL,
			`created_by` VARCHAR(255) NULL DEFAULT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_fields_sqb); 
	}
	catch (PDOException $e) {
		RBTlogToFile("install.php: table exists: ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: exception(), Error is".$e->getMessage(), RBT_ERROR_LOG);
	}

	 $default_fields = array();
	 $field_info = array();
	 $field_info['name']   =  'name';
	 $field_info['type']   =  'text';
	 $field_info['label']  =  'Name';
	 $field_info['value']   =  '';
	 $field_info['placeholder']   =  'Enter your name';
	 $field_info['is_required']   =  1;
	 $field_info['required_msg']   =  'Enter your name';
	 $field_info['created_by']   =  'default';
	 $default_fields[] = $field_info;

	 $field_info = array();
	 $field_info['name']   =  'email';
	 $field_info['type']   =  'email';
	 $field_info['label']  =  'Email';
	 $field_info['value']   =  '';
	 $field_info['placeholder']   =  'Enter your email';
	 $field_info['is_required']   =  1;
	 $field_info['required_msg']   =  'Enter your email';
	 $field_info['created_by']   =  'default';
	 $default_fields[] = $field_info;

	 $field_info = array();
	 $field_info['name']   =  'password';
	 $field_info['type']   =  'password';
	 $field_info['label']  =  'Password';
	 $field_info['value']   =  '';
	 $field_info['placeholder']   =  'Enter your password';
	 $field_info['is_required']   =  1;
	 $field_info['required_msg']   =  'Enter your password';
	 $field_info['created_by']   =  'default';
	 $default_fields[] = $field_info;

	try {
	
            foreach($default_fields as  $field_info){
            	if(isset($field_info['name'])){
					$checkFieldNameExist = RBT_Fields::loadByFieldName($field_info['name']);
					if(!isset($checkFieldNameExist)){
						$field_obj = new RBT_Fields();
						$field_obj->setName($field_info['name']);
						$field_obj->setType($field_info['type']);
						$field_obj->setLabel($field_info['label']);
						$field_obj->setValue($field_info['value']);
						$field_obj->setPlaceholder($field_info['placeholder']);
						//$field_obj->setDate($field_info['date']);
						$field_obj->setIsRequired($field_info['is_required']);
						$field_obj->setRequiredMsg($field_info['required_msg']);
						$field_obj->setCreatedBy($field_info['created_by']);
						$field_obj->create();
					}
				}
             }
        }
	catch (PDOException $e) {
		RBTlogToFile("install.php: set defalut field value: ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: set defalut field value:", RBT_ERROR_LOG);
	}



	try {

		$rbt_table_name_data_name_value_pair_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_data_name_value_pair. " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`parent_id` INT(11)  NULL DEFAULT NULL,
			`name` varchar(255) NULL DEFAULT NULL,
			`type` varchar(255) NULL DEFAULT NULL,
			`data_type` varchar(255) NULL DEFAULT NULL,
			`value` longtext NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_data_name_value_pair_sql); 
	}
	catch (PDOException $e) {
			RBTlogToFile("install.php: Create table: ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: Create table:", RBT_ERROR_LOG);
		
	}

	try {

		$rbt_table_name_messages_name_value_pair_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_name_messages_name_value_pair. " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) NULL DEFAULT NULL,
			`type` varchar(255) NULL DEFAULT NULL,
			`value` text NULL DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_name_messages_name_value_pair_sql); 
	}
	catch (PDOException $e) {
			RBTlogToFile("install.php: Create table : ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: Create table:", RBT_ERROR_LOG);
		
	}

	try {

		$rbt_table_email_notification_templates_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_email_notification_templates. " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`email_template_id` INT(11) NULL DEFAULT NULL,
			`template_name` varchar(255) NULL DEFAULT NULL,
			`type` varchar(255) NULL DEFAULT NULL,
			`from_email` varchar(255) NULL DEFAULT NULL,
			`from_name` varchar(255) DEFAULT NULL,
			`send_copy` char(1) DEFAULT NULL,
			`subject` text NOT NULL,
			`body` longtext NOT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($rbt_table_email_notification_templates_sql); 
	}
	catch (PDOException $e) {
			RBTlogToFile("install.php: Create table : ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: Create table:", RBT_ERROR_LOG);
		
	}

	try {
     
		$rbt_table_email_notification_send_sql = "CREATE TABLE IF NOT EXISTS " . $rbt_table_email_notification_send. " (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`type` varchar(255) NULL DEFAULT NULL,
			`email_template_id` INT(11) NOT NULL DEFAULT 0,
			`send_to` varchar(255) NULL DEFAULT NULL,
			`subject` text NOT NULL,
			`body` longtext NOT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
		  
			$wpdb->query($rbt_table_email_notification_send_sql); 

	}
	catch (PDOException $e) {
			RBTlogToFile("install.php: Create table : ".$e->getMessage(), RBT_ERROR_LOG);
	} catch (Exception $e) {
		RBTlogToFile("install.php: Create table:", RBT_ERROR_LOG);
		
	}
}