<?php

?>
<div class="row">
    <div class="col-md-12">
        <form action="<?= URL ?>Admin/EditList/<?= $List[0]["ListId"] ?>" method="POST">
            <div class="card item-card">       
                <div class="card-header">
                    <h3 id="listTitle"><?= $List[0]["ListName"] ?> (<?= $List[0]["Username"] ?>)</h3>
                    <input type="text" id="listName" class="form-control inputs" name="ListName" style="display:none;"  value="<?= $List[0]["ListName"] ?>"/>
                    <input type="hidden" name="ListId" value="<?= $id ?>">
                </div>
                <div class="card-body">
                <div id="allItems">
                        <table id="itemTable" class="table table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="width: 1%">Duration</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach($List as $item => $value): 
                                    $status;
                                    switch($value["ItemStatus"]){
                                        case 1:
                                        $status = "Done";
                                            break;
                                        case 0:
                                        $status = "To Do";
                                            break;
                                    };
                                ?>
                                    <tr id="item<?= $value["ItemId"] ?>">
                                        <td>
                                            <input type="hidden" name="itemId[<?= $i ?>]" value="<?= $value["ItemId"] ?>">
                                            <input type="text" class="form-control inputs" name="itemName[<?= $i ?>]" value="<?= $value["ItemName"] ?>">
                                        </td> 
                                        <td>
                                            <textarea class="form-control inputs" name="itemDescription[<?= $i ?>]"><?= $value["ItemDescription"] ?></textarea>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control inputs" name="itemDuration[<?= $i ?>]" value="<?= $value["ItemDuration"] ?>">
                                        </td>
                                        <td>
                                            <label id="statusLabel<?= $i ?>" class="statusLabel"><?= $status ?></label>

                                            <?php if($value["ItemStatus"] == 0): ?>
                                                <input id="status<?= $i ?>" type="checkbox" class="form-control inputs checkbox" name="itemstatus[<?= $i ?>]" style="display:none;">
                                            <?php else: ?>
                                                <input id="status<?= $i ?>" type="checkbox" class="form-control inputs checkbox" name="itemstatus[<?= $i ?>]" style="display:none;" checked>
                                            <?php endif ?>

                                            <input type='hidden' id='itemStatus<?= $i ?>' name='itemStatus["<?=$i?>"]' value='<?= $value["ItemStatus"] ?>'>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php $i = $i + 1 ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
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
                        <span id="editBtn" class="btn btn-warning">Edit</span>
                        <input type="submit" name="save" id="saveBtn" class="btn btn-success" style="display: none;" value="Save">
                    </div>
                </div>            
            </div>
        </form>
    </div>
</div>
<script>
    $("#itemTable").fancyTable({
        sortColumn:2,
        sortable: true,
        searchable: false,
        glabalSearch: false
    })

    $(".inputs").prop("disabled",true);
    $("#saveBtn").prop("disabled",true);

    $("#editBtn").on("click",function(){ 
        $(".inputs").prop("disabled",false);
        $("#saveBtn").prop("disabled",false);

        $("#cancelBtn").show();
        $("#saveBtn").show();
        $("#delCheck").show();
        $("#delBtn").show();
        $(".checkbox").show();

        $("#editBtn").hide();
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
            $(document).find("#statusLabel" + statusId).text("Done");
        }
        else{
            var statusId = $(this).attr("id").replace("status","");
            $(document).find("#itemStatus" + statusId).val("0");
            $(document).find("#statusLabel" + statusId).text("To Do");
        }
    });

</script>