<?php
include("lineup.php");

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
<script type="text/javascript" src = "updateDOM.js">
    var quarterbacks = <?php echo json_encode($QBs) ?>;
</script>


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


?>
