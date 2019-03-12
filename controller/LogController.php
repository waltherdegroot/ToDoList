<?php
    require(ROOT . "model/LogModel.php");
    
    function index(){
        render("Log/index", array(
            'Log' => GetTopHundredLogs()
        ));
    }