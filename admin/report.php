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
                          <h2 class="h2 text-center mb-4">Report Name: Transactional Report</h2>
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
                                      <input class="form-control" placeholder="Select a date" id="datepicker-icon-prepend" value="2020-06-20" />
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
                                      <input class="form-control" placeholder="Select a date" id="datepicker-icon-prepend" value="2020-06-20" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select text-capitalize" name="itemType" id="itemType" required>
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
                              </div>
                            </div>
                            <div class="form-footer">
                              <button type="button" name="submit" id="signin" class="btn btn-primary w-100">Print</button>
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
      success: function(html) {

      }
    });
  });
  $(document).ready(function() {

    function getDetails(data) {
      $.ajax({
        method: "POST",
        url: "../ajax/transborrow.php",
        data: {
          trans_code: data,
          action: 'GET'
        },
        success: function(response) {
          // Clear existing data first
          $('.thedata').empty();
          // Iterate over each object in the response array
          for (var i = 0; i < response.length; i++) {
            var item = response[i];
            // Define a variable to hold the status badge HTML
            var statusBadge;
            if (item.status == 4) {
              statusBadge = '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">For Approval</span>';
            } else if (item.status == 3) {
              statusBadge = '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">Waiting to claim</span>';
            } else if (item.status == 2) {
              statusBadge = '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Waiting to Returned</span>';
            } else if (item.status == 1) {
              statusBadge = '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">Partially Returned</span>';
            } else if (item.status == 0) {
              statusBadge = '';
            } else {
              statusBadge = '<span class="badge badge-sm bg-danger text-uppercase ms-auto text-white">Invalid</span>';
            }

            $('.thedata').append(
              `<tr>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td>${item.return_quantity}</td>
                <td><span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span></td>
                </tr>`
            );

          }

        },
        error: function(xhr, status, error) {
          console.error(error); // Log any errors for debugging
        }
      });
    }





    $(document).on('click', '.details', function() {
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      $('#modal-details').modal('show');
      getDetails(data[0]);
      transNo = data[0];
    });


    $(document).on('click', '#add', function() {
      var counterElement = $(this).siblings('input');
      var currentValue = parseInt(counterElement.val());
      var currentQuantity = parseInt(counterElement.data('current-quantity'));
      var returnQuantity = parseInt(counterElement.data('return-quantity'));
      var total = currentQuantity - returnQuantity;
      if (currentValue < total) {
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


    $(document).on('click', '.ok', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var transId = currentRow.find("td:eq(5)").text();
      var itemCode = currentRow.find("td:eq(6)").text();
      var transCode = currentRow.find("td:eq(7)").text();
      var counterElement = currentRow.find('input[type="text"]');
      var currentValue = parseInt(counterElement.val());
      swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                transid: transId,
                qty: currentValue,
                item_code: itemCode,
                trans_code: transCode,
                action: 'RETURN'
              },
              success: function(html) {
                swal("Success", {
                  icon: "success",
                }).then((value) => {
                  getDetails(transCode)
                });
              }
            });
          }
        });
    });


    $(document).on('click', '.approved', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to approved this transaction?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                trans_code: col1,
                action: 'APPROVED'
              },
              success: function(html) {
                swal("Success", {
                  icon: "success",
                }).then((value) => {
                  location.reload();
                });
              }
            });
          }
        });
    });

    // REJECT
    $(document).on('click', '.reject', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to reject this transaction?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                trans_code: col1,
                action: 'REJECT'
              },
              success: function(html) {
                swal("Success", {
                  icon: "success",
                }).then((value) => {
                  location.reload();
                });
              }
            });
          }
        });
    });


    $(document).on('click', '.receive', function(e) {
      e.preventDefault();
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      swal({
          title: "Are you sure?",
          text: "This can't be undo this action?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                trans_code: data[0],
                qty: data[3],
                code: data[10],
                action: 'RECEIVE'
              },
              success: function(html) {
                swal("Success", {
                  icon: "success",
                }).then((value) => {
                  location.reload();
                });
              }
            });
          }
        });
    });

  });
</script>