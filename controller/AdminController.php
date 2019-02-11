<?php
    require(ROOT . "model/AdminModel.php");

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
                        DeleteUser($ID);
                        header("Location:". URL ."Admin/Users");
                        exit;
                    }

                    if(isset($_POST["save"])){
                        $data = array(
                            'Id' => $ID,
                            'RoleId' => $_POST["Role"]
                        );

                        UpdateUserRole($data);
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
                        DeleteList($ID);
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

                        UpdateList($data);
                    }
                }

                render("Admin/EditList",array(
                    'List' => GetList($ID)
                ));
            }
        }
    }
        