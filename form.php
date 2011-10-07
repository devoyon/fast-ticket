<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_start();
header('Content-type: text/html; charset=UTF-8');  
include ('./config/config_inc.php');
include_once './dao/DAO.php';

//######################################"
//Create Session or use an existing one.
//######################################"
if(isset($_SESSION['id'])) {
  $userid=$_SESSION['id'];
}
else{
$userid=$_POST['id'];
$_SESSION['id']=$userid;
}

//######################################
// instance of Dao
//######################################
$aDao = new Dao();

//######################################
// open Database connection
//######################################
$aDao->openMantisConnection($g_hostname,$g_db_username,$g_db_password ,$g_database_name);


//######################################"
// Search username
//#######################################"
$result =  $aDao->UserName($userid);
$user_name=mysql_result($result,0,"username");

echo '<h1>Create ticket for '.$user_name.'</h1>
<a href="reset.php">Reset user</a><hr>';

//######################################
// start fo the form
//######################################
echo '<form method="post" action="Create_ticket.php" >';

//######################################"
// Create date
//#######################################"
$MONTH=date('m');
$DAY=date('d');
$YEAR=date('Y');
echo '<b>Select Day / Month :  </b>';
echo '<select name="day" >';
echo '<option value='.$DAY.'>'.$DAY.'</option>';
$i=1;
while ($i < 31) {

	echo '<option value='.$i.'>'.$i.'</option>';
	$i++;
}

echo '</select>';
echo '<b> / </b>';
echo '<select name="month" >';
echo '<option value='.$MONTH.'>'.$MONTH.'</option>';
$i=1;
while ($i < 12) {

	echo '<option value='.$i.'>'.$i.'</option>';
	$i++;
}
echo '</select><b> / '.$YEAR.'</b><br><br>';

//######################################"
// Select all project available
//#######################################"
$result =  $aDao->ProjectAvailable();

$num=mysql_numrows($result); //number of result returned by the mysql request
echo '<b>Select a project : </b>';
echo '<select name="project_id" >';

//#######################################
//pass on all mysql return
//#######################################
$i=0;
while ($i < $num) {
	$id=mysql_result($result,$i,"id");
	$name=mysql_result($result,$i,"name");	
	echo '<option value='.$id.'>'.$name.'</option>';
	$i++;
}

echo '</select><br><br>';


//######################################"
// Select all categories available
//#######################################"
$result =  $aDao->CategoryAvailable();

$num=mysql_numrows($result); //number of result returned by the mysql request
echo '<b>Select a category : </b>';
echo '<select name="category_id" >';

//pass on all mysql return
$i=0;
while ($i < $num) {
	$id=mysql_result($result,$i,"id");
	$name=mysql_result($result,$i,"name");	
	echo '<option value='.$id.'>'.$name.'</option>';
	$i++;
}

echo '</select><br><br>';

//######################################"
// Select all packages custom fields
//#######################################"
$result =  $aDao->Package($PACKAGE_ID);
$POSSIBLE_VALUES=mysql_result($result,0,"possible_values");
$PACKAGE=explode('|', $POSSIBLE_VALUES);


echo '<b>Billable by project ? : </b>';
echo '<select name="billable" >';
foreach ($PACKAGE as $valeur){
	echo '<option value="'.$valeur.'">'.$valeur.'</option>';
	
}
echo '</select><br><br>';


//######################################"
// Title
//#######################################"

echo '<b>Title: </b>';
echo '<input tabindex="10" type="text" name="summary" size="105" maxlength="128" value="" /><br> ';

//######################################"
// Description
//#######################################"

echo '<b>Description: </b><br>';
echo '<textarea tabindex="11" name="description" cols="80" rows="10"></textarea><br>  ';



//######################################"
// Unit numbers consumed
//#######################################"

echo '<b>How many units consumed (10 = 1 day): </b>';
echo '<input type="text" name="units" size="7" value="1">';


echo '<hr><center><input type="submit" value="Submit" onClick="Message()"> </center>';
echo '</form>';
 

//######################################"
// A small popup with no control to be change in future version..
//#######################################"
echo '<SCRIPT language=javascript>
   function Message() {
       alert("'.$ALERT.'")
   }
</SCRIPT>';


echo '<a href="'.$PILOT_URL.'">'.$PILOT_URL_TEXT.'</a><br>';
echo '<a href="'.$MANTIS_URL.'">'.$MANTIS_URL_TEXT.'</a><br><br>';


//######################################
// Close Mysql connection
//###################################### 
$aDao->CloseMysqlConnection();

echo "Version : $VERSION<br><i>$REFERENCE</i>";

?>
