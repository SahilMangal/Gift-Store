<?php 
	session_start();
	unset($_SESSION["giftStoreAdmin"]);
	header("Location: index.php");
?>