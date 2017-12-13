<?php

if(empty($errors)==true){
    echo "test";
  move_uploaded_file($file_tmp,".../uploads/".$file_name);

if (isset($_FILES['file']['name'])) {
    if (0 < $_FILES['file']['error']) {
        echo 'Error during file upload' . $_FILES['file']['error'];
    } else {
        if (file_exists('uploads/' . $_FILES['file']['name'])) {
            echo 'File already exists : uploads/' . $_FILES['file']['name'];
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
            echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
        }
    }
} else {
    echo 'Please choose a file';
}


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
