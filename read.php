<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "txt") {
    echo "Sorry, only .txt files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  }
  ///
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

  $file = fopen($target_file,"r");

  while(!feof($file)){
    $line = fgets($file);
    $parsed = preg_split('/[\s,]+/',$line);
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

  $conn->close();
  fclose($file);
  ?>