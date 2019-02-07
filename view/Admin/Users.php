<?php
    
?>

<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>All Users</h3>
            </div>
            <div class="card-body">
                <?php
                    foreach($Users as $item => $user){
                        $UserId = $user["Id"];
                        $Username = $user["Username"];
                        $UserEmail = $user["Email"];
                        $UserRole = $user["Role"];

                        $html = "
                            <div class='user'>
                                <a href='". URL ."Admin/EditUser/".$UserId."'>
                                    <div>
                                        ".$Username." ( ".$UserRole." )
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