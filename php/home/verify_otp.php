<?php
require "config.php";

	$otpver = $_REQUEST['otpverify'];
	$mobile = $_REQUEST['mobile'];
	$response = array();
	
	/*$sql = "select * from otp_sent where phone like '".$mobile."' order by timestamp desc;";
	$result = mysqli_query($con, $sql);
	
	$n = mysqli_fetch_assoc($result);
	
	echo $n['otp'];
	$fetchedotp = $n['otp'];*/
	
	//if($fetchedotp == $otpver){
		$sql = "select * from user_info where phone like '".$mobile."';";
		$result = mysqli_query($con, $sql);
		if(mysqli_num_rows($result)>0){
			//Existing User
			$code = "existing";
			array_push($response, array("code"=>$code));
			echo json_encode($response);
		}else{
			//New User
			$code = "new";
			array_push($response, array("code"=>$code));
			echo json_encode($response);
		}
	/*}else{
		echo "Failed !!";
	}*/
	mysqli_close($con);
	
?>