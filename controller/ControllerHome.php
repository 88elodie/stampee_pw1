<?php

class ControllerHome{
    public function index(){
        if(CheckSession::SessionConnected()){
            $session = 1;
        }else {
            $session = 0;
        }
        return Twig::render('home-index.php', ['session' => $session]);
    }

    public function error(){
        return Twig::render('error.php');
    }

}