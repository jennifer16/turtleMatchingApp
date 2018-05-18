<?php

    session_start();
    require 'connect.php'
    
    $id = $_GET['id']
    $sql = "select * from matching where id='".$id."'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

    $outputFile = $row['match_file']''
    
    $myfile = fopen($outputFile, "r") or die("Unable to open file!");

		while(!feof($myfile)) {
  			$line = fgets($myfile);

			if ($line[0] != "$")
				continue;

			$data = explode(",", $line);
			$fname = ltrim($data[0],'$');
			$score = $data[1];
			$side = $data[0][0];
			
			if ($side == 'R')
				echo $filname." is matched with ".$fname." with score of ".$score." % (Right side). <a href='Output/".$filename."-".$fname."V_RIGHT.PNG'>Click to see matching image</a><br>";
			else
				echo $filname." is matched with ".$fname." with score of ".$score." % (Left side). <a href='Output/".$filename."-".$fname."V_LEFT.PNG'>Click to see matching image</a><br>";
		}
		fclose($myfile);
?>