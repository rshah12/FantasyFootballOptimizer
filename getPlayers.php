<?php
  include("lineup.php");

  $conn = new mysqli("classroom.cs.unc.edu","patelr1","comp426Group","patelr1db");

  $QBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'QB' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($QBs, $player);
    }
  mysqli_free_result($Result);
  }

  $RBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'RB' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($RBs, $player);
    }
  mysqli_free_result($Result);
  }

  $WRs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'WR' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($WRs, $player);
    }
  mysqli_free_result($Result);
  }

  $TEs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'TE' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($TEs, $player);
    }
  mysqli_free_result($Result);
  }

  $Ds = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'D' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($Ds, $player);
    }
  mysqli_free_result($Result);
  }

  $Ks = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'K' ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($Ks, $player);
    }
  mysqli_free_result($Result);
  }

  $Lineups = array();
  $maxLineups = 1000;
  $maxExposure = 50;

    foreach($QBs as $QB){
        if(sizeof($Lineups) >= $maxLineups){break;}
      foreach($RBs as $RB){
          if(sizeof($Lineups) >= $maxLineups){break;}
        foreach($RBs as $RB2){
            if(sizeof($Lineups) >= $maxLineups){break;}
          foreach($WRs as $WR){
              if(sizeof($Lineups) >= $maxLineups){break;}
            foreach($WRs as $WR2){
                if(sizeof($Lineups) >= $maxLineups){break;}
              foreach($WRs as $WR3){
                  if(sizeof($Lineups) >= $maxLineups){break;}
                foreach($TEs as $TE){
                    if(sizeof($Lineups) >= $maxLineups){break;}
                  foreach($Ks as $K){
                      if(sizeof($Lineups) >= $maxLineups){break;}
                    foreach($Ds as $D){
                      $lineup = new lineup($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D);
                      if ($lineup->salary > 57000 && $lineup->salary < 60000){
                        array_push($Lineups, $lineup);
                        echo "Got valid lineup";
                      }
                      if(sizeof($Lineups) >= $maxLineups){break;}
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
?>
