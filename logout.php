<?php
	require 'db_connect.php';
	session_destroy();
	header('Location: index.php');
?>
