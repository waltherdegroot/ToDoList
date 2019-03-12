<?php
?>

<div class="card">
    <table class="table table-striped">
        <thead>
            <th>Log Date</th>
            <th>Controller and function</th>
            <th>Action Type</th>
            <th>Targeted ID</th>
            <th>User Id</th>
            <th>Exception</th>    
        </thead>
        <tbody>
            <?php foreach($Log as $item => $logging): ?>
                <tr>
                    <td><?=$logging["LogDate"]?></td>
                    <td><?=$logging["ControllerAction"]?></td>
                    <td><?=$logging["ActionType"]?></td>
                    <td><?=$logging["TargetedItem"]?></td>
                    <td><?=$logging["UserId"]?></td>
                    <td><?=$logging["ExceptionData"]?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>