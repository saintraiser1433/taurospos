<?php
include '../connection.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location:../index.php");
}



?>

<!doctype html>

<html lang="en">
<?php include '../components/head.php' ?>
<?php include '../components/script.php' ?>

<body class="layout-fluid">

  <div class="page">
    <!-- Navbar -->
    <?php include '../components/navbaradmin.php' ?>
    <?php include '../components/sidebar.php' ?>
    <div class="page-wrapper">
      <!-- Page header -->
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-deck row-cards d-flex justify-content-center my-auto mx-auto">
            <div class="col-lg-5">
              <div class="card ">
                <div class="card-status-bottom bg-green"></div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <h2 class="h2 text-center mb-4">
                            <?php

                            if (isset($_GET['type'])) {
                              if ($_GET['type'] == 'penalties') {
                                echo 'PENALTY REPORT';
                              } else if ($_GET['type'] == 'stock') {
                                echo 'STOCK REPORT';
                              } else if ($_GET['type'] == 'retirement') {
                                echo 'RETIREMENT REPORT';
                              } else {
                                echo 'Transactional Report';
                              }
                            } else {
                              echo 'Transactional Report';
                            }


                            ?>

                          </h2>
                          <form action="" method="post">
                            <div class="col-lg-12 mt-3">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="mb-3">
                                    <label class="form-label">From Date:</label>
                                    <div class="input-icon">
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
                                      <input class="form-control fromdate" placeholder="Select a date" id="datepicker-icon-prepend" value="2024-03-01" />
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="mb-3">
                                    <label class="form-label">To Date:</label>
                                    <div class="input-icon">
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
                                      <input class="form-control todate" placeholder="Select a date" id="datepicker-to" value="2024-03-25" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <?php
                              if (isset($_GET['type'])) {
                                if ($_GET['type'] == 'transaction') {
                                  echo ' <div class="row">
                                <div class="col-lg-12">
                                  <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select text-capitalize itemType" name="itemType" id="itemType" required>
                                      <option value="" selected>-</option>
                                      <option value="6">For Approval</option>
                                      <option value="5">Cancelled</option>
                                      <option value="4">Rejected</option>
                                      <option value="3">Waiting to claim</option>
                                      <option value="2">Waiting to returned</option>
                                      <option value="1">Partially Returned</option>
                                      <option value="0">Returned</option>
                                    </select>
                                  </div>
                                </div>
                              </div>';
                                }
                              }
                              ?>

                            </div>
                            <div class="form-footer">
                              <button type="button" name="submit" class="btn btn-primary w-100 print">Print</button>
                            </div>
                          </form>
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
  <?php include '../components/modal.php' ?>



</body>

</html>
<script>
  $(window).bind('unload', function() {
    $.ajax({
      url: "../ajax/setUpdate.php",
      method: "GET",
      data: {
        type: 1,
        admin_id: <?php echo $_SESSION['admin_id'] ?>
      },
    });
  });
  $(document).ready(function() {

    $(document).on('click', '.print', function() {
      let fromdate = $('.fromdate').val();
      let todate = $('.todate').val();
      let itemType = $('.itemType').val();
      let action = '<?php echo $_GET['type'] ?>';
      $.ajax({
        url: "../ajax/generate_trans_report.php",
        method: "POST",
        data: {
          fromdate: fromdate,
          todate: todate,
          itemType: itemType,
          action: action
        },
        success: function(html) {
          if (html == 'No data found') {
            toastr.error("No data found");
          } else {
            if (action == 'transaction') {
              setInterval(function() {
                window.location.href = '../reports/outputs/transaction.pdf';
              }, 1000);
            } else if (action == 'penalties') {
              setInterval(function() {
                window.location.href = '../reports/outputs/penalties.pdf';
              }, 1000);
            } else if (action == 'stock') {
              setInterval(function() {
                window.location.href = '../reports/outputs/stockin.pdf';
              }, 1000);
            } else if (action == 'retirement') {
              setInterval(function() {
                window.location.href = '../reports/outputs/retirement.pdf';
              }, 1000);
            }

          }

        }
      })
    });




  });
</script>