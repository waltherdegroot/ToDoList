<?php
    if($_SESSION["Authorized"] != "true"){
        header("Location:../Users/signin");
        exit;
    }
?>

<div class="row">
    <div class="col-md-12 all-lists">
        <div class="tools">
            <a href="<?= URL ?>My/CreateList">CREAT</a>
        </div>
        <?php foreach($lists as $list => $value):?>
                        <div class="list">
                            <a href="<?= URL ?>My/EditList/<?= $value["Id"] ?>">
                                <?= $value["Name"] ?>
                            </a>
                        </div>
        <?php endforeach ?>
    </div>
</div>
