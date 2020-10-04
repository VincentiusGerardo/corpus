<style>
    table td:first-child,
    table td:last-child,
    table td:nth-child(3) {
        text-align: center;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <h2>History</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="address">Please select History Type</label>
                    <select class="form-control" style="width: 100%;" id="selectHistory">
                        <option></option>
                        <option value="BOOKS">Books</option>
                        <option value="MEMBR">Member</option>
                        <option value="PNJAM">Loan</option>
                        <option value="KMBLI">Return</option>
                    </select>
                </div>
                <div id="detailHistory"></div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        $('#selectHistory').select2({
            theme: 'bootstrap4',
            placeholder: "Select History Type",
        });

        $('#selectHistory').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Ajax/getHistory') ?>',
                data: {
                    historyCode: $('#selectHistory').val()
                },
                dataType: 'html',
                beforeSend: function() {
                    $('#detailHistory').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                },
                success: function(res) {
                    if (res == 0) {
                        swal({
                            icon: "error",
                            title: "Data doesn't exists",
                            button: "Ok"
                        });
                    } else {
                        $('#detailHistory').html(res);
                    }
                }
            });
        });

        
        $('#tableHistory').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>