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
            $query3 = $db->prepare("insert into ItemsList(ListId,Name,Description) values(:listId,:name,:description)");

            $query3-> bindparam(':listId', $listId[0]["Id"]);
            $query3-> bindparam(':name', $data[0]["itemNames"][$i]);
            $query3-> bindparam(':description', $data[0]["itemDescriptions"][$i]);

            $query3->execute();
        }
    }