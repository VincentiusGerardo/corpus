<?php if (count($res) == 0) { ?>
    0
<?php } else { ?>
    <div class="form-horizontal">
        <?php foreach ($res as $r) { ?>
            <input type="hidden" name="idPeminjaman" value="<?= $r->ID_Peminjaman ?>"/>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Book Name</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaBuku ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Borrower</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->NamaMember ?></span>
                        <input type="hidden" name="memberName" value="<?= $r->NamaMember ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Return Date</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext"><?= $r->TanggalKembaliDisplay ?></span>
                    <input type="hidden" name="returnDate" id="inputDateReturn"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Loan Duration</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext" id="loanDur"></span>
                    <input type="hidden" name="duration" id="inputDuration"/>
                </div>
            </div>
            <div class="form-group row" id="sectionDenda" style="display: none;">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Fine</label>
                <div class="col-sm-4">
                    <span class="form-control-plaintext" id="loanFine"></span>
                    <input type="hidden" name="denda" id="inputDenda"/>
                </div>
            </div>
            <script>
                $(function() {
                    var returnDate = moment('<?= $r->TanggalKembali ?>', 'YYYY-MM-DD');
                    var borrowDate = moment('<?= $r->TanggalPinjam ?>', 'YYYY-MM-DD');
                    var today = moment().format("YYYY-MM-DD");

                    //Difference in number of days
                    var dateDiff = Math.floor(Math.abs(moment.duration(borrowDate.diff(today)).asDays()));

                    //Difference in number of weeks
                    var weekDiff = Math.floor(Math.abs(moment.duration(returnDate.diff(today)).asWeeks()));

                    if (dateDiff > 0) {
                        if (dateDiff <= 1) {
                            $('#loanDur').append(dateDiff + ' day');
                        } else {
                            $('#loanDur').append(dateDiff + ' days')
                        }

                        $('#inputDuration').val(dateDiff);
                        
                        if(dateDiff > 14){
                            if(weekDiff > 0){
                                $('#sectionDenda').css('display', '');
                                $('#loanFine').append('Rp. ' + parseInt(weekDiff * 1000).toLocaleString());
                                $('#inputDenda').val(weekDiff * 1000);
                            }else{
                                $('#sectionDenda').css('display', '');
                                $('#loanFine').append('Rp. ' + parseInt(1000).toLocaleString());
                                $('#inputDenda').val(1000);
                            }
                        }
                    }

                    $('#inputDateReturn').val(today);
                })
            </script>
        <?php } ?>
    </div>
<?php } ?>