<div class="form-group">
    <label for="name">Book ID:</label>
    <input type="text" class="form-control inputs" name="book1" id="book1" placeholder="Please insert Book ID">
    <div class="help-block with-errors"></div>
</div>
<div id="formBook1Detail"></div>
<script>
    $(function () { 
        $('#book1').keydown(function(e) {
            if (e.keyCode == 13 && $('#book1').val()) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('Ajax/getBookDetail') ?>',
                    data: {
                        book: $('#book1').val()
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('#formBook1Detail').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                    },
                    success: function(res) {
                        if (res == 0) {
                            swal({
                                icon: "error",
                                title: "Book doesn't exists",
                                button: "Ok"
                            }).then(function (){
                                $('#book1').focus();
                                $('#book1').val("");
                            });
                        } else {
                            $('#formBook1Detail').html(res);
                            $('#book2').focus();
                        }
                    }
                });
            }
        })
     })
</script>