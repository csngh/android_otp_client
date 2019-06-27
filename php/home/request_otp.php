<?php

require "config.php";
$otp = rand(100000, 999999);

	$response = array();
	// echo $_POST['mobile'];
	if (isset($_POST['mobile']) && $_POST['mobile'] != '') {

		$mobile = $_POST['mobile'];

			$ms=$mobile."OTP";
			
			$code = "success";
			$message = "Your otp is: ".$otp;
			array_push($response, array("code"=>$code, "message"=>$message, "otp"=>$otp));
			
			$sql = "insert into otp_sent (phone, otp) values ('$mobile', '$otp');";
			mysqli_query($con, $sql);
		   
	} else {
		$code = "failed";
		$message = "Error please try again !!";
		array_push($response, array("code"=>$code, "message"=>$message));
	}
	echo json_encode($response);
	mysqli_close($con);
	
?>