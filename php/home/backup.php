<?php 

require "config.php";
date_default_timezone_set('Asia/Kolkata');

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$password = $_REQUEST['password'];
$address = $_REQUEST['address'];
$device = $_REQUEST['device'];
$dob = $_REQUEST['dob'];
$response = array();

$sql = "select * from user_info where email like '".$email."' or phone like '".$phone."';";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){
	$code = "reg_failed";
	$message = "User already exists, Please try another details !!";

	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}else if(empty($phone)){
	$code = "reg_failed";
	$message = "Registration Failed, Empty details !!";

	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}else{
	$sql = "insert into user_info (name, email, phone, address, password, dob, device) values ('$name','$email','$phone','$address','$password', '$dob', '$device')";
	$result = mysqli_query($con, $sql);
	$code = "reg_success";
	$message = "Registration Successfull..!!";
	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}
mysqli_close($con);

?>