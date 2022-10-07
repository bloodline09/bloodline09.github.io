<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$sql = "UPDATE clients SET firstname = '$firstname', lastname = '$lastname', address = '$address', contact = $contact WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Member updated successfully';
		}
		else{
			$_SESSION['error'] = 'Something went wrong in updating member';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to edit first';
	}

	header('location: clientsinfo.php');

?>