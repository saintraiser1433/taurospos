<?php
include '../connection.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location:../index.php");
}
if (!isset($_GET['trans_no'])) {
  header("Location:borrowers.php");
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
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                Transaction
              </h2>
            </div>

          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="card">
            <div class="card-status-bottom bg-success"></div>
            <div class="card-body">
              <div id="listjs">
                <div class="d-flex align-items-center justify-content-between">
                  <div></div>
                  <div class="flex-shrink-0">
                    <input class="form-control listjs-search" id="search-input" placeholder="Search" style="max-width: 200px;" />
                  </div>
                </div>
                <br>
                <div id="pagination-container"></div>
                <div id="table-default" class="table-responsive">
                  <table class="table" id="tables">
                    <thead>
                      <tr>
                        <th>
                          <button class="table-sort" data-sort="sort-id">
                            #
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-id">
                            Item Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Quantity
                          </button>
                        </th>

                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Returned Quantity
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Status
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $trans = $_GET['trans_no'];
                      $sqlt = "SELECT
                     b.item_name,
                     SUM(a.quantity) as qty,
                     a.return_quantity,
                     a.status
                 FROM
                     tbl_transaction_detail a
                 INNER JOIN tbl_item b ON
                     a.item_code = b.item_code
                 INNER JOIN tbl_transaction_header c ON
                     a.transaction_no = c.transaction_no
                 WHERE
                     a.transaction_no = '$trans'
                 group by a.item_code";
                      $rs = $conn->query($sqlt);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $i++ ?></td>
                          <td class="sort-id"><?php echo $row['item_name'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['qty'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['return_quantity'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span>';
                            } else if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">Partially Returned</span>';
                            } else if ($row['status'] == 2) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Waiting to Return</span>';
                            } else if ($row['status'] == 3) {
                              echo '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">Waiting to Claim</span>';
                            } else if ($row['status'] == 4) {
                              echo '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">For Approval</span>';
                            }
                            ?>
                          </td>

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <div class="btn-toolbar">
                    <p class="mb-0" id="listjs-showing-items-label">Showing 0 items</p>
                    <ul class="pagination ms-auto mb-0"></ul>
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
<?php include '../dist/xx_close_api_admin.php' ?>
</html>
<script>

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
              statusBadge = '<span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span>';
            } else {
              statusBadge = '<span class="badge badge-sm bg-danger text-uppercase ms-auto text-white">Invalid</span>';
            }
            if (item.status == 1 || item.status == 2) {
              $('#act').show();
              $('.thedata').append(
                `<tr>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td>${item.return_quantity}</td>
                <td>${statusBadge}</td>
                <td><div class="d-flex justify-start-between gap-3">
                          <div class="input-group" style="width:140px">
                            <button class="input-group-text h-75" id="minus">-</button>
                            <input type="text" class="form-control text-center h-75" id="counter" value="1" autocomplete="off" readonly data-current-quantity="${item.qty}" data-return-quantity="${item.return_quantity}">
                            <button class="input-group-text h-75" id="add">+</button>
                          </div>
                          <div>
                          <a href="#" class="badge bg-success ok">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                          </a> 
                          </div>
                         
                     </div>
                     
                 </td>
                 <td class="d-none">${item.trans_item_id}</td>
                 <td class="d-none">${item.item_code}</td>
                 <td class="d-none">${item.transaction_no}</td>
                 <td class="d-none">${item.borrower_id}</td>
                </tr>`
              );
            } else if (item.status == 0) {
              $('#act').show();
              $('.thedata').append(
                `<tr>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td>${item.return_quantity}</td>
                <td>${statusBadge}</td>
                <td>Complete</td>
                </tr>`
              );
            } else {
              $('.thedata').append(
                `<tr>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td>${item.return_quantity}</td>
                <td>${statusBadge}</td>

                </tr>`
              );
            }

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
      var id = currentRow.find("td:eq(8)").text();
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
                  if (html == 'ok') {
                    $.ajax({
                      url: "../ajax/sendsms.php",
                      method: "POST",
                      data: {
                        examne: id,
                        action: 'OVERDUE'
                      },
                      dataType: "text",
                      success: function(html) {
                        location.reload();

                      }
                    });
                  }
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