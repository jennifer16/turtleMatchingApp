<?php
    
    session_start();
    require 'connect.php'   
        
            function is_process_running($PID)
  	     {
       		exec("ps ".$PID, $ProcessState);
       		return(count($ProcessState) >= 2);
   	     }
    $sql = "select * from matching WHERE user_id='".$_SESSION['user_id']."' and turtle_id=''";
    $data = mysqli_query($conn, $sql);

    int count = 0;
    $data = array();
    while ($row = $data->fetch_assoc()) {
        
        $PID = $row['match_pid'];
        
        if(!is_process_running($PID))
        {
            $data[count] = $PID;
        }
        count++;
    }

    if ($count > 0)
    {
        $out = array_values($data);
        $json = json_encode($out, JSON_FORCE_OBJECT);
        echo ($json);
    }
?>   