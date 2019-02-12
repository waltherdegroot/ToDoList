<?php

?>
<form id="settings">
    <div class="card">
        <div class="card-header">
            <h3>Settings</h3>
        </div>
        <div class="card-body">
            <div class="form-group form-horizontal">
                <label>Background color: </label>
                <select class="custom-select" name="color">
                    <?php 
                        foreach($colors as $item => $color){
                            if($color["ColorName"] == $_SESSION["UserColor"]){

                                echo "<option value='".$color["ColorId"]."' selected> ".$color["ColorName"]."</option>";
                                continue;
                            }

                            echo "<option  value='".$color["ColorId"]."'> ".$color["ColorName"]." </option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" id="saveSettings" class="btn btn-success float-right" value="Save">
        </div>  
    </div>
</form>
<script type="text/javascript">
    $("#settings").on("submit",function(event){
        event.preventDefault();
        $.ajax({
            type: "POST",
            data: $(this).serialize(),
            url: "<?= URL ?>My/SaveSettings"
        }).done(
            function(){
            CreateNotification("Please log back in to apply settings","Settings saved","success");
            }
        )
    });
</script>