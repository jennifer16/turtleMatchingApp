<?php
    session_start();
    require 'connect.php';

	$filename = $_POST['filename'];
	$side = $_POST['side'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

    $path_parts = pathinfo($filename);
    $exactName = $path_parts['filename'];

    $outputFile = "Output/".$exactName.".txt";

	if ($filename == "")
	{
		echo "Cannot run! Missing filename....";
	}else{


        $sql = "INSERT INTO matching (users_id, match_file, match_input, match_side, match_lat, match_lng) VALUES ('".$_SESSION['user_id']."','".$outputFile."','".$filename."','".$side."', '".$lat."', '".$lng."')";

        if (mysqli_query($conn, $sql)) {
            //echo $PID;
            shell_exec("python pushTurtleSubmit.py");


            $last_id = mysqli_insert_id($conn);
         header('Location: addMatchingDetail.php?id='.$last_id);
        }else{

        echo "Error: " . $sql . "<br>" . $conn->error;
            //header('Location: error.php');
        }



	}

?>
