<?php

?>

<div class="row">    
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>My lists (<?= count($lists) ?>)</h3>
            </div>
            <div class="card-body">
                <?php if(count($lists) <= 0): ?>
                    <div>
                        <h3>Nothing found 😢</h3>
                    </div>
                <?php endif ?>
                <?php foreach($lists as $list => $value):?>
                    <a href="<?= URL ?>My/EditList/<?= $value["Id"] ?>">
                        <div class="list">
                            <?= $value["Name"] ?> (<?= $value["ListItemsCount"] ?> Tasks)
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>