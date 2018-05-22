<?php
    function is_process_running($PID)
    {
       		exec("ps ".$PID, $ProcessState);
       		return(count($ProcessState) >= 2);
     }
?>

<?php
    
    session_start();
    require 'connect.php'; 
        

    $sql = "select * from matching WHERE users_id='".$_SESSION['user_id']."' and turtle_id is NULL";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            
            if( !is_process_running($row['match_pid']) )
                $count++;
        }
        
        if ($count>0)
            echo "1";
    
        else
            echo "0";
    }
?>   