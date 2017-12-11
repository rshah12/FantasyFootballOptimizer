<?php
  include("lineup.php");

  $conn = new mysqli("classroom.cs.unc.edu","patelr1","comp426Group","patelr1db");

  $QBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'QB' AND cpp < (SELECT avg from averages WHERE pos = 'QB') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($QBs, $player);
    }
  mysqli_free_result($Result);
  }

  $RBs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'RB' AND cpp < (SELECT avg from averages WHERE pos = 'RB') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($RBs, $player);
    }
  mysqli_free_result($Result);
  }

  $WRs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'WR' AND cpp < (SELECT avg from averages WHERE pos = 'WR') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($WRs, $player);
    }
  mysqli_free_result($Result);
  }

  $TEs = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'TE' AND cpp < (SELECT avg from averages WHERE pos = 'TE') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($TEs, $player);
    }
  mysqli_free_result($Result);
  }

  $Ds = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'D' AND cpp < (SELECT avg from averages WHERE pos = 'D') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($Ds, $player);
    }
  mysqli_free_result($Result);
  }

  $Ks = array();
  $Query = "SELECT * FROM ppool WHERE pos = 'K' AND cpp < (SELECT avg from averages WHERE pos = 'K') ORDER BY cpp";
  if ($Result=mysqli_query($conn,$Query)){
    while ($obj=mysqli_fetch_object($Result)){
      $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->sal, $obj->cpp, $obj->projection);
      array_push($Ks, $player);
    }
  mysqli_free_result($Result);
  }

  $Lineups = array();
  $maxLineups = 2000;
  $maxExposure = 50;
  $requestedLineups = 100;
  $minProjection = 1000;
  $counter = 0;
  $sum=0;
  $RBcombos = array();
  $WRcombos = array();

  for($i=0; $i<15; $i++){
    $RB1 = $RBs[$i];
    for($j=0; $j<15; $j++){
      $RB2 = $RBs[$i];
      if($RB2 != $RB1 && in_array())
    }
  }
    for($i=0; $i<3; $i++){
        $QB = $QBs[$i];
        //if(sizeof($Lineups) >= $maxLineups){break;}
      for($j=0; $j<6; $j++){
          $RB = $RBs[$j];
          //if(sizeof($Lineups) >= $maxLineups){break;}
        for($k=0; $k<6; $k++){
            $RB2 = $RBs[$k];
            if($RB2 != $RB){
          for($l=0; $l<15; $l++){
              $WR = $WRs[$l];
              if($WR->sal+$RB2->sal+$RB->sal+$QB->sal+22000 > 60000){break;}
            for($m=0; $m<15; $m++){
                $WR2 = $WRs[$m];
                if($WR2 != $WR){
                if($WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+17500 > 60000){break;}
              for($n=0; $n<15; $n++){
                  $WR3 = $WRs[$n];
                  if($WR3 != $WR2 && $WR3 != $WR){
                  //if($WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+13000 > 60000){break;}
                for($o=0; $o<8; $o++){
                    $TE = $TEs[$o];
                    if($TE->sal+$WR3->sal+$WR2->sal+$WR->sal+$RB2->sal+$RB->sal+$QB->sal+8500 > 60000){break;}
                  for($p=0; $p<6; $p++){
                      $K = $Ks[$p];
                    for($q=0; $q<8; $q++){
                      $lineup = new lineup($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D);
                      echo "$sum\n";
                      $sum++;
                      if ($lineup->sal > 57000 && $lineup->sal <= 60000 && $counter < $requestedLineups){
                        $counter++;
                        array_push($Lineups, $lineup);
                        if($lineup->projection < $minProjection){
                          $minProjection = $lineup->projection;
                        }
                        $Lineups = quick_sort($Lineups);
                      } else if($lineup->sal > 57000 && $lineup->sal <= 60000 && $counter && $lineup->projection > $minProjection){
                        array_pop($Lineups);
                        array_push($Lineups, $lineup);
                        if($lineup->projection < $minProjection){
                          $minProjection = $lineup->projection;
                        }
                        $Lineups = quick_sort($Lineups);
                      }
                      //if(sizeof($Lineups) >= $maxLineups){break;}
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

      function quick_sort($array){
      	// find array size
      	$length = count($array);

      	// base case test, if array of length 0 then just return array to caller
      	if($length <= 1){
      		return $array;
      	}
      	else{

      		// select an item to act as our pivot point, since list is unsorted first position is easiest
      		$pivot = $array[0]->projection;

      		// declare our two arrays to act as partitions
      		$left = $right = array();

      		// loop and compare each item in the array to the pivot value, place item in appropriate partition
      		for($i = 1; $i < count($array); $i++)
      		{
      			if($array[$i]->projection < $pivot){
      				$left[] = $array[$i];
      			}
      			else{
      				$right[] = $array[$i];
      			}
      		}

      		// use recursion to now sort the left and right lists
      		return array_merge(quick_sort($left), array($pivot), quick_sort($right));
      	}
      }
?>
