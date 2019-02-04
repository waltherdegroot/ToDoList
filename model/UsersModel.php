<?php
	function GetUser(){

    }

    function CreateUser($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            INSERT INTO Users(Username,Email,Password) VALUES(:username,:email,:password)
            ");

        $query->bindParam(':username', $data['username']);
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':password', $data['password']);

        $query->execute();


    }

    function CheckUser($data){
        $db = openDatabaseConnection();
        
        $query = $db->prepare("
            select
            (CASE
                when (select u.id from Users u where u.Email = :email and u.Password = :password) is not null then 'true'
                else 'false'
            END) as 'Allowed'
            ");
            
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':password', $data['password']);

        $query->execute();
        $result = $query->fetch();
        return $result['Allowed'];
    }
?>