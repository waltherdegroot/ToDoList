<?php

?>

<div class="row">
    <div class="col-md-12 all-lists">
        <?php if(count($lists) <= 0): ?>
            <div>
                <h3>Nothing found 😢</h3>
            </div>
        <?php endif ?>
        <?php foreach($lists as $list => $value):?>
                        <div class="list">
                            <a href="<?= URL ?>My/EditList/<?= $value["Id"] ?>">
                                <?= $value["Name"] ?>
                            </a>
                        </div>
        <?php endforeach ?>
    </div>
</div>
