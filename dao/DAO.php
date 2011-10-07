<?php

class Dao {

	public function openMantisConnection($MANTIS_DB_SERVER,$MANTIS_DB_USER,$MANTIS_DB_PASS,$MANTIS_DB_DATABASE) {
		//Mantis Database Connection
		mysql_connect($MANTIS_DB_SERVER,$MANTIS_DB_USER,$MANTIS_DB_PASS);
		@mysql_select_db($MANTIS_DB_DATABASE) or die( "Unable to select database");
		//only after conection
		mysql_query("SET NAMES 'utf8'");
	
	}
	
	public function CloseMysqlConnection() {
	mysql_close();
	}

	public function SelectUser($USER_LEVEL) {
			
		$sql="SELECT * FROM mantis_user_table WHERE enabled='1' AND access_level>='$USER_LEVEL' ORDER BY username";
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
									
		//return result to main program
		return $result;
	
	}

	public function UserName($userid) {
			
		$sql="SELECT * FROM mantis_user_table WHERE id=$userid";
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
									
		//return result to main program
		return $result;
	
	}

	public function ProjectAvailable() {
			
		$sql="SELECT * FROM mantis_project_table WHERE enabled='1' ORDER BY name";
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
									
		//return result to main program
		return $result;
	
	}
	
	public function CategoryAvailable() {
			
		$sql="SELECT * FROM mantis_category_table ORDER BY name";
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
									
		//return result to main program
		return $result;
	
	}	

	public function Package($PACKAGE_ID) {
			
		$sql="SELECT * FROM mantis_custom_field_table where id=$PACKAGE_ID";
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
									
		//return result to main program
		return $result;
	
	}

		public function Create_mantis_bug_text_table($description) {
			
		$sql='INSERT into mantis_bug_text_table (description) values ("'.$description.'")';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
		//Get values
		$id_text=mysql_insert_id();
									
		//return result to main program
		return $id_text;
	
	}

		public function Create_mantis_bug_table($project_id,$user_id,$summary,$category_id,$id_text,$UTS_DATE) {
			
		$sql='INSERT into mantis_bug_table (project_id, reporter_id, handler_id, status, summary, category_id, bug_text_id, date_submitted, last_updated) values ("'.$project_id.'", "'.$user_id.'", "'.$user_id.'", "90", "'.$summary.'", "'.$category_id.'", "'.$id_text.'", "'.$UTS_DATE.'" , "'.$UTS_DATE.'"  )';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
		//Get values
		$bug_id=mysql_insert_id();
									
		//return result to main program
		return $bug_id;
	
	}	

		public function Create_mantis_custom_field_string_table($project_id,$user_id,$summary,$category_id,$id_text,$UTS_DATE) {
			
		$sql='INSERT into mantis_custom_field_string_table (field_id, bug_id, value) values ("1", "'.$bug_id.'", "'.$units.'")';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
		//Get values
		$bug_id=mysql_insert_id();
									
		//return result to main program
		return $bug_id;
	
	}

		public function Create_mantis_custom_field_string_table_billable($PACKAGE_ID,$bug_id,$billable) {
			
		$sql='INSERT into mantis_custom_field_string_table (field_id, bug_id, value) values ("'.$PACKAGE_ID.'", "'.$bug_id.'", "'.$billable.'")';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);
		//Get values
		$bug_id=mysql_insert_id();
									
		//return result to main program
		return $bug_id;
	
	}

		public function Create_mantis_bug_history_table($user_id,$bug_id,$Time_consumed_custom_title,$units,$UTS_DATE) {
			
		$sql='INSERT into mantis_bug_history_table (user_id, bug_id, field_name, old_value, new_value, date_modified) values ("'.$user_id.'", "'.$bug_id.'", "'.$Time_consumed_custom_title.'", "0", "'.$units.'", "'.$UTS_DATE.'")';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);

									
		//return result to main program
		return $result;
	
	}

		public function Create_mantis_bug_history_table_billable($user_id,$bug_id,$Billable_to_project_text,$billable,$UTS_DATE) {
			
		$sql='INSERT into mantis_bug_history_table (user_id, bug_id, field_name, new_value, date_modified) values ("'.$user_id.'", "'.$bug_id.'", "'.$Billable_to_project_text.'", "'.$billable.'", "'.$UTS_DATE.'")';
		
		//echo "SQL = $sql<br>"; //debug
		
		//Get values
		$result=mysql_query($sql);

									
		//return result to main program
		return $result;
	
	}



}	



?>
