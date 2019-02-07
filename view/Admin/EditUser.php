<?php
    
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="<?= URL ?>Admin/EditUser/<?= $User["Id"] ?>" method="POST">
            <div class="card item-card">       
                <div class="card-header">
                    <h3>User: <?= $User["Username"] ?></h3>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control " name="Username" value="<?= $User["Username"] ?>" disabled>
                    <input type="text" class="form-control " name="Email" value="<?= $User["Email"] ?>" disabled>
                    
                    <select class="custom-select inputs form-control" name="Role">
                        <?php
                            foreach($Roles as $item => $Role){
                                $html = "<option value='".$Role["Id"]."'>".$Role["Name"]."</option>";
                                
                                if($Role["Name"] == $User["Role"]){
                                    $html = "<option value='".$Role["Id"]."' selected>".$Role["Name"]."</option>";
                                }

                                echo $html;
                            }
                        ?>
                    </select>
                    <hr>
                    <?php
                        foreach($Lists as $item => $list){
                            $listId = $list["Id"];
                            $listName = $list["Name"];
                            $Username = $list["Username"];

                            $html = "
                                <div class='list'>
                                    <a href='". URL ."Admin/EditList/".$listId."'>
                                        <div>
                                            ".$listName."
                                        </div>
                                    </a>
                                </div>
                                <hr>
                            ";
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
    <div class="col-md-2"></div>
</div>
<script>

    $(".inputs").prop("disabled",true);
    $("#saveBtn").prop("disabled",true);

    $("#editBtn").on("click",function(){ 
        $(".inputs").prop("disabled",false);
        $("#saveBtn").prop("disabled",false);

        $("#cancelBtn").show();
        $("#saveBtn").show();
        $("#delCheck").show();
        $("#delBtn").show();

        $("#editBtn").hide();
    });

    $("#cancelBtn").on("click",function(){ 
        location.reload();
    });

    $("#saveBtn").on("click",function(){ 
        location.reload();
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