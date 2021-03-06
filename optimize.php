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
  $maxLineups = 1000000;

  $requestedLineups = 100;
  $minProjection = 1000;
  $maxExposure = $_POST['slider'];
  $counter = 0;
  $sum=0;

    for($i=0; $i<10; $i++){
        $QB = $QBs[$i];
        if($counter >= $maxLineups || $QB->uses >= $maxExposure){continue;}
      for($j=0; $j<15; $j++){
          $RB = $RBs[$j];
          if($counter >= $maxLineups || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
        for($k=0; $k<15; $k++){
            $RB2 = $RBs[$k+$j];
            if($counter >= $maxLineups || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
            if($RB2 != $RB){
          for($l=0; $l<20; $l++){
              $WR = $WRs[$l];
              if($counter >= $maxLineups || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
              //if($WR->sal+$RB2->sal+$RB->sal+$QB->sal+22000 > 60000){break;}
            for($m=0; $m<20; $m++){
                $WR2 = $WRs[$m+$l];
                if(sizeof($Lineups) >= $maxLineups || $WR2->uses >= $maxExposure || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
                if($WR2 != $WR){
                //if($WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+17500 > 60000){break;}
              for($n=0; $n<20; $n++){
                  $WR3 = $WRs[$n+$m+$l];
                  if($counter >= $maxLineups || $WR3->uses >= $maxExposure || $WR2->uses >= $maxExposure || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
                  if($WR3 != $WR2 && $WR3 != $WR){
                  //if($WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+13000 > 60000){break;}
                for($o=0; $o<5; $o++){
                    $TE = $TEs[$o];
                    if($counter >= $maxLineups || $TE->uses >= $maxExposure || $WR3->uses >= $maxExposure || $WR2->uses >= $maxExposure || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
                    //if($TE->sal+$WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+8500 > 60000){break;}
                  for($p=0; $p<5; $p++){
                      $K = $Ks[$p];
                      if($counter >= $maxLineups || $K->uses >= $maxExposure || $TE->uses >= $maxExposure || $WR3->uses >= $maxExposure || $WR2->uses >= $maxExposure || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
                    for($q=0; $q<5; $q++){
                      $D = $Ds[$q];
                      if($counter >= $maxLineups || $D->uses >= $maxExposure || $K->uses >= $maxExposure || $TE->uses >= $maxExposure || $WR3->uses >= $maxExposure || $WR2->uses >= $maxExposure || $WR->uses >= $maxExposure || $RB2->uses >= $maxExposure || $RB->uses >= $maxExposure || $QB->uses >= $maxExposure){continue;}
                      $lineup = new lineup($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D);
                      //echo "$lineup->salary\n";
                      if ($lineup->salary > 57000 && $lineup->salary <= 60000){
                        if($counter < $requestedLineups){
                          //echo "$counter\n";

                          $QB->uses = $QB->uses + 1;
                          $RB->uses = $RB->uses + 1;
                          $RB2->uses = $RB2->uses + 1;
                          $WR->uses = $WR->uses + 1;
                          $WR2->uses = $WR2->uses + 1;
                          $WR3->uses = $WR3->uses + 1;
                          $TE->uses = $TE->uses + 1;
                          $K->uses = $K->uses + 1;
                          $D->uses = $D->uses + 1;

                          array_push($Lineups, $lineup);
                          if($minProjection > $lineup->projection){
                            $minProjection = $lineup->projection;
                            //echo "$minProjection\n";
                            $minIndex = $counter;
                          }
                        } else if ($lineup->projection > $minProjection){
                            //echo "Added Lineup Projection: "."$lineup->projection"." at Lineup#"."$counter\n";
                            //echo "$QB->lname"." "."$RB->lname"." "."$RB2->lname"." "."$WR->lname"." "."$WR2->lname\n";
                            //echo "$WR3->lname"." "."$TE->lname"." "."$K->lname"." "."$D->lname\n";


                            $Lineups[$minIndex]->QB->uses = $Lineups[$minIndex]->QB->uses - 1;
                            $Lineups[$minIndex]->RB->uses = $Lineups[$minIndex]->RB->uses - 1;
                            $Lineups[$minIndex]->RB2->uses = $Lineups[$minIndex]->RB2->uses - 1;
                            $Lineups[$minIndex]->WR->uses = $Lineups[$minIndex]->WR->uses - 1;
                            $Lineups[$minIndex]->WR2->uses = $Lineups[$minIndex]->WR2->uses - 1;
                            $Lineups[$minIndex]->WR3->uses = $Lineups[$minIndex]->WR3->uses - 1;
                            $Lineups[$minIndex]->TE->uses = $Lineups[$minIndex]->TE->uses - 1;
                            $Lineups[$minIndex]->K->uses = $Lineups[$minIndex]->K->uses - 1;
                            $Lineups[$minIndex]->D->uses = $Lineups[$minIndex]->D->uses - 1;



                            $Lineups[$minIndex] = $lineup;
                            $minProjection = 1000;
                            for($z=0; $z<count($Lineups);$z++){
                              if($minProjection > $Lineups[$z]->projection){
                                $minProjection = $Lineups[$z]->projection;
                                $minIndex = $z;
                              }
                            }

                            $QB->uses = $QB->uses + 1;
                            $RB->uses = $RB->uses + 1;
                            $RB2->uses = $RB2->uses + 1;
                            $WR->uses = $WR->uses + 1;
                            $WR2->uses = $WR2->uses + 1;
                            $WR3->uses = $WR3->uses + 1;
                            $TE->uses = $TE->uses + 1;
                            $K->uses = $K->uses + 1;
                            $D->uses = $D->uses + 1;
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
$conn->close();

echo json_encode($Lineups);

?>
