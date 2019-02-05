<?php

    require(ROOT . "model/MyModel.php");

    function Index(){
        render("My/Lists",array(
            'lists' => GetLists()
        ));
    }

    function EditList($ID){
        render("My/ListEdit",array(
            'list' => GetList($ID)
        ));
    }