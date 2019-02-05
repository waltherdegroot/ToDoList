<?php
	function GetUser(){

    }

    function CreateUser($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            INSERT INTO Users(Username,Email,Password) VALUES(:username,:email,:password);
            
            ");

        $query->bindParam(':username', $data['username']);
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':password', $data['password']);

        $query->execute();
        $id = $query->lastInsertId();

        $query2 = $db->prepare("
            INSERT INTO UserRoles(UserId,RoleId) VALUES(:id,2);
        ");
        $query2->bindParam(':id', $id);
        $query2->execute();
        
    }

    function CheckUser($data){
        $db = openDatabaseConnection();
        
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