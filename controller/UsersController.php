<?php
    require(ROOT . "model/UsersModel.php");

    function index(){
        
        echo session_status();
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
    
                CreateUser($data);

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

            print_r($loggedin[0]["Allowed"]);

            if($loggedin[0]["Allowed"] == "true"){
                $_SESSION["Authorized"] = "true";
                $_SESSION["Username"] = $loggedin[0]["Username"];
                $_SESSION["userId"] = $loggedin[0]["id"];
                $_SESSION["email"] = $loggedin[0]["Email"];
                $_SESSION["Role"] = $loggedin[0]["Role"];

                print_r($loggedin);

                header("Location:../My/index");
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
        header("Location:../Users/signin");
        exit;
    }