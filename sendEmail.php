<?php
	$strTo = "pantuwong@gmail.com";
	$strSubject = $_POST['subject'];
	$strHeader = "From: ".$_POST['email'];
	$strMessage = "ข้อความจาก ".$_POST['name']."\n หมายเลขโทรศัพท์ ".$_POST['mobile']."\n".$_POST['message'];
	mail("pantuwong@gmail.com","My subject",$msg);
?>