<?php

    function AddLog($Type,$controller,$TargetedItem){
        $db = openDatabaseConnection();

        $query = $db -> prepare("
            INSERT INTO LogTable(ControllerAction,ActionType,TargetedItem,UserId) Values(:Controller,:Type,:Targeted,:UserId)
        ");
        $query->bindparam(":Controller",$controller);
        $query->bindparam(":Type",$Type);
        $query->bindparam(":Targeted",$TargetedItem);
        $query->bindparam(":UserId", $_SESSION["userId"]);

        $query->execute();
    }

    function AddErrorLog($Type,$controller,$TargetedItem,$ExceptionData){
        $db = openDatabaseConnection();

        $query = $db -> prepare("
            INSERT INTO LogTable(ControllerAction,ActionType,TargetItem,UserId,ExceptionData,ExceptionThrown) Values(:Controller,:Type,:Targeted,:UserId,:Exception,1)
        ");
        $query->bindparam(":Controller",$controller);
        $query->bindparam(":Type",$Type);
        $query->bindparam(":Targeted",$TargetedItem);
        $query->bindparam(":UserId", $_SESSION["userId"]);
        $query->bindparam(":Exception", $ExceptionData);

        $query->execute();
    }

    function GetTopHundredLogs(){
        $db = openDatabaseConnection();
        $query = $db -> prepare("SELECT * FROM LogTable order by LogDate DESC LIMIT 100");
        $query->execute();
        return $query->fetchAll();
    }