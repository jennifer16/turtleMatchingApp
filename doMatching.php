<?php
  session_start();
  require 'connect.php';
  print_r($_POST);


?>

<?php
	function is_process_running($PID)
  	{
       		exec("ps ".$PID, $ProcessState);
       		return(count($ProcessState) >= 2);
   	}
	
	$fullname = $_POST['filename'];
	$side = $_POST['side'];
    
    $filename = pathinfo($fullname)['filename'];

	if ($filename == "")
	{
		echo "Cannot run! Missing filename....";	
	}else{
		
		echo "Mathcing with ".$side." side.<br>";
		$PID = shell_exec("nohup python demoTurtleMatching.py ".fullname." ".$side." 2>&1 | tee Output/".$filename.".txt 2>/dev/null >/dev/null & echo $!");
		  		
		echo "running";
		$count = 0;
		while(is_process_running($PID))
  		 {
    			 echo(" . ");
    			   ob_flush(); flush();
          		  sleep(3);
			$count = $count+1;
			if ($count > 80 )
			{
				echo "<br>";
				$count = 0;	
			}
   		}
		echo "<br>Finish<br>";	

		$myfile = fopen("Output/".$filename.".txt", "r") or die("Unable to open file!");

		while(!feof($myfile)) {
  			$line = fgets($myfile);

			if ($line[0] != "$")
				continue;

			$data = explode(",", $line);
			$fname = ltrim($data[0],'$');
			$score = $data[1];
			$side = $data[0][0];
			
			if ($side == 'R')
				echo $filename." is matched with ".$fname." with score of ".$score." % (Right side). <a href='Output/".$filename."-".$fname."V_RIGHT.PNG'>Click to see matching image</a><br>";
			else
				echo $filename." is matched with ".$fname." with score of ".$score." % (Left side). <a href='Output/".$filename."-".$fname."V_LEFT.PNG'>Click to see matching image</a><br>";
		}
		fclose($myfile);

	
	}

?>
