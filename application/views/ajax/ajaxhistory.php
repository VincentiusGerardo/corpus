<?php if (count($res) == 0) { ?>
    0
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover" id="tableHistory">
        <thead>
            <th>No.</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Created On</th>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($res as $r) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $r->HistoryDesc ?></td>
                <td><?= $r->CreatedBy ?></td>
                <td><?= date_format(date_create($r->CreatedDate), "d-m-Y H:i:s") ?></td>
            </tr>
        <?php $i++; } ?>
        </tbody>
    </table>
<?php } ?>