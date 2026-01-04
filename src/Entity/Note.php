<?php

class Note {

    protected $id;
    protected $title;
    protected $content;
    protected $importance;


    public function __construct($title,$content,$importance,$id = null){
        $this->title=$title;
        $this->content=$content;
        $this->importance=$importance;
    }

    public function __set($prober , $value) {
        $this->$prober = $value;
    }

    public function __get($prober){
        return $this->$prober;
    }

        public function setId($id){
        if(!is_numeric($id) || (int) $id <= 0){
           die ("wrong note id");
        }

        $this->id=$id;
    }

}
