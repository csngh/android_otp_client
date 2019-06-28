<?php 

require "config.php";

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$password = $_REQUEST['password'];
$address = $_REQUEST['address'];
$device = $_REQUEST['device'];
$dob = $_REQUEST['dob'];
$image = $_REQUEST['profilepic'];
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
	
	$profilepic = $phone.".jpg";
	$file_path = "profile/";
	$decodedImage = base64_decode($image);
	$return = file_put_contents($file_path.$profilepic, $decodedImage);
	
	ImageUpload($profilepic,$file_path.$profilepic,"profile/","jpg",$phone,"100");
	
	$sql = "insert into user_info (name, email, phone, profile_pic, address, password, dob, device) 
			values ('$name','$email','$phone', '$profilepic','$address','$password', '$dob', '$device')";
	$result = mysqli_query($con, $sql);
	$code = "reg_success";
	$message = "Registration Successfull, You can now login..!!";
	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}
mysqli_close($con);

function ImageUpload($image,$tmpimg,$folder,$extension,$sname,$widthweb){
	if($extension=="jpg" || $extension=="jpeg" )
	{
		$uploadedfile = $tmpimg;
		$src = imagecreatefromjpeg($uploadedfile);
	}else if($extension=="png"){
		$uploadedfile = $tmpimg;
		$src = imagecreatefrompng($uploadedfile);
	}else {
		$uploadedfile = $tmpimg;
		$src = imagecreatefromgif($uploadedfile);
	}
	//echo $scr;

	list($width,$height)=getimagesize($uploadedfile);
	$newwidth=$widthweb;
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $folder. $sname.".".$extension;

	imagejpeg($tmp,$filename,100);

	imagedestroy($src);
	imagedestroy($tmp);

	return 1;
}

?>