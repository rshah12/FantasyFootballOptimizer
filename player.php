<?php
    class player{
        public $fname;
        public $lname;
        public $pos;
        public $cpp;
        public $sal;
        public $team;
        public $opp;
        public $projection;
        public $uses;

        function __construct($f, $l, $p, $t, $o, $s, $c, $proj){
            $this->fname = $f;
            $this->lname = $l;
            $this->pos = $p;
            $this->team = $t;
            $this->opp = $o;
            $this->sal = $s;
            $this->cpp = $c;
            $this->projection = $proj;
            $this->uses = 0;
        }
    }
?>
