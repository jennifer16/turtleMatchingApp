<?php
    session_start();
    require 'connect.php';
	
    $matchId = $_GET['id'];
    $sql = "SELECT * from matching where id='".$matchId."'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    
    $matchSide = $row['match_side'];
    $matchOut = $row['match_file'];
    $filename = "./Turtle/".$matchId."_match.png";


    echo "Mathcing with ".$side." side.<br>";
    $PID = shell_exec("nohup python demoTurtleMatching.py ".$filename." ".$side." 2>&1 | tee Output/".$exactName.".txt 2>/dev/null >/dev/null & echo $!");
        
    echo "nohup python demoTurtleMatching.py ".$filename." ".$side." 2>&1 | tee Output/".$exactName.".txt 2>/dev/null >/dev/null & echo $!";
    echo "<br>";
    echo "Running";
        
     $sql = "UPDATE matching set match_pid='".$PID."' WHERE id='".$_POST['matchId']."';";

        if (mysqli_query($conn, $sql)) {
            //echo $PID;
         //header('Location: ongoing.php');
        }else{
            
        echo "Error: " . $sql . "<br>" . $conn->error;
            //header('Location: error.php');
        }
        

        
	

?>


