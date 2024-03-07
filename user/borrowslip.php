<?php include '../connection.php';
$trn = substr(str_shuffle("01234567894578942"), 0, 8);

if(!isset($_SESSION['borrower_id'])){
  header("Location:../index.php");
}


if (isset($_GET['code'])) {
} else {
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
                <div class="card-status-bottom bg-green"></div>
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
                      Transaction #: <?php echo $trn ?>
                    </h3>
                    <p class="card-subtitle">
                    </p>
                  </div>
                  <div class="card-actions">
                    <a href="items.php" class="btn btn-secondary d-none d-sm-inline-block">
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
                        <div class="d-flex justify-content-start align-items-center gap-2">
                          <h4 class="text-capitalize">Expected Returned Date:</h4>
                          <div class="input-icon mb-3 w-50">
                            <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M11 15h1" />
                                <path d="M12 15v3" />
                              </svg>
                            </span>
                            <input class="form-control rtndate" placeholder="Select a date" id="datepicker-icon-prepend" value="" required />
                          </div>
                        </div>

                        <div class="col-lg-12">
                          <div class="mb-3">
                            <h4>Quantity: <?php echo $row['quantity'] ?> </h4>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-center">
                          <div class="input-group" style="width:140px">
                            <button class="input-group-text" id="minus">-</button>
                            <input type="text" class="form-control text-center" id="counter" value="1" autocomplete="off" readonly>
                            <button class="input-group-text" id="add">+</button>
                          </div>

                        </div>
                        <button class="btn btn-primary mt-2" id="proceed">Proceed</button>
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
  let counter = parseInt($('#counter').val());

  $('#add').on('click', function() {
    counter += 1;
    $('#counter').val(counter)
  });

  $('#minus').on('click', function() {
    counter -= 1;
    if (counter < 1) {
      counter = 1;
    }
    $('#counter').val(counter);

  });

  document.addEventListener("DOMContentLoaded", function() {
    window.Litepicker && (new Litepicker({
      element: document.getElementById('datepicker-icon-prepend'),
      buttonText: {
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
    }));
  });

  $(document).on('click', '#proceed', function(e) {
    e.preventDefault();
    let rdate = $('.rtndate').val();
    swal({
        title: "Are you sure?",
        text: "You want to borrow this item, This action won't undo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((isConfirm) => {
        if (isConfirm) {
          if (rdate == '') {
            swal("Please input returned date", {
              icon: "error"
            });
          } else {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                transaction_no: <?php echo $trn ?>,
                item_code: '<?php echo $_GET['code'] ?>',
                borrowerId: '<?php echo $_SESSION['borrower_id'] ?>',
                rtndate: rdate,
                counter: counter,
                action: 'ADD'
              },
              success: function(html) {
                swal("Waiting for approval by admin", {
                  icon: "info",
                }).then((value) => {
                  window.location.href = 'transaction.php'
                });
              }
            });
          }
        }
      });
  });
</script>