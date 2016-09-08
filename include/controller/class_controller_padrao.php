<?php

class ControllerPadrao{
    
    private $Model;
    
    function getModel() {
        return $this->Model;
    }

    function setModel($Model) {
        $this->Model = $Model;
    }

}