<?php include '../connection.php';


if (!isset($_SESSION['borrower_id'])) {
  header("Location:../index.php");
}


if (!isset($_GET['code'])) {
  header("Location:items.php");
}


?>
<!doctype html>
<html lang="en">
<?php include '../components/head.php' ?>

<body class="layout-fluid">

  <div class="page">
    <!-- Navbar -->
    <?php include '../components/navbar.php' ?>
    <?php include '../components/usersidebar.php' ?>
    <div class="page-wrapper">
      <!-- Page header -->

      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-deck row-cards d-flex justify-content-center my-auto mx-auto">
            <div class="col-lg-6">
              <div class="card ">
                <div class="card-status-bottom bg-success"></div>
                <div class="card-header">
                  <div>
                    <h3 class="card-title">
                      <?php
                      $code = $_GET['code'];
                      $sql = "SELECT
                       inv.item_name,
                       inv.item_code,
                       inv.quantity,
                       inv.img_path,
                       ts.size_description,
                       inv.description
                     FROM
                       tbl_item inv
                     LEFT JOIN tbl_size ts ON
                       inv.size_id = ts.size_id
                     WHERE
                       inv.item_code = '$code' AND inv.status = 1";
                      $rs = $conn->query($sql);
                      $row = $rs->fetch_assoc();
                      ?>
                      Item Code #: <?php echo $row['item_code'] ?>
                    </h3>
                    <p class="card-subtitle">
                    </p>
                  </div>
                  <div class="card-actions">
                    <a href="index.php" class="btn btn-secondary d-none d-sm-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12l10 0" />
                        <path d="M10 12l4 4" />
                        <path d="M10 12l4 -4" />
                        <path d="M4 4l0 16" />
                      </svg>
                    </a>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-lg-4">
                      <img id="ImgID" class="h-100 img-fluid border border-3 bg-secondary" src="../static/item/<?php echo $row['img_path'] ?>" style="border:2px solid gray">
                    </div>
                    <div class="col-lg-8">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <h4 class="text-capitalize">Item Name : <?php echo $row['item_name'] ?></h4>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <p class="text-muted"><?php echo $row['description'] ?></p>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <h4 class="text-capitalize">Size: <?php echo $row['size_description'] ?></h4>
                          </div>
                        </div>
                        <!-- <div class="d-flex justify-content-start align-items-center gap-2">
                          <h4 class="text-capitalize">Expected Returned Date: <span class="text-muted"></span></h4>
                         
                  </div> -->

                        <div class="col-lg-12">
                          <div class="mb-3">
                            <h4>Quantity: <?php echo $row['quantity'] ?> </h4>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-center">
                          <div class="input-group" style="width:140px">
                            <button class="input-group-text" id="minus">-</button>
                            <input type="text" class="form-control text-center" id="counter" value="1" autocomplete="off" data-current-quantity=<?php echo $row['quantity'] ?> readonly>
                            <button class="input-group-text" id="add">+</button>
                          </div>
                        </div>
                        <button class="btn btn-primary mt-2" id="proceed">Add to Cart</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include '../components/footer.php' ?>
  </div>
  </div>

  <?php include '../components/script.php' ?>

</body>

</html>

<script>
  $(window).bind('unload', function() {
    $.ajax({
      url: "../ajax/setUpdate.php",
      method: "GET",
      data: {
        type: 2,
        borrowid: '<?php echo $_SESSION['borrower_id'] ?>'
      },
    });
  });
  let counter = parseInt($('#counter').val());

  $(document).on('click', '#add', function() {
    var counterElement = $(this).siblings('input');
    var currentValue = parseInt(counterElement.val());
    var currentQuantity = parseInt(counterElement.data('current-quantity'));

    if (currentValue < currentQuantity) {
      counterElement.val(currentValue + 1);
    }
  });

  $(document).on('click', '#minus', function() {
    var counterElement = $(this).siblings('input');
    var currentValue = parseInt(counterElement.val());
    if (currentValue > 1) {
      counterElement.val(currentValue - 1);
    }
  });


  $(document).on('click', '#proceed', function(e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: "../ajax/cart.php",
      data: {
        item_code: '<?php echo $_GET['code'] ?>',
        quantity: counter,
        action: 'ADD'
      },
      success: function(html) {
        toastr.success("Successfully added to cart");
      }
    });
  });
</script>