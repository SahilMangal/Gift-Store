<?php 
	session_start();
	unset($_SESSION["giftStoreAdmin"]);
	unset($_SESSION["customer"]);
	header("Location: index.php");
?>