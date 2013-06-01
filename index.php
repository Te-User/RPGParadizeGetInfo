<?php
	session_start();
	require_once("functions.v4r.php");
	echo $Server->Name;
	echo $Server->Position;
	echo $Server->Vote;
	echo $Server->ClicOut;
	// ...
?>