<?php
    require(ROOT . "model/MyModel.php");
    require(ROOT . "model/LogModel.php");

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
                    
                    try{
                        DeleteList($data);
                        AddLog("D","My/EditList",$ID);
                    }
                    catch(Exception $ex){
                        AddErrorLog("D","My/EditList",$ID,$ex);
                    }
                    

                    header("Location:".URL."My/");
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

                    try{
                        UpdateListDB($data);
                        AddLog("U","My/EditList",$ID);
                    }
                    catch(Exception $ex){
                        AddErrorLog("U","My/EditList",$ID,$ex);
                    }

                    if(isset($_POST["newItemName"])){
                        $newItems = array(
                            'itemNames' => $_POST["newItemName"],
                            'itemDescriptions' => $_POST["newItemDescription"],
                            'itemDurations' => $_POST["newItemDuration"]
                        );

                        try{
                            AddItemsToList($_POST["ListId"],$newItems);
                            AddLog("I","My/EditList",$ID);
                        }
                        catch(Exception $ex){
                            AddErrorLog("I","My/EditList",$ID,$ex);
                        }
                        header("Location: ". URL ."My");
                        exit;
                    }



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
                
                try{
                    CreateListDB($data);
                    AddLog("I","My/CreateList",null);
                }
                catch(Exception $ex){
                    AddErrorLog("I","My/CreateList",null,$ex);
                }

                header("Location:".URL."My");
                exit;
            }

            render("My/CreateList");
        }

        function DeleteList($data){
            if($data["delete"]){
                try{  
                    DeleteListDB($data["ListId"]);
                    AddLog("D","My/DeleteList",$data["ListId"]);
                }
                catch(Exception $ex){
                    AddErrorLog("D","My/DeleteList",$data["ListId"],$ex);
                }
            }
        }

        function RemoveItem($id){
            try{
                AddLog("D","My/RemoveItem",$id);
                RemoveItemFromList($id);
            }
            catch(Exception $ex){
                AddErrorLog("D","My/RemoveItem",$id,$ex);
            }
        }

        function Settings(){
            render("My/Settings",array(
                'colors' => GetAllColors()
            ));
        }

        function SaveSettings(){
            try{
                updateUserSettings($_POST["color"]);
                AddLog("U","My/SaveSettings",$_SESSION["userId"]);
            }
            catch(Exception $ex){
                AddErrorLog("D","My/RemoveItem",$_SESSION["userId"],$ex);
            }
            
        }
    }
    