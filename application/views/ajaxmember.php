<?php if (count($res) == 0) { ?>
    0
<?php } else { ?>
    <div class="form-horizontal">
        <?php foreach ($res as $r) { ?>
            <!-- <div class="form-group row">
            <label for="inputEmail3" class="col-sm-1 col-form-label">Member ID</label>
            <div class="col-sm-4">
                <span class="form-control-plaintext"><?= $r->ID_Member ?></span>
            </div>
        </div> -->
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Member Name</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaMember ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Phone Number</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NoHP ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Member Address</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->Alamat ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>