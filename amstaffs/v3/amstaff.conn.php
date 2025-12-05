<?php
	$conn = new mysqli('localhost', 'nkos_helentor', 'jH1ntbgbwcmup2LN', 'nkos_helentor');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>