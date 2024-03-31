<?php
include '../connection.php';


if (isset($_GET['ac'])) {
  $id = $_GET['ac'];
  $sql = "SELECT * FROM tbl_inventory where item_code='$id'";
  $rs = $conn->query($sql);
  $row = $rs->fetch_assoc();
  $itemcode = $row['item_code'];
  $category = $row['category_id'];
  $description = $row['description'];
  $itemname = $row['item_name'];
  $price = $row['price'];
  $status = $row['status'] === '1' ? 'checked' : '';
  $photo = $row['img_path'];
  $id = 1;
  $isUpdate = true;
} else {
  $itemcode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
  $category = "";
  $description = "";
  $itemname = "";
  $price = "";
  $status = "";
  $id = 0;
  $photo = "no-image.png";
  $isUpdate = false;
}


?>

<!DOCTYPE html>
<html lang="en">
<?php include '../components/head.php' ?>

<body class=" layout-fluid">
  <div class="page">
    <!-- Navbar -->
    <?php include '../components/navbaradmin.php' ?>
    <?php include '../components/sidebar.php' ?>
    <div class="page-wrapper">
      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">Add Item</h2>
            </div>
          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <form action="inventory.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Thumbnail</h3>
                  </div>
                  <div class="card-body">
                    <center>
                      <img id="ImgID" src="../static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">
                    </center><br>
                    <input type="file" name="files[]" id="filer_input_single" class="form-control" onchange="readURL(this);" />
                    </center>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">

                    <h3 class="card-title">Basic Information</h3>
                    <div class="flex-shrink-0">
                      <a href="items.php"><button type="button" class="btn btn-primary add">Back</button></a>
                    </div>

                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Item Code</label>
                          <input type="text" class="form-control" name="assetcode" id="assetcode" value="<?php echo $itemcode ?>" required readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label class="form-label">Item Name</label>
                          <input type="text" class="form-control" name="itemname" id="itemname" value="<?php echo $itemname ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label class="form-label">Category</label>
                          <select class="form-select text-capitalize" name="category" id="category" required>
                            <option value="" selected>-</option>
                            <?php
                            $sql = "SELECT * FROM tbl_category order by category_id asc";
                            $rs = $conn->query($sql);
                            foreach ($rs as $row) {
                            ?>
                              <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Item Description</label>
                          <textarea class="form-control" name="description" rows="4" id="description"><?php echo $description ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Price</label>
                          <input type="text" class="form-control" name="price" id="price" value="<?php echo $price ?>" onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <?php if (isset($_GET['ac'])) { ?>
                        <div class="col-lg-12">
                          <div class="mb-3 my-switch">
                            <label class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="status" <?php echo $status ?>>
                              <span class="form-check-label">Status</span>
                            </label>
                          </div>
                        </div>
                      <?php } ?>
                      <button type="button" class="btn btn-primary ms-auto" name="submit" id="submit">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M12 5l0 14" />
                          <path d="M5 12l14 0" />
                        </svg>
                        Save
                      </button>

                    </div>
                  </div>

                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
      <?php include '../components/footer.php'; ?>
    </div>
  </div>

  <!-- modals -->


  <?php include '../components/script.php' ?>



  <?php
  if (isset($_SESSION['response']) && $_SESSION['response'] != "") {

  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['response']; ?>",
        icon: "<?php echo $_SESSION['type']; ?>",
        button: "Exit!",
      })
    </script>
  <?php unset($_SESSION['response']);
  }
  ?>

  <script>
    function isNumberKey(event) {
      var charCode = (event.which) ? event.which : event.keyCode;

      // Allow only digits (0-9) and a single dot (.)
      if (charCode !== 46 && (charCode < 48 || charCode > 57)) {
        return false;
      }

      // Allow only one dot (.)
      if (charCode === 46 && event.target.value.includes('.')) {
        return false;
      }

      return true;
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#ImgID').attr('src', e.target.result);

        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $(document).ready(function() {

      $('#category').val('<?php echo $category ?>');
      $('#ImgID').attr('src', '../static/item/<?php echo $photo ?>');
      let id = <?php echo $id ?>;
      $(document).on('click', '#submit', function(e) {
        e.preventDefault();
        let title;
        if (id === 0) {
          title = "You want to add this data?";
        } else {
          title = "You want to update this data?";
        }
        var status = $('#status').prop('checked');
        if (status) {
          checkStatus = 1;
        } else {
          checkStatus = 0;
        }

        var fileInput = document.getElementById('filer_input_single');
        var formData = new FormData();
        formData.append('assetcode', $('#assetcode').val());
        formData.append('itemname', $('#itemname').val());
        formData.append('category', $('#category').val());
        formData.append('description', $('#description').val());
        formData.append('price', $('#price').val());
        formData.append('status', checkStatus);
        formData.append('files', fileInput.files[0]);
        if (id === 0) {
          formData.append('action', 'ADD');
        } else {
          formData.append('action', 'UPDATE');
        }
        swal({
            title: "Are you sure?",
            text: title,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((isConfirm) => {
            if (isConfirm) {
              if (id === 0) {
                $.ajax({
                  method: "POST",
                  url: "../ajax/server-inventory.php",
                  data: formData,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function(html) {
                    swal("Success", {
                      icon: "success",
                    }).then((value) => {
                      window.location.href = "items.php";
                    });
                  }
                });
              } else {
                $.ajax({
                  method: "POST",
                  url: "../ajax/server-inventory.php",
                  data: formData,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function(html) {
                    swal("Successfully Updated", {
                      icon: "success",
                    }).then((value) => {
                      window.location.href = "items.php";
                    });
                  }
                });
              }
            }
          });
      });


    });
  </script>
</body>

</html>