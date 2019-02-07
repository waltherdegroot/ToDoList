<?php
    
?>

<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>All lists</h3>
            </div>
            <div class="card-body">
                <?php
                    foreach($Lists as $item => $list){
                        $listId = $list["Id"];
                        $listName = $list["Name"];
                        $Username = $list["Username"];

                        $html = "
                            <div class='list'>
                                <a href='". URL ."Admin/EditList/".$listId."'>
                                    <div>
                                        ".$listName." (".$Username.")
                                    </div>
                                </a>
                            </div>
                            <hr>
                        ";
                        echo $html;
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>