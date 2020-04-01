<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Book Loan</h1>
                    <hr>
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Member Select</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Book 1</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Book 2</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>Terms and Conditions</small></a></li>
                        </ul>

                        <div>
                            <div id="step-1">
                                <h2>Member Select</h2>
                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <form id="formMember">
                                        <div class="form-group">
                                            <label for="email">Member ID:</label>
                                            <input type="text" class="form-control" name="memberID" id="member" placeholder="Please insert Member ID" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </form>
                                    <div id="formMemberDetail"></div>
                                </div>

                            </div>
                            <div id="step-2">
                                <h2>Book 1</h2>
                                <div id="form-step-1" role="form" data-toggle="validator">
                                    <form id="formBook1">
                                        <div class="form-group">
                                            <label for="name">Book ID:</label>
                                            <input type="text" class="form-control inputs" name="bookID" id="book1" placeholder="Please insert Book ID" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </form>
                                    <div id="formBook1Detail"></div>
                                </div>
                            </div>
                            <div id="step-3">
                                <label for="address">Borrow another book?</label> &emsp;
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio">Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio">No
                                    </label>
                                </div>
                                <div id="forBook2">
                                    <h2>Book 2</h2>
                                    <div id="form-step-2" role="form" data-toggle="validator">
                                        <form id="formBook2">
                                            <div class="form-group">
                                                <label for="address">Book 2</label>
                                                <input type="text" class="form-control inputs" name="bookID" id="book2" placeholder="Please insert Book ID" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </form>
                                        <div id="formBook2Detail"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4" class="">
                                <h2>Terms and Conditions</h2>
                                <p>
                                    Terms and conditions: Keep your smile :)
                                </p>
                                <div id="form-step-3" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="terms">I agree with the T&C</label>
                                        <input type="checkbox" id="terms" data-error="Please accept the Terms and Conditions" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $('#member').focus();
        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            keyNavigation: false, // True to enable change from arrow key left/right. False to disable so can't move without input
            showStepURLhash: false,
            backButtonSupport: false,
            theme: 'dots',
            transitionEffect: 'fade',
            anchorSettings: {
                markDoneStep: true, // add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: false, // Enable/Disable the done steps navigation
            },
            toolbarSettings: {
                showPreviousButton: false
            }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
            if (stepDirection === 'forward' && elmForm) {
                elmForm.validator('validate');
                var elmErr = elmForm.children('.has-error');
                if (elmErr && elmErr.length > 0) {
                    // Form validation failed
                    return false;
                }
            }
            $(stepNumber).focus();
            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // disable for each step

            // Enable finish button only on last step
            if (stepNumber == 0 || stepNumber == 1 || stepNumber == 2 || stepNumber == 3) {
                $('.sw-btn-next').css('display', 'none');
            }
        });

        // for hiding button before data is inserted
        if ($('#member').empty() || $('#book1').empty() || $('#book2').empty()) {
            $('.sw-btn-next').css("display", "none");
        } else {
            $('.sw-btn-next').css("display", "");
        }

        // Get Data from each form
        $("#formMember").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Ajax/getUser') ?>',
                data: $('#formMember').serialize(),
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
                        });
                        $('.sw-btn-next').css("display", "none");
                    } else {
                        $('#formMemberDetail').html(res);
                        $('.sw-btn-next').css("display", "");
                    }
                }
            });
        });

        $("#formBook1").submit(function(e) {
            e.preventDefault();
            var val = $('#book1').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Ajax/getBookDetail') ?>',
                data: {
                    book: val
                },
                beforeSend: function() {
                    $('#formBook1Detail').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                },
                success: function(res) {
                    if (res == 0) {
                        swal({
                            icon: "error",
                            title: "Book doesn't exists",
                            button: "Ok"
                        });
                        $('.sw-btn-next').css("display", "none");
                    } else {
                        $('#formBook1Detail').html(res);
                        $('.sw-btn-next').css("display", "");
                    }
                }
            });
        });

        $("#formBook2").submit(function(e) {
            e.preventDefault();
            var value = $('#book2').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Ajax/getBookDetail') ?>',
                data: {
                    book: value
                },
                beforeSend: function() {
                    $('#formBook2Detail').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
                },
                success: function(res) {
                    if (res == 0) {
                        swal({
                            icon: "error",
                            title: "Book doesn't exists",
                            button: "Ok"
                        });
                        $('.sw-btn-next').css("display", "none");
                    } else {
                        $('#formBook2Detail').html(res);
                        $('.sw-btn-next').css("display", "");
                    }
                }
            });
        });

        $("#terms").change(function() {
            if ($('#terms').is(':checked')) {
                // next
                $('.sw-btn-next').css("display", "");
                $('.sw-btn-next').removeClass('disabled');
                $('.sw-btn-next').removeClass('btn-secondary');
                $('.sw-btn-next').text('Submit');
                $('.sw-btn-next').addClass('btn-primary');
                $('.sw-btn-next').click(function() {
                    alert('Form di submit');
                });

                // prev
                $('.sw-btn-prev').removeClass('disabled');
                $('.sw-btn-prev').removeClass('btn-secondary');
                $('.sw-btn-prev').text('Cancel');
                $('.sw-btn-prev').addClass('btn-danger');
                $('.sw-btn-prev').click(function() {
                    $('#smartwizard').smartWizard("reset");
                    location.reload();
                    // $('#myForm').removeAttr('value');
                });
                //$('.sw-btn-next').css("display", "");
                // alert('ini di check');
            } else {
                $('.sw-btn-next').css("display", "none");
                // alert('ini ga di check');
            }
        });
    });
</script>