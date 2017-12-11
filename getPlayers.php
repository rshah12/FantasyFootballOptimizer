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
  $maxLineups = 2000;
  $maxExposure = 50;

  $counter = 0;

    foreach($QBs as $QB){
        //if(sizeof($Lineups) >= $maxLineups){break;}
      foreach($RBs as $RB){
          //if(sizeof($Lineups) >= $maxLineups){break;}
        foreach($RBs as $RB2){
            //if(sizeof($Lineups) >= $maxLineups){break;}
          foreach($WRs as $WR){
              //if(sizeof($Lineups) >= $maxLineups){break;}
            foreach($WRs as $WR2){
                //if(sizeof($Lineups) >= $maxLineups){break;}
              foreach($WRs as $WR3){
                  //if(sizeof($Lineups) >= $maxLineups){break;}
                foreach($TEs as $TE){
                    //if(sizeof($Lineups) >= $maxLineups){break;}
                  foreach($Ks as $K){
                      //if(sizeof($Lineups) >= $maxLineups){break;}
                    foreach($Ds as $D){
                      $lineup = new lineup($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D);
                      $counter++;
                      if ($lineup->salary > 57000 && $lineup->salary < 60000){
                        array_push($Lineups, $lineup);
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

    echo $counter;
  // function quick_sort($array){
  // 	// find array size
  // 	$length = count($array);
  //
  // 	// base case test, if array of length 0 then just return array to caller
  // 	if($length <= 1){
  // 		return $array;
  // 	}
  // 	else{
  //
  // 		// select an item to act as our pivot point, since list is unsorted first position is easiest
  // 		$pivot = $array[0]->projection;
  //
  // 		// declare our two arrays to act as partitions
  // 		$left = $right = array();
  //
  // 		// loop and compare each item in the array to the pivot value, place item in appropriate partition
  // 		for($i = 1; $i < count($array); $i++)
  // 		{
  // 			if($array[$i]->projection < $pivot){
  // 				$left[] = $array[$i];
  // 			}
  // 			else{
  // 				$right[] = $array[$i];
  // 			}
  // 		}
  //
  // 		// use recursion to now sort the left and right lists
  // 		return array_merge(quick_sort($left), array($pivot), quick_sort($right));
  // 	}
  // }

  $Lineups = quick_sort($Lineups);
?>
