<?php
include 'connection.php';



?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SEAIT BORROWING SYSTEM</title>
    <!-- CSS files -->
    <link href="dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

</head>
<script src="../dist/js/demo-theme.min.js?1692870487"></script>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
            </div>
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
                                        <input type="file" name="files[]" id="filer_input_single" class="form-control" onchange="readURL(this,'FrontID');" required />

                                    </div>
                                    <div class="col-lg-6 d-flex flex-column align-items-center">
                                        <h3>Back ID</h3>
                                        <img id="BackID" src="static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">
                                        <br>
                                        <input type="file" name="files[]" id="filer_input_single" class="form-control" onchange="readURL(this,'BackID');" required />

                                    </div>


                                    <div class="col-lg-12 mt-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Borrower ID</label>
                                                    <input type="text" class="form-control" name="itemCode" id="itemCode" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="itemName" class="form-control" id="itemName" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="itemDescription" class="form-control" id="itemDescription" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" name="itemName" class="form-control" id="itemName" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text" name="itemDescription" class="form-control" id="itemDescription" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select class="form-select text-capitalize" name="itemCategory" id="itemCategory" required>
                                                        <option value="" selected>-</option>
                                                        <?php
                                                        $sql = "SELECT * FROM tbl_categories order by category_id asc";
                                                        $rs = $conn->query($sql);
                                                        foreach ($rs as $row) {
                                                        ?>
                                                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Type</label>
                                                    <select class="form-select text-capitalize" name="itemCategory" id="itemCategory" required>
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
                                                    <input type="text" name="itemName" class="form-control" id="itemName" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="text" name="itemDescription" class="form-control" id="itemDescription" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Sign in</button>

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


    <script src="dist/js/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="dist/libs/list.js/dist/list.min.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="dist/js/tabler.min.js?1684106062" defer></script>
    <script src="dist/js/demo.min.js?1684106062" defer></script>
    <script src="dist/js/list-datable.js"></script>
    <script src="dist/libs/sweetalert/sweetalert.js"></script>


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
</script>