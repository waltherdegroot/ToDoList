<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
    }
?>

<div class="row">
    <div class="col-md-6">
        <div class="list bg-danger">
            <p>test</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="list bg-danger">
            <p>test</p>
        </div>
    </div>
</div>
