<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script

foreach ($_REQUEST as $key => $value) {
	$$key = trim($value);
}

$myTask = new Task();

$err = 0;
$msg = "";

if ($action == "view") {

	
}


if ($action == "save") {
	
	$InputTaskName			= preg_replace("/[^a-zA-Z ]/","",$InputTaskName);
	$InputTaskDescription	= preg_replace("/[^a-zA-Z ]/","",$InputTaskDescription);
	
	if ($currentTaskId			== "") {$err++; $msg .= "problem with hidden id.<br>";}
	if ($InputTaskName     		== "") {$err++; $msg .= "Enter your Task ame.<br>";}
	if ($InputTaskDescription	== "") {$err++; $msg .= "Enter your Description.<br>";}
	
	
	if ($err == 0) {  // if there are no errors	
		
		$result = $myTask->Save($currentTaskId, $InputTaskName, $InputTaskDescription);
		
	}else {
		$result = $msg;
	}

	echo $result;
	

}

if ($action == "delete") {
	
	$currentTaskId		= preg_replace("/[^0-9 ]/", "", $currentTaskId);
	
	if ($currentTaskId	== "") {$err++; $msg .= "problem with hidden id.<br>";}	

	if ($err == 0) {  // if there are no errors	
		
		$result = $myTask->Delete($currentTaskId);
		echo $result;
	}else{
		echo $msg;	
	}
}

?>
