<?php

$name = $_POST['name'];
$mobile_number = $_POST['mobile_number'];
$occupation = $_POST['occupation'];
$locations = $_POST['locations'];


$conn = new mysqli('localhost','root','','userspice');
		
		$sql = "INSERT INTO services (Name, Mobile_Number, Occupation, Location)
				VALUES ('$name', '$mobile_number', '$occupation', '$locations')";
		$conn->query($sql);


?>