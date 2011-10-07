<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_start();
header('Content-type: text/html; charset=UTF-8');  
include ('./config/config_inc.php');
include_once './dao/DAO.php';

//######################################
// instance of Dao
//######################################
$aDao = new Dao();

//######################################
// open Database connection
//######################################
$aDao->openMantisConnection($g_hostname,$g_db_username,$g_db_password ,$g_database_name);


//######################################"
// Get values from formula
//#######################################"
$project_id=$_POST['project_id'];
$user_id=$_SESSION['id'];
$category_id=$_POST['category_id'];
$summary=$_POST['summary'];
$description=$_POST['description'];
$units=$_POST['units'];
$billable=$_POST['billable'];
$YEAR=date('Y');
$MONTH=$_POST['month'];
$DAY=$_POST['day'];


//time
$UTS_DATE=mktime(0, 0, 0, $MONTH, $DAY, $YEAR);


//######################################"
// Create Ticket on mantis_bug_text_table
//#######################################"
$id_text=$aDao->Create_mantis_bug_text_table($description);

//######################################"
// Create Ticket on mantis_bug_table
//#######################################"
$bug_id=$aDao->Create_mantis_bug_table($project_id,$user_id,$summary,$category_id,$id_text,$UTS_DATE);

//######################################"
// Insert Units on mantis_custom_field_string_table
//#######################################"
$aDao->Create_mantis_custom_field_string_table($bug_id,$units);

//######################################"
// Insert billable on mantis_custom_field_string_table
//#######################################"
$aDao->Create_mantis_custom_field_string_table_billable($PACKAGE_ID,$bug_id,$billable);

//######################################"
// Insert Units on mantis_bug_history_table
//#######################################"
$aDao->Create_mantis_bug_history_table($user_id,$bug_id,$Time_consumed_custom_title,$units,$UTS_DATE);


//######################################"
// Insert Billable on mantis_bug_history_table
//#######################################"
$aDao->Create_mantis_bug_history_table_billable($user_id,$bug_id,$Billable_to_project_text,$billable,$UTS_DATE);

//######################################
// Close Mysql connection
//###################################### 
$aDao->CloseMysqlConnection();



header('Location: form.php'); 




?>
