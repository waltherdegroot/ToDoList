<?php

    require(ROOT . "model/UsersModel.php");

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

        }
        render("Users/signin");
    }