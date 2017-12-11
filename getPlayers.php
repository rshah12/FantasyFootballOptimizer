<?php
  include("lineup.php");

  $conn = new mysqli("classroom.cs.unc.edu","patelr1","comp426Group","patelr1db");

  $QBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'QB' AND cpp < (SELECT avg from averages WHERE pos = 'QB') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
      array_push($QBs, $player);
    }
  mysqli_free_result($Result);
  }

echo "<table style='width: 40%' id='lineup'>";
    echo "<tr>";
        echo "<th>Player</th>";
       echo "<th>Position</th>";
      echo "<th>Salary</th>";
       echo "<th>Projected points</th>";
    echo "</tr>";

    echo "</table>";

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

  $Lineups = array();
  $maxLineups = 2000;
  $maxExposure = 50;
  $requestedLineups = 100;
  $minProjection = 0;
  $counter = 0;
  $sum=0;

    for($i=0; $i<7; $i++){
        $QB = $QBs[$i];
        //if(sizeof($Lineups) >= $maxLineups){break;}
      for($j=0; $j<10; $j++){
          $RB = $RBs[$j];
          //if(sizeof($Lineups) >= $maxLineups){break;}
        for($k=0; $k<10; $k++){
            $RB2 = $RBs[$k+$j];
            if($RB2 != $RB){
          for($l=0; $l<15; $l++){
              $WR = $WRs[$l];
              //if($WR->sal+$RB2->sal+$RB->sal+$QB->sal+22000 > 60000){break;}
            for($m=0; $m<15; $m++){
                $WR2 = $WRs[$m+$l];
                if($WR2 != $WR){
                //if($WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+17500 > 60000){break;}
              for($n=0; $n<15; $n++){
                  $WR3 = $WRs[$n+$m+$l];
                  if($WR3 != $WR2 && $WR3 != $WR){
                  //if($WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+13000 > 60000){break;}
                for($o=0; $o<5; $o++){
                    $TE = $TEs[$o];
                    //if($TE->sal+$WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+8500 > 60000){break;}
                  for($p=0; $p<5; $p++){
                      $K = $Ks[$p];
                    for($q=0; $q<5; $q++){
                      $lineup = new lineup($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D);
                      //echo "$lineup->salary\n";
                      if ($lineup->salary > 57000 && $lineup->salary <= 60000){
                        if($counter < $requestedLineups){
                          //echo "$counter\n";
                          array_push($Lineups, $lineup);
                          if($minProjection < $lineup->projection){
                            $minProjection = $lineup->projection;
                            $minIndex = $counter;
                          }
                        } else if ($lineup->projection > $minProjection){
                            echo "Added Lineup Projection: "."$lineup->projection"." at Lineup#"."$counter\n";
                            //echo $lineup->$QB->$fname;
                            //echo "$lineup->$QB->$lname"." "."$lineup->$RB->$lname"." "."$lineup->$RB2->$lname"." "."$lineup->$WR->$lname"." "."$lineup->$WR2->$lname\n";
                            //echo "$lineup->$WR3->$lname"." "."$lineup->$TE->$lname"." "."$lineup->$K->$lname"." "."$lineup->$D->$lname\n";
                            $Lineups[$minIndex] = $lineup;
                            $minProjection = 1000;
                            for($z=0; $z<count($Lineups);$z++){
                              if($minProjection > $Lineups[$z]->projection){
                                $minProjection = $Lineups[$z]->projection;
                                $minIndex = $z;
                              }
                            }
                        }
                        $counter++;
                      }

                    }
                  }
                }
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
