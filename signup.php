<?php
include 'connection.php';



?>
<!doctype html>

<html lang="en">

<?php include 'components/indexheader.php' ?>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container py-4">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">Sign up account</h2>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-lg-6 d-flex flex-column align-items-center">
                                        <h3>Front ID</h3>
                                        <img id="FrontID" src="static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">
                                        <br>
                                        <input type="file" name="front[]" id="filer_input_single" class="form-control" onchange="readURL(this,'FrontID');" required />

                                    </div>
                                    <div class="col-lg-6 d-flex flex-column align-items-center">
                                        <h3>Back ID</h3>
                                        <img id="BackID" src="static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">
                                        <br>
                                        <input type="file" name="back[]" id="filer_input_singles" class="form-control" onchange="readURL(this,'BackID');" required />

                                    </div>


                                    <div class="col-lg-12 mt-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Borrower ID</label>
                                                    <input type="text" class="form-control" name="borrower" id="borrower">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="firstname" class="form-control" id="firstname" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="lastname" class="form-control" id="lastname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" name="middlename" class="form-control" id="middlename" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="number" name="phonenumber" class="form-control" id="phonenumber" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select class="form-select text-capitalize" name="department" id="department" required>
                                                        <option value="" selected>-</option>
                                                        <?php
                                                        $sql = "SELECT * FROM tbl_department where status=1 order by department_id asc";
                                                        $rs = $conn->query($sql);
                                                        foreach ($rs as $row) {
                                                        ?>
                                                            <option value="<?php echo $row['department_id'] ?>"><?php echo $row['department_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Type</label>
                                                    <select class="form-select text-capitalize" name="itemType" id="itemType" required>
                                                        <option value="" selected>-</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Faculty">Faculty</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" name="username" class="form-control" id="username" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button type="button" name="submit" id="signin" class="btn btn-primary w-100">Register</button>

                                </div>

                                <div class="d-flex flex-column align-items-center mt-3">
                                    <a href="index.php">Back to login</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->


    <?php include 'components/indexscript.php' ?>


</body>

</html>
<script>
    function readURL(input, targets) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + targets).attr('src', e.target.result);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {

        $(document).on('click', '#signin', function(e) {
            e.preventDefault();
            var front = document.getElementById('filer_input_single');
            var back = document.getElementById('filer_input_singles');
            var formData = new FormData();
            formData.append('borrowerID', $('#borrower').val());
            formData.append('fname', $('#firstname').val());
            formData.append('lname', $('#lastname').val());
            formData.append('mname', $('#middlename').val());
            formData.append('phone', $('#phonenumber').val());
            formData.append('department', $('#department').val());
            formData.append('type', $('#itemType').val());
            formData.append('username', $('#username').val());
            formData.append('password', $('#password').val());
            formData.append('front', front.files[0]);
            formData.append('back', back.files[0]);
            formData.append('action', 'SIGNUP');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this data?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            method: "POST",
                            url: "ajax/signup.php",
                            data: formData,
                            processData: false, // Prevent jQuery from processing the data
                            contentType: false,
                            success: function(html) {
                                swal("Success", {
                                    icon: "success",
                                }).then((value) => {
                                    // location.reload();
                                });
                            }
                        });
                    }
                });
        });
    });
</script>