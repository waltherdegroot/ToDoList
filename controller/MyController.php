<?php

    require(ROOT . "model/MyModel.php");

    function Index(){
        render("My/Lists",array(
            'lists' => GetLists()
        ));
    }

    function EditList($ID){
        render("My/EditList",array(
            'list' => GetList($ID)
        ));
    }

    function CreateList(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $data = array(
                'ListName' => $_POST["ListName"],
                array(
                    'itemNames' => $_POST["itemName"],
                    'itemDescriptions' => $_POST["itemDescription"]
                )
            );

            CreateListDB($data);

            header("Location:../My/Lists");
            exit;
        }

        render("My/CreateList");
    }