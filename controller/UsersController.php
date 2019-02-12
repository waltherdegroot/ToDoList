<?php
    require(ROOT . "model/UsersModel.php");
    require(ROOT . "model/LogModel.php");

    $UserColor;

    function index(){
        render("Users/index");
    }

    function signup(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['password'] == $_POST['repeatPassword']){
                $data = array(
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => hash('sha256',$_POST['password'])
                );
    
                try{
                    CreateUser($data);
                }
                catch(Exception $ex){
                    AddErrorLog("I","Users/signup",null,$ex);
                }

                return signin();
            }
        }
        else{
            render("Users/signup");
        }
    }

    function signin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = array(
                'email' => $_POST['email'],
                'password' => hash('sha256',$_POST['password'])
            );

            $loggedin = checkUser($data);

            if($loggedin[0]["Allowed"] == "true"){
                $_SESSION["Authorized"] = "true";
                $_SESSION["Username"] = $loggedin[0]["Username"];
                $_SESSION["userId"] = $loggedin[0]["id"];
                $_SESSION["email"] = $loggedin[0]["Email"];
                $_SESSION["Role"] = $loggedin[0]["Role"];
                $_SESSION["UserColor"] = $loggedin[0]["Color"];

                header("Location:".URL."My/");
                exit;
            }
            else{

            }

        }
        render("Users/signin");
    }

    function logout(){
        session_unset();
        session_destroy();
        header("Location:".URL."Users/signin");
        exit;
    }