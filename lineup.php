<?php
    include("player.php");

    class lineup implements JSONSerializable{
        public $QB;
        public $RB;
        public $RB2;
        public $WR;
        public $WR2;
        public $WR3;
        public $TE;
        public $K;
        public $D;
        public $salary;
        public $avgCpp;
        public $projection;

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
            $this->projection = $QB->projection + $RB->projection + $RB2->projection + $WR->projection + $WR2->projection + $WR3->projection + $TE->projection + $K->projection + $D->projection;
        }

        public function jsonSerialize () {
        return array(
            'QBfname'=>$this->QB->fname,
            'QBlname'=>$this->QB->lname,
            'QBpos'=>$this->QB->pos,
            'QBsal'=>$this->QB->sal,
            'QBprojection'=>$this->QB->projection,
            'RBfname'=>$this->RB->fname,
            'RBlname'=>$this->RB->lname,
            'RBpos'=>$this->RB->pos,
            'RBsal'=>$this->RB->sal,
            'RBprojection'=>$this->RB->projection,
            'RB2fname'=>$this->RB2->fname,
            'RB2lname'=>$this->RB2->lname,
            'RB2pos'=>$this->RB2->pos,
            'RB2sal'=>$this->RB2->sal,
            'RB2projection'=>$this->RB2->projection,
            'WRfname'=>$this->WR->fname,
            'WRlname'=>$this->WR->lname,
            'WRpos'=>$this->WR->pos,
            'WRsal'=>$this->WR->sal,
            'WRprojection'=>$this->WR->projection,
            'WR2fname'=>$this->WR2->fname,
            'WR2lname'=>$this->WR2->lname,
            'WR2pos'=>$this->WR2->pos,
            'WR2sal'=>$this->WR2->sal,
            'WR2projection'=>$this->WR2->projection,
            'WR3fname'=>$this->WR3->fname,
            'WR3lname'=>$this->WR3->lname,
            'WR3pos'=>$this->WR3->pos,
            'WR3sal'=>$this->WR3->sal,
            'WR3projection'=>$this->WR3->projection,
            'TEfname'=>$this->TE->fname,
            'TElname'=>$this->TE->lname,
            'TEpos'=>$this->TE->pos,
            'TEsal'=>$this->TE->sal,
            'TEprojection'=>$this->TE->projection,
            'Kfname'=>$this->K->fname,
            'Klname'=>$this->K->lname,
            'Kpos'=>$this->K->pos,
            'Ksal'=>$this->K->sal,
            'Kprojection'=>$this->K->projection,
            'Dfname'=>$this->D->fname,
            'Dlname'=>$this->D->lname,
            'Dpos'=>$this->D->pos,
            'Dsal'=>$this->D->sal,
            'Dprojection'=>$this->D->projection,
            'salary'=>$this->salary,
            'avgCPP'=>$this->avgCpp,
            'projection'=>$this->projection
        );
    }
  }
?>
