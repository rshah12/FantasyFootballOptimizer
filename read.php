<?php


// echo 'Current PHP version: ' . phpversion();
// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
//
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($fileType != "txt") {
//     echo "Sorry, only .txt files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
//   }
include("lineup.php");

$data = array();
if(isset($_GET['files']))
{
	$error = false;
	$files = array();
	$uploaddir = './uploads/';
    $target_file = $uploaddir . basename($_FILES["fileToUpload"]["name"]);
    echo $target_file;
	foreach($_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		{
			$files[] = $uploaddir .$file['name'];
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
	$data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
echo json_encode($data);



  date_default_timezone_set('America/New_York');
  $conn = new mysqli("classroom.cs.unc.edu","patelr1","comp426Group","patelr1db");

  $conn->query("DROP TABLE IF EXISTS ppool");
  $conn->query("DROP TABLE IF EXISTS averages");

  $Query = "CREATE TABLE ppool(
    pid int NOT NULL AUTO_INCREMENT,
    fname varchar(255),
    lname varchar(255),
    pos varchar(2),
    team varchar(3),
    opponent varchar(3),
    projection decimal(4,2),
    salary int,
    cpp int,
    PRIMARY KEY (pid)
  );";
  $conn->query($Query);

  $Query = "CREATE TABLE averages(
    pos varchar(2),
    avg int,
    PRIMARY KEY (pos)
  );";
  $conn->query($Query);

  $file = fopen('./uploads/projections.txt',"r");

  while(!feof($file)){
    $line = fgets($file);
    $parsed = preg_split('/[\s,]/',$line);
    $array = array_map(function($val){return $val != null ? $val : NULL;}, $parsed);

    if(count($array)>7){
     array_pop($array);
    } else{
     if(count($parsed)<2){
       continue;
     }
     array_push($array, NULL);
    }

    list($fname, $lname, $pos, $team, $opponent, $projection, $salary, $cpp) = $array;

    $Query = "INSERT INTO ppool(fname, lname, pos, team, opponent, projection, salary, cpp) VALUES ('$fname', '$lname', '$pos', '$team', '$opponent', $projection, $salary, $cpp)";
    $conn->query($Query);
  }

  $getAvgs = "INSERT INTO averages SELECT pos, AVG(cpp) FROM ppool GROUP BY pos";
  $conn->query($getAvgs);



	  $QBs = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'QB' AND cpp < (SELECT avg from averages WHERE pos = 'QB') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($QBs, $player);
	    }
	  mysqli_free_result($Result);
	  }

	//pass array to javascript

	echo json_encode($QBs);

	?>

	<script type="text/javascript">var quarterbacks =<?php echo json_encode($QBs);?>;

	for(var i = 0; i<quarterbacks.length; i++){
		alert(quarterbacks[i]);
	}

	</script>
	<script type="text/javascript" src="updateDOM.js"></script>

	<?php

	  $RBs = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'RB' AND cpp < (SELECT avg from averages WHERE pos = 'RB') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($RBs, $player);
	    }
	  mysqli_free_result($Result);
	  }

	  $WRs = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'WR' AND cpp < (SELECT avg from averages WHERE pos = 'WR') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($WRs, $player);
	    }
	  mysqli_free_result($Result);
	  }

	  $TEs = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'TE' AND cpp < (SELECT avg from averages WHERE pos = 'TE') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($TEs, $player);
	    }
	  mysqli_free_result($Result);
	  }

	  $Ds = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'D' AND cpp < (SELECT avg from averages WHERE pos = 'D') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($Ds, $player);
	    }
	  mysqli_free_result($Result);
	  }

	  $Ks = array();
	  $Query = "SELECT * FROM ppool WHERE pos = 'K' AND cpp < (SELECT avg from averages WHERE pos = 'K') ORDER BY cpp";
	  if ($Result=mysqli_query($conn,$Query)){
	    while ($obj=mysqli_fetch_object($Result)){
	      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
	      array_push($Ks, $player);
	    }
	  mysqli_free_result($Result);
	  }

  $conn->close();
  fclose($file);
  ?>
