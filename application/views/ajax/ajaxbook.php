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
                <label for="inputEmail3" class="col-sm-3 col-form-label">Book Name</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaBuku ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Author Name</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaPengarang ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Publisher Name</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaPenerbit ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Publication Year</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->TahunTerbit ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>