<?php
    
// -------------- User Queries --------------

    function GetAllUsers(){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            SELECT 
                u.Id,
                u.Username,
                u.Email,
                r.Name as 'Role'
            FROM Users u
            left join UserRoles ur on u.id = ur.UserId
            left join Roles r on ur.RoleId = r.Id
        ");

        $query->execute();

		return $query->fetchAll();
    }

    function GetUser($uid){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            SELECT 
                u.Id,
                u.Username,
                u.Email,
                r.Name as 'Role'
            FROM Users u
            left join UserRoles ur on u.id = ur.UserId
            left join Roles r on ur.RoleId = r.Id
            where u.Id = :uid
        ");

        $query->bindparam(':uid',$uid);

        $query->execute();

		return $query->fetch();
    }

    function DeleteUser($uid){
        DeleteAllListsUser($uid);

        $db = openDatabaseConnection();

        $query = $db->prepare("DELETE FROM UserRoles where UserId = :uid");
        $query->bindparam(':uid',$uid);
        $query->execute();

        $query2 = $db->prepare("DELETE FROM Users where Id = :uid");
        $query2->bindparam(':uid',$uid);
        $query2->execute();
    }

    function UpdateUserRole($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("UPDATE UserRoles SET RoleId = :RoleId where UserId = :uid");
        $query->bindparam(':uid',$data["Id"]);
        $query->bindparam(':RoleId',$data["RoleId"]);
        $query->execute();
    }

// -------------- List Queries --------------

    function GetAllLists(){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            SELECT 
               L.Id,
               Name,
               u.Username
            FROM ToDoLists L
            left join Users u on L.UserId = u.Id 
        ");

        $query->execute();

		return $query->fetchAll();
    }

    function GetList($id){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            SELECT
            L.Id as 'ListId',
            L.Name as 'ListName',
            item.Name as 'ItemName',
            item.Description as 'ItemDescription',
            item.Done as 'ItemStatus',
            item.Id as 'ItemId',
            item.Duration as 'ItemDuration',
            u.Username,
            u.Id as 'UserId'
            FROM ToDoLists L 
            left join ItemsList item on :id = item.ListId
            left join Users U on L.UserId = u.Id
            where L.Id = :id");
        $query->bindparam(':id',$id);
        $query->execute();

		return $query->fetchAll();
    }

    function GetAllListsUser($uid){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT Id,Name FROM `ToDoLists` WHERE UserId = :uid");
        $query->bindparam(':uid',$uid);

        $query->execute();

		return $query->fetchAll();
    }

    function UpdateList($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("UPDATE ToDoLists set Name = :name where Id = :listId");

        $query-> bindparam(':listId',$data["ListId"]);
        $query-> bindparam(':name',$data["ListName"]);

        $query->execute();

        for($i = 0; $i < count($data["itemNames"]); $i++){
            $duration = (int)$data["itemDurations"][$i];
            $status = (int)$data["itemStats"][$i];

            $query2 = $db->prepare("
                UPDATE ItemsList
                set
                Name = :name,
                Description = :description,
                Duration = :duration,
                Done = :status
                WHERE ListId = :listId and Id = :itemId
            ");

            $query2-> bindparam(':listId', $data["ListId"]);
            $query2-> bindparam(':itemId', $data["itemIds"][$i]);
            $query2-> bindparam(':name', $data["itemNames"][$i]);
            $query2-> bindparam(':description', $data["itemDescriptions"][$i]);   
            $query2-> bindparam(':duration', $duration);
            $query2-> bindparam(':status', $status);

            $query2->execute();
        }
    }

    function DeleteList($id){
        $db = openDatabaseConnection();

        $query = $db->prepare("DELETE FROM ItemsList where ListId = :ListId");
        $query->bindparam(':ListId',$id);
        $query->execute();

        $query2 = $db->prepare("DELETE FROM ToDoLists where Id = :ListId");
        $query2->bindparam(':ListId',$id);
        $query2->execute();
    }

    function DeleteAllListsUser($uid){
        $data = GetAllListsUser($uid);

        $db = openDatabaseConnection();

        foreach($data as $list => $id){
            $query = $db->prepare("DELETE FROM ItemsList where ListId = :ListId");
            $query->bindparam(':ListId',$id["Id"]);
            $query->execute();

            $query2 = $db->prepare("DELETE FROM ToDoLists where Id = :ListId and UserId = :uid");
            $query2->bindparam(':ListId',$id["Id"]);
            $query2->bindparam(':uid',$uid);
            $query2->execute();
        }
    }

// -------------- Role Queries --------------

    function GetAllRoles(){
        $db = openDatabaseConnection();

        $query = $db->prepare("
            SELECT
                Id,
                Name,
                Description
            FROM Roles
        ");

        $query->execute();

		return $query->fetchAll();
    }