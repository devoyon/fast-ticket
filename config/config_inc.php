<?php
	
	//database parameter
	//----------------------------
	$g_hostname = 'localhost';
	$g_db_type = 'mysql';
	$g_database_name = 'mantis_database';
	$g_db_username = 'mantis_User';
	$g_db_password = 'mantis_password';


	//Minimum level of users to be displayed (MantisBt levels)
	//----------------------------
	$USER_LEVEL='70';

	// Some task are associated to the project themself or to an other one
	// We use a custom field in mantisDB to "redirect" the time consumed on the task to an other project
	// This variable is the ID of this custom field in "mantis_custom_field_table" 
	// this field must be a list with the following format (configured directly in MantisBt) :
	//
	// 				<Name> (<ID of the project>) | <Name> (ID of the project)| ...
	// with : 
	//		Name : arbitrary name to be displayed (human readable)
	//		ID of the project : ID of the project on which we will associate the time consumed (ID from mantis_project_table)
	//----------------------------
	$PACKAGE_ID='6';

	//Name of the custom field associated to the time consumed in mantiBT
	$Time_consumed_custom_title="Time consumed";

	//name of the custom field associated to billed to the package or not
	$Billable_to_project_text="Package";

	//Message to be popuped up when a new ticket is createt
	//----------------------------
	$ALERT='Ticket created';
	
	// Urls for links in bottom of page 
	$MANTIS_URL='https://<URL>/mantis';
	$PILOT_URL='https://<URL>/mantis/Pilot/fast-ticket';
	//and text associated
	$MANTIS_URL_TEXT='Back to Mantis';
	$PILOT_URL_TEXT='Back to Pilot';

	$VERSION="Fast-Ticket 2.0";
	$REFERENCE="https://www.mantis-pilot.org";



?>
