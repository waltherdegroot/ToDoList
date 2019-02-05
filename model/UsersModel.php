<?php
	function GetUser(){

    }

    function CreateUser($data){
        $db = openDatabaseConnection();

        // Create USER in DB
        $query = $db->prepare("
            INSERT INTO Users(Username,Email,Password) VALUES(:username,:email,:password);
            ");

        $query->bindParam(':username', $data['username']);
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':password', $data['password']);

        $query->execute();

        // Select Created USER in DB for its ID
        $query2 = $db->prepare("
            SELECT Id FROM Users where Username = :username and Email = :email and Password = :password;
        ");
        $query2->bindParam(':username', $data['username']);
        $query2->bindParam(':email', $data['email']);
        $query2->bindParam(':password', $data['password']);
        $query2->execute();

        $result = $query2->fetch();

        // Create Basic_User role in DB for the current user
        $query3 = $db->prepare("
            insert into UserRoles(UserId,RoleId) VALUES (:id,2);
        ");

        $query3->bindParam(':id', $result["Id"]);
        $query3->execute();
    }

    function CheckUser($data){
        $db = openDatabaseConnection();
        
        // Check the login credentials in the DB and return neccesary session data
        $query = $db->prepare("
            select
            (CASE
                when (select u.Id from Users u where u.Email = :email and u.Password = :password) is not null then 'true'
                else 'false'
            END) as 'Allowed',
            u.id,
            u.Username,
            u.Email,
            r.Name as 'Role'
            from Users u                      
            left join UserRoles ur on u.id = ur.UserId
            left join Roles r on ur.RoleId = r.Id
            where u.Email = :email and u.Password = :password
            ");
            
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':password', $data['password']);

        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
?>