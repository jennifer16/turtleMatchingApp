<?php

    session_start();
    require 'connect.php';
    
    $id = $_GET['id'];
    $sql = "select * from matching where id='".$id."'";
echo $sql;
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

    $outputFile = $row['match_file'];
    
    $myfile = fopen($outputFile, "r") or die("Unable to open file!");

		while(!feof($myfile)) {
  			$line = fgets($myfile);

			if ($line[0] != "$")
				continue;
            else:
                echo $line;
		}
		fclose($myfile);
?>