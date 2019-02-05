<?php

    function GetLists(){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT 
            L.Id,
            L.Name
            FROM ToDoLists L 
            where L.UserId = :uid");

        $query-> bindparam(':uid',$_SESSION["userId"]);

        $query->execute();

		return $query->fetchAll();
    }

    function GetList($id){
        $db = openDatabaseConnection();

        $query = $db->prepare("SELECT 
            L.Id,
            L.Name as 'ListName',
            item.Name as 'ItemName',
            item.Description as 'ItemDescription',
            item.Done as 'ItemStatus'
            FROM ToDoLists L 
            left join ItemsList item on L.id = item.ListId 
            where L.UserId = :uid and L.Id = :id");

        $query-> bindparam(':uid',$_SESSION["userId"]);
        $query-> bindparam(':id',$id);

        $query->execute();

		return $query->fetchAll();
    }