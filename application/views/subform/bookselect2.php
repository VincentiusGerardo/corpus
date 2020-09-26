<div class="form-group">
    <label for="address">Book 2</label>
    <input type="text" class="form-control inputs" name="book2" id="book2" placeholder="Please insert Book ID">
    <div class="help-block with-errors"></div>
</div>
<div id="formBook2Detail"></div>
<script>
    $(function () { 
        $('#book2').keydown(function(e) {
            if (e.keyCode == 13 && $('#book2').val()) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('Ajax/getBookDetail') ?>',
                    data: {
                        book: $('#book2').val()
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('#formBook2Detail').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                    },
                    success: function(res) {
                        if (res == 0) {
                            swal({
                                icon: "error",
                                title: "Book doesn't exists",
                                button: "Ok"
                            }).then(function(){
                                $('#book2').focus();
                                $('#book2').val("");
                            });
                        } else {
                            $('#formBook2Detail').html(res);
                        }
                    }
                });
            }
        })
     })
</script>