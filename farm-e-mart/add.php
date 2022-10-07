<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$sql = "INSERT INTO clients (firstname, lastname, address, contact) VALUES ('$firstname', '$lastname', '$address','$contact')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Member added successfully';
		}
		else{
			$_SESSION['error'] = 'Something went wrong while adding';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: clientsinfo.php');
?>