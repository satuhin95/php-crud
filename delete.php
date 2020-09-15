<?php
include 'database.php';

$id = base64_decode($_GET['id']);

$result = mysqli_query($db,"delete from students where id='$id' ");
if ($result) {
	header("location: view.php");
}