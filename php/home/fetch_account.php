<?php
	
	require "config.php";
	
	$mobile = $_REQUEST['mobile'];
	$response = array();
	
	$sql = "select * from user_info where phone like '".$mobile."'";
	
	$result = mysqli_query($con, $sql);
	
	if(mysqli_num_rows($result)>0){
		$data = mysqli_fetch_assoc($result);
		
		$response['name'] = $data['name'];
		$response['phone'] = $data['phone'];
		$response['email'] = $data['email'];
		$response['dob'] = $data['dob'];
		$response['address'] = $data['address'];
		$response['device'] = $data['device'];
		$response['datestamp'] = $data['datestamp'];
		
		echo json_encode($response);
	}else{
		echo "Error";
	}

?>