<?php

    function GetLists(){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT 
            L.Id,
            L.Name,
            (CASE
                when (select SL.Id from SharedLists SL where SL.SharedListId = L.Id and SL.VisitorId = :uid) is not null then 'true'
                else 'false'
            END) as 'Shared',
            (SELECT count(i.Id) from ItemsList i where i.ListId = L.Id) as 'ListItemsCount'
            
            FROM ToDoLists L 
            left join SharedLists s on :uid = s.VisitorId
            where L.UserId = :uid or L.Id = s.SharedListId");

        $query-> bindparam(':uid',$_SESSION["userId"]);

        $query->execute();

		return $query->fetchAll();
    }

    function GetList($id){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT 
            L.Id as 'ListId',
            L.Name as 'ListName',
            item.Name as 'ItemName',
            item.Description as 'ItemDescription',
            item.Done as 'ItemStatus',
            item.Id as 'ItemId',
            item.Duration as 'ItemDuration'
            FROM ToDoLists L 
            left join ItemsList item on L.id = item.ListId 
            where L.UserId = :uid and L.Id = :id");

        $query-> bindparam(':uid',$_SESSION["userId"]);
        $query-> bindparam(':id',$id);

        $query->execute();

		return $query->fetchAll();
    }

    function CreateListDB($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("insert into ToDoLists(Name,UserId) values(:name,:uid);");

        $query-> bindparam(':uid',$_SESSION["userId"]);
        $query-> bindparam(':name',$data["ListName"]);

        $query->execute();

        $query2 = $db->prepare("SELECT Id FROM `ToDoLists` order by Id DESC LIMIT 1");
        $query2->execute();

        $listId = $query2->fetchAll();

        for($i = 0; $i < count($data[0]["itemNames"]); $i++){
            $duration = (int)$data[0]["itemDurations"][$i];

            $query3 = $db->prepare("insert into ItemsList(ListId,Name,Description,Duration) values(:listId,:name,:description,:duration)");

            $query3-> bindparam(':listId', $listId[0]["Id"]);
            $query3-> bindparam(':name', $data[0]["itemNames"][$i]);
            $query3-> bindparam(':description', $data[0]["itemDescriptions"][$i]);   
            $query3-> bindparam(':duration', $duration);      

            $query3->execute();
        }
    }

    function UpdateListDB($data){
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

    function DeleteListDB($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("Delete FROM ToDoLists where Id = :listId");
        $query-> bindparam(':listId',$data);

        $query->execute();

        $query = $db->prepare("Delete FROM ItemsList where ListId = :listId");
        $query-> bindparam(':listId',$data);

        $query->execute();
    }

    function RemoveItemFromList($id){
        $db = openDatabaseConnection();

        $query = $db->prepare("Delete FROM ItemsList where Id = :Id");
        $query-> bindparam(':Id',$id);
        $query->execute();
    }

    function AddItemsToList($listId,$data){
        $db = openDatabaseConnection();

        for($i = 0; $i < count($data["itemNames"]); $i++){
            $duration = (int)$data["itemDurations"][$i];

            $query = $db->prepare("insert into ItemsList(ListId,Name,Description,Duration) values(:listId,:name,:description,:duration)");

            $query-> bindparam(':listId', $listId);
            $query-> bindparam(':name', $data["itemNames"][$i]);
            $query-> bindparam(':description', $data["itemDescriptions"][$i]);   
            $query-> bindparam(':duration', $duration);      

            $query->execute();
        }
    }

    function GetAllColors(){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Colors");
        $query->execute();

        return $query->fetchall();
    }

    function updateUserSettings($data){
        $db = openDatabaseConnection();

        $query = $db->prepare("Update Users set ColorId = :Color where Id = :uid");
        $query -> bindparam(":Color", $data);
        $query -> bindparam(":uid", $_SESSION["userId"]);

        $query -> execute();
    }