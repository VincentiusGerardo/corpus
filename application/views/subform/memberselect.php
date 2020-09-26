<div class="form-group">
    <label for="email">Member ID:</label>
    <input type="text" class="form-control" name="member" id="member" placeholder="Please insert Member ID">
    <div class="help-block with-errors"></div>
</div>
<div id="formMemberDetail"></div>
<script>
    $(function() {
        var member = $('#member');
        member.keydown(function(e) {
            if (e.keyCode == 13 && member.val()) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('Ajax/getUser') ?>',
                    data: {
                        memberID: member.val()
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('#formMemberDetail').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                    },
                    success: function(res) {
                        if (res == 0) {
                            swal({
                                icon: "error",
                                title: "Member doesn't exists",
                                button: "Ok"
                            }).then(function(){
                                member.focus();
                                member.val("");
                            });
                        } else {
                            $('#formMemberDetail').html(res);
                            $('#book1').focus();
                        }
                    }
                });
            }
        })
    });
</script>