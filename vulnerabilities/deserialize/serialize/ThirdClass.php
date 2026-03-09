<?php

class Third {

    public $data = [];
    public $obj = [];

    public function destroy($data){
        echo "Destroying data";
        if($data === 'data'){
            $this->data = [];
        }
    }

    public function __call($name, $args) {
        $args = implode($args);
        if(is_object($this->obj)){
            $obj = $this->obj;
            $obj->$name($args);
        }else{
            echo "Could not execute any method!";
            exit;
        }
    }

}