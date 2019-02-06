<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
        exit;
    }

    $id = $list[0]["ListId"];
?>
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <form action="<?= URL ?>My/EditList/<?= $id ?>" method="POST">
            <div class="card item-card">       
                <div class="card-header">
                    <h3 id="listTitle"><?= $list[0]["ListName"] ?></h3>
                    <input type="text" id="listName" class="form-control inputs" name="ListName" style="display:none;"  value="<?= $list[0]["ListName"] ?>"/>
                    <input type="hidden" name="ListId" value="<?= $id ?>">
                </div>
                <div class="card-body">
                    <?php
                        $i = 0;
                        foreach($list as $item => $value){

                            $itemId = $value["ItemId"];
                            $itemName = $value["ItemName"];
                            $itemDescription = $value["ItemDescription"];
                            $itemStatus = $value["ItemStatus"];
                            $itemDuration = $value["ItemDuration"];

                            $checkbox = "Done: <input type='checkbox' id='status".$i."' class='checkbox inputs' />";

                            if($itemStatus != 0){
                                $checkbox = "Done: <input type='checkbox' id='status".$i."' class='checkbox inputs' checked />";
                            }

                            $html = "
                            <div class='items'>
                                <div class='item-header row'>
                                    <input type='hidden' name='itemId[".$i."]' value='".$itemId."'>
                                    <div class='col-md-3 item-Name'>
                                        <input type='text' class='form-control inputs' name='itemName[".$i."]'  value='".$itemName."'/>
                                    </div>
                                    <div class='col-md-3 item-Duration'>
                                        <input type='number' class='form-control inputs' name='itemDuration[".$i."]' min='10' value='".$itemDuration."'/> 
                                    </div>
                                    <div class='col-md-6 item-Status'>
                                            ".$checkbox."
                                            <input type='hidden' id='itemStatus".$i."' name='itemStatus[".$i."]' value='".$itemStatus."'>
                                    </div>
                                </div>
                                <div class='item-body'>
                                    <div class='item-group '>
                                    <textarea type='text' name='itemDescription[".$i."]' class='form-control inputs'>" .$itemDescription. "</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>";

                            $i = $i + 1;
                            echo $html;
                        }
                    ?>
                </div>
                <div class="card-footer">
                    <div class="float-left">
                        <input type="submit" name="delete" id="delBtn" class="btn btn-danger" style="display: none;" value="Delete" disabled>
                        <input type='checkbox' id='delCheck' style="display: none;" />
                    </div>
                    <div class="float-right">
                        <span id="cancelBtn" class="btn btn-warning" style="display: none;">Cancel</span>
                        <span id="editBtn" class="btn btn-warning">Edit</span>
                        <input type="submit" name="save" id="saveBtn" class="btn btn-success" style="display: none;" value="Save">
                    </div>
                </div>            
            </div>
        </form>
    </div>
    <div class="col-md-2">

    </div>
</div>

<script type="text/javascript">
    $(".inputs").prop("disabled",true);
    $("#saveBtn").prop("disabled",true);

    $("#editBtn").on("click",function(){ 
        $(".inputs").prop("disabled",false);
        $("#saveBtn").prop("disabled",false);

        $("#cancelBtn").show();
        $("#saveBtn").show();
        $("#listName").show();
        $("#delCheck").show();
        $("#delBtn").show();

        $("#editBtn").hide();
        $("#listTitle").hide();
    });

    $("#cancelBtn").on("click",function(){ 
        location.reload();
    });

    $("#saveBtn").on("click",function(){ 
        location.reload();
    });

    $(".checkbox").on("change", function(){
        if ($(this).is(':checked')) {
            var statusId = $(this).attr("id").replace("status","");
            $(document).find("#itemStatus" + statusId).val("1");
        }
        else{
            var statusId = $(this).attr("id").replace("status","");
            $(document).find("#itemStatus" + statusId).val("0");
        }
    });

    $("#delCheck").on("change", function(){
        if ($(this).is(':checked')) {
            $(document).find("#delBtn").prop("disabled",false);
        }
        else{
            $(document).find("#delBtn").prop("disabled",true);
        }
    });

</script>




