<?php
header('Content-type: text/html; charset=UTF-8');  
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_unset();


include ('./config/config_inc.php');
include_once './dao/DAO.php';

//######################################
// start fo the form
//######################################
echo '<form method="post" action="form.php">';

//######################################
// instance of Dao
//######################################
$aDao = new Dao();

//######################################
// open Database connection
//######################################
$aDao->openMantisConnection($g_hostname,$g_db_username,$g_db_password ,$g_database_name);

//######################################"
// Select all users 
//#######################################"
$result =  $aDao->SelectUser($USER_LEVEL);

//######################################
// Prepare the screen
//######################################
$num=mysql_numrows($result); //number of result returned by the mysql request
echo '<center><b>Select a user :<br><br> </b>';
echo '<select name="id" >';

//######################################
//pass on all mysql return
//######################################
$i=0;
while ($i < $num) {
	$id=mysql_result($result,$i,"id");
	$username=mysql_result($result,$i,"username");	
	echo '<option value="'.$id.'">'.$username.'</option>';
	$i++;
}

echo '</select><br></center>';



echo '<hr><center><input type="submit" value="Submit"> </center>';
echo '</form>';

//######################################
// Close Mysql connection
//###################################### 
$aDao->CloseMysqlConnection();


echo "Version : $VERSION<br><i>$REFERENCE</i>";



?>
