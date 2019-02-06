<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
        exit;
    }
    $id = $list[0]["id"];
?>
<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card item-card">
            <div class="card-header">
                <?= $list[0]["ListName"] ?>
            </div>
            <div class="card-body">
                <?php
                    foreach($list as $item => $value){
                        $itemName = $value["ItemName"];
                        $itemDescrition = $value["ItemDescription"];
                        $itemStatus = $value["ItemStatus"];

                        $checkbox = "Done: <input type='checkbox' name='Status' class='checkbox' />";

                        if($itemStatus != 0){
                            $checkbox = "Done: <input type='checkbox' name='Status' class='checkbox' checked />";
                        }

                        $html = "
                        <div class='items'>
                            <div class='item-header row'>
                                <div class='col-md-6 item-Name'>
                                    ".$itemName."
                                </div>
                                <div class='col-md-6 item-Status'>
                                        ".$checkbox."
                                </div>
                            </div>
                            <div class='item-body row'>
                                <div class='item-group '>
                                        " .$itemDescrition. "
                                </div>
                            </div>
                        </div>";

                        echo $html;
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>




