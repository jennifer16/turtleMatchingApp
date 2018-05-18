<?php
    session_start();
    require 'connect.php';
	
	$filename = $_GET['filename'];
	$side = $_GET['side'];

    $path_parts = pathinfo($filename);
    $exactName = $path_parts['filename'];
                           
    $outputFile = "Output/".$exactName.".txt";
	
	if ($filename == "")
	{
		echo "Cannot run! Missing filename....";	
	}else{
		
		echo "Mathcing with ".$side." side.<br>";
		$PID = shell_exec("nohup python demoTurtleMatching.py ".$filename." ".$side." 2>&1 | tee Output/".$exactName.".txt 2>/dev/null >/dev/null & echo $!");
        
        
        echo "Running";
        
        
        $sql = "INSERT INTO matching (user_id, match_file, match_input, match_pid) VALUES ('".$_SESSION['user_id']."','".$outputFile."','".$filename."','".$PID."')";
        
        if (mysqli_query($conn, $sql)) {
            
            header('Location: ongoing.php');
        }else
            header('Location: error.php');
        }
        

        
	}

?>
