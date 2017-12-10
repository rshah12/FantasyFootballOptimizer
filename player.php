<?php
    class player{
        var $fname;
        var $lname;
        var $pos;
        var $cpp;
        var $sal;
        var $team;
        var $opp;
        var $projection;

        function __construct($f, $l, $p, $t, $o, $s, $c, $proj){
            $this->fname = $f;
            $this->lname = $l;
            $this->pos = $p;
            $this->team = $t;
            $this->opp = $o;
            $this->sal = $s;
            $this->cpp = $c;
            $this->projection = $proj;
        }

        function get_fname(){
            return $this->fname;
        }

        function get_lname(){
            return $this->lname;
        }

        function get_pos(){
            return $this->pos;
        }

        function get_team(){
            return $this->team;
        }

        function get_opp(){
            return $this->opp;
        }

        function get_sal(){
            return $this->sal;
        }

        function get_cpp(){
            return $this->cpp;
        }

        function get_projection(){
            return $this->projection;
        }

    }


?>