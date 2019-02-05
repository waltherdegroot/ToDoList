<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
        exit;
    }
    $id = $list[0]["id"];
?>

    <div class="col-md-8 centerAlign">
        <div class="card">
            <div class="card-header">
                <?= $list[0]["ListName"] ?>
            </div>
            <div class="card-body">
                <?php
                    foreach($list as $item => $value){
                        $itemName = $value["ItemName"];
                        $itemDescrition = $value["ItemDescription"];
                        $itemStatus = $value["ItemStatus"];

                        $html = "<div class='form-group'>
                                    <div class='item-Name'>"
                                        .$itemName. 
                                    "</div>
                                    <div class='item-Description'>" 
                                        .$itemDescrition. 
                                    "</div>
                                    <div class='item-Status'>" 
                                        .$itemStatus.
                                    "</div>
                                </div>";

                        echo $html;
                    }
                ?>
            </div>
        </div>
    </div>



