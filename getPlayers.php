<?php
  $conn = new mysqli("classroom.cs.unc.edu","patelr1","comp426Group","patelr1db");

  $QBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'QB' ORDER BY CPP";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($QBs, $player);
    }
  mysqli_free_result($Result);
  }

  echo sizof($QBs);
?>
