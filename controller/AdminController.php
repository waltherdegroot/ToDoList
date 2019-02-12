<?php
    require(ROOT . "model/AdminModel.php");
    require(ROOT . "model/LogModel.php");

    if($_SESSION["Authorized"] == "true"){
        if($_SESSION["Role"] == "Admin"){

            function Users(){
                render("Admin/Users",array(
                    'Users' => GetAllUsers()
                ));
            }

            function EditUser($ID){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["delete"])){
                        try{
                            DeleteUser($ID);
                            AddLog("D","Admin/EditUser",$ID);
                        }
                        catch(Exception $ex){
                            AddErrorLog("D","Admin/EditUser",$ID,$ex);
                        }
                        
                        header("Location:". URL ."Admin/Users");
                        exit;
                    }

                    if(isset($_POST["save"])){
                        $data = array(
                            'Id' => $ID,
                            'RoleId' => $_POST["Role"]
                        );

                        try{
                            UpdateUserRole($data);
                            AddLog("U","Admin/EditUser",$ID);
                        }
                        catch(Exception $ex){
                            AddErrorLog("U","Admin/EditUser",$ID,$ex);
                        }
                    }
                }

                render("Admin/EditUser", array(
                    'User' => GetUser($ID),
                    'Lists' => GetAllListsUser($ID),
                    'Roles' => GetAllRoles()
                ));
            }

            function Lists(){
                render("Admin/Lists",array(
                    'Lists' => GetAllLists()
                ));
            }

            function EditList($ID){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["delete"])){
                        try{
                            DeleteList($ID);
                            AddLog("D","Admin/EditList",$ID);
                        }
                        catch(Exception $ex){
                            AddErrorLog("D","Admin/EditList",$ID,$ex);
                        }
                        
                        header("Location:". URL ."Admin/Lists");
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
                            UpdateList($data);
                            AddLog("U","Admin/EditList",$ID);
                        }
                        catch(Exception $ex){
                            AddErrorLog("U","Admin/EditList",$ID,$ex);
                        }
                    }
                }

                render("Admin/EditList",array(
                    'List' => GetList($ID)
                ));
            }
        }
    }
        