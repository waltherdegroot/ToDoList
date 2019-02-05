<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
    }
?>