<?php
    include("player.php");

    class lineup{
        public $QB;
        public $RB;
        public $RB2;
        public $WR;
        public $WR2;
        public $WR3;
        public $TE;
        public $K;
        public $D;
        public $sal;
        public $avgCpp;

        function __construct($QB, $RB, $RB2, $WR, $WR2, $WR3, $TE, $K, $D){
            $this->QB = $QB;
            $this->RB = $RB;
            $this->RB2 = $RB2;
            $this->WR = $WR;
            $this->WR2 = $WR2;
            $this->WR3 = $WR3;
            $this->TE = $TE;
            $this->K = $K;
            $this->D = $D;
            $this->salary = $QB->sal + $RB->sal + $RB2->sal + $WR->sal + $WR2->sal + $WR3->sal + $TE->sal + $K->sal + $D->sal;
            $this->avgCpp = ($QB->cpp + $RB->cpp + $RB2->cpp + $WR->cpp + $WR2->cpp + $WR3->cpp + $TE->cpp + $K->cpp + $D->cpp)/9;
        }
    }
?>
