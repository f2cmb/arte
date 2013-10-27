<?php
session_start();
	
if(isset($_GET['result'])) {
	$_SESSION['profile'] = $_GET['result'];
}else{
	header("bounce.php");
}
	
	
?>