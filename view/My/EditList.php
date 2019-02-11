<?php
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
                        if($list[0]["ItemName"] != null){
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
                                <div class='items ' id='item".$itemId."'>
                                    <div class='item-header row'>
                                        <input type='hidden' name='itemId[".$i."]' value='".$itemId."'>
                                        <div class='col-md-3 item-Name'>
                                            <input type='text' class='form-control inputs' name='itemName[".$i."]'  value='".$itemName."'/>
                                        </div>
                                        <div class='col-md-3 item-Duration'>
                                            <input type='number' class='form-control inputs' name='itemDuration[".$i."]' min='10' value='".$itemDuration."'/> 
                                        </div>
                                        <div class='col-md-3 item-Status'>
                                                ".$checkbox."
                                                <input type='hidden' id='itemStatus".$i."' name='itemStatus[".$i."]' value='".$itemStatus."'>
                                        </div>
                                        <div class='col-md-3 item-Status'>
                                                <span id='itemDel".$itemId."' class='btn btn-warning item-Delete'> Delete </span>
                                        </div>
                                    </div>
                                    <div class='item-body'>
                                        <div class='item-group '>
                                        <textarea type='text' name='itemDescription[".$i."]' class='form-control inputs'>" .$itemDescription. "</textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr id='itemHR".$itemId."'>";

                                $i = $i + 1;
                            }
                        }else{
                            $html = "<div>No items Found</div>";
                        }
                        echo $html;
                    ?>
                    <div id="inputs">

                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-left">
                        <input type="submit" name="delete" id="delBtn" class="btn btn-danger" style="display: none;" value="Delete" disabled>
                        <input type='checkbox' id='delCheck' style="display: none;" />
                    </div>
                    <div class="float-right">
                        <span id="cancelBtn" class="btn btn-warning" style="display: none;">Cancel</span>
                        <span id="addInputBtn" class="btn btn-secondary" style="display: none;">add an input</span>
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
        $("#addInputBtn").show();

        $("#editBtn").hide();
        $("#listTitle").hide();
    });

    $("#cancelBtn").on("click",function(){ 
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

    $(".item-Delete").on("click", function(){
        var itemId = $(this).attr("id").replace("itemDel","");
        
        $.ajax({
        url: "<?= URL ?>My/RemoveItem/" + itemId,
        context: this
        }).done(function() {
            $(document).find("#item"+itemId).prop("disabled",true);
            $(document).find("#item"+itemId).hide();
            $(document).find("#itemHR"+itemId).hide();
        });
    });

    var itemCount = 0; 

    $("#addInputBtn").on("click",function(){
        var html = `
            <div class="row" id="newItemRow${itemCount}">
                <div class="col-md-2">
                    <input id="newItemName${itemCount}" type="text" class="form-control new_name_input" name="newItemName[${itemCount}]" placeholder="Name ... " autocomplete="off" required>
                </div>
                <div class="col-md-2">
                    <input id="newItemDuration${itemCount}" type="number" class="form-control new_num_input" name="newItemDuration[${itemCount}]" autocomplete="off" value="10" min="10" required>
                </div>
                <div class="col-md-7">
                    <textarea id="newItemDescription${itemCount}" type="text" class="form-control new_textarea" name="newItemDescription[${itemCount}]" placeholder="Description ... "></textarea>
                </div>
                <div class="col-md-1">
                    <span id="remove${itemCount}" class="btn btn-warning del-btn removeNewItem"> - </span>
                </div>
            </div>
        `;
        $("#inputs").append(html);
        itemCount = itemCount + 1;
    });

</script>




