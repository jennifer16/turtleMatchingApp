<?php
	$strTo = "pantuwong@gmail.com";
	$strSubject = $_POST['subject'];
	$strHeader = "From: ".$_POST['email'];
	$strMessage = "ข้อความจาก ".$_POST['name']."\n หมายเลขโทรศัพท์ ".$_POST['mobile']."\n".$_POST['message'];
	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		header('Location: success.php');
	}
	else
	{
		header('Location: error.php');
	}
?>