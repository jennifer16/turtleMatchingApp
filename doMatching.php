<?php
    session_start();
    require 'connect.php';
	
    $matchId = $_GET['match_id'];
    $sql = "SELECT * from matching where id='".$matchId."'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    
    $matchSide = $row['match_side'];
    $matchOut = $row['match_file'];
    $filename = "./Turtle/".$matchId."_match.png";


    echo "Mathcing with ".$matchSide." side.<br>";
    $PID = shell_exec("nohup sudo python demoTurtleMatching.py ".$filename." ".$matchSide." 2>&1 | tee ".$matchOut." 2>/dev/null >/dev/null & echo $!");

    echo "<br>";
    echo "Running";
        
     $sql = "UPDATE matching set match_pid='".$PID."' WHERE id='".$matchId."';";

        if (mysqli_query($conn, $sql)) {
            //echo $PID;
         header('Location: ongoing.php');
        }else{
            
        echo "Error: " . $sql . "<br>" . $conn->error;
            //header('Location: error.php');
        }
        

        
	

?>


