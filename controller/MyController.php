<?php
    require(ROOT . "model/MyModel.php");

    if($_SESSION["Authorized"] == "true"){

        function Index(){
            render("My/Lists",array(
                'lists' => GetLists()
            ));
        }

        function EditList($ID){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["delete"])){
                    
                    $data = array(
                        'delete' => true,
                        'ListId' => $ID
                    );

                    DeleteList($data);
                    header("Location:../My/");
                    exit;
                }
                
                if(isset($_POST["save"])){
                
                    $data = array(
                        'ListName' => $_POST["ListName"],
                        'ListId' => $ID,
                        'itemIds' => $_POST["itemId"],
                        'itemNames' => $_POST["itemName"],
                        'itemDescriptions' => $_POST["itemDescription"],
                        'itemDurations' => $_POST["itemDuration"],
                        'itemStats' => $_POST["itemStatus"]
                    );

                    UpdateListDB($data);

                    $ID = $_POST["ListId"];
                }
            }
            
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
                        'itemDescriptions' => $_POST["itemDescription"],
                        'itemDurations' => $_POST["itemDuration"]
                    )
                );

                CreateListDB($data);

                header("Location:../My/index");
                exit;
            }

            render("My/CreateList");
        }

        function DeleteList($data){
            if($data["delete"]){
                DeleteListDB($data["ListId"]);
            }
        }
    }
    