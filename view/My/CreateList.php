<?php
    
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
</script>