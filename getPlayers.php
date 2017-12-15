<?php
include("player.php");
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

$allPlayers = array();
$Query = "SELECT * FROM ppool P WHERE cpp < (SELECT avg from averages WHERE pos = P.pos) ORDER BY cpp";
if ($Result=mysqli_query($conn,$Query)){
  while ($obj=mysqli_fetch_object($Result)){
    $player = new player($obj->fname, $obj->lname, $obj->pos, $obj->team, $obj->opponent, $obj->salary, $obj->cpp, $obj->projection);
    array_push($allPlayers, $player);
  }
mysqli_free_result($Result);
}
$conn->close();

echo json_encode($allPlayers);
?>
