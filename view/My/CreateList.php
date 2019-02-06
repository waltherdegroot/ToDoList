<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
        exit;
    }
?>
<div class="card create-list-card">
	<div class="card-header card-header-color card-header-dark">
		<div>
			<h3>Create List</h3>
		</div>	
	</div>
	<div class="card-body">	
		<form action="<?= URL ?>My/CreateList" method="post">
			<div class="form-group">
                <div>
                    List Name:
                </div>
                <input type="text" class="form-control" name="ListName" placeholder="Name ... " autocomplete="off" required>
            </div>
            
            <div class="row">
                <div class="col-md-2">
                    ToDo
                </div>
                <div class="col-md-2">
                    Duration(in min)
                </div>
                <div class="col-md-8">
                    Description
                </div>
            </div>
            
            <div id="inputs" class="form-group">
                <div id="itemRow0" class="row">
                    <div class="col-md-2">
                        <input id="itemName0" type="text" class="form-control name_input" name="itemName[0]" placeholder="Name ... " autocomplete="off" required>
                    </div>
                    <div class="col-md-2">
                        <input id="itemDuration0" type="number" class="form-control num_input" name="itemDuration[0]" autocomplete="off" value="10" min="10" required>
                    </div>
                    <div class="col-md-8">
                        <textarea id="itemName0" class="form-control" name="itemDescription[0]" placeholder="Description ... "></textarea>
                    </div>
                </div>
            </div> 


            <a id="addInput">add input</a>
			<input type="submit" class="btn btn-info" value="Create">
		</form>
	</div>
</div>
<script type="text/javascript">

    var itemCount = 1;

    $("#addInput").on("click",function(){
        var html = `
            <div class="row" id="itemRow${itemCount}">
                <div class="col-md-2">
                    <input id="itemName${itemCount}" type="text" class="form-control name_input" name="itemName[${itemCount}]" placeholder="Name ... " autocomplete="off" required>
                </div>
                <div class="col-md-2">
                    <input id="itemDuration${itemCount}" type="number" class="form-control num_input" name="itemDuration[${itemCount}]" autocomplete="off" value="10" min="10" required>
                </div>
                <div class="col-md-7">
                    <textarea id="itemDescription${itemCount}" type="text" class="form-control" name="itemDescription[${itemCount}]" placeholder="Description ... "></textarea>
                </div>
                <div class="col-md-1">
                    <span id="remove${itemCount}" class="btn btn-warning del-btn removeItem"> - </span>
                </div>
            </div>
        `;
        $("#inputs").append(html);
        itemCount = itemCount + 1;
    });

    $(document).on("click",".removeItem", function(){
        var itemId = $(this).attr("id").replace("remove","");

        $("#itemRow" + itemId).remove();

        var inputRows = $("#inputs > div");
        var inputNames = $("#inputs > div > div > .name_input");
        var numInputs = $("#inputs > div > div > .num_input");
        var descriptions = $("#inputs > div > div > textarea");
        var removeBtns = $("#inputs > div > div > span");

        var i;

        for(i = 0; i < inputRows.length; i++){
            var inputRow = $(inputRows[i]).attr("id").replace("itemRow","")

            if(inputRow > itemId){
                $(inputRows[i]).attr("id","itemRow"+i);

                $(inputNames[i]).attr("id","itemName"+i);
                $(inputNames[i]).attr("name","itemName["+i+"]");

                $(numInputs[i]).attr("id","itemDuration"+i);
                $(numInputs[i]).attr("name","itemDuration["+i+"]");

                $(descriptions[i]).attr("id","itemDescription"+i);
                $(descriptions[i]).attr("name","itemDescription["+i+"]");

                $(removeBtns[i-1]).attr("id","remove"+i);
            }

            if(itemCount > 0){
                itemCount = itemCount - 1;
            }
        }
    });
</script>