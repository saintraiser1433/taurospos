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
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                Returned Items
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
                            Transaction No #
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Borrower Name
                          </button>
                        </th>

                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Start Date
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Expected Returned Date
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Return Date
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Status
                          </button>
                        </th>
                        <th>
                          <button class="table-sort">
                            Action
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $sql = "SELECT
                      CONCAT(
                          b.first_name,
                          ', ',
                          b.last_name,
                          ' ',
                          LEFT(b.middle_name, 1)
                      ) AS borrower_name,
                      a.transaction_no,
                      a.start_date,
                      a.expected_return_date,
                      a.return_date,
                      a.status
                  FROM
                      tbl_transaction_header a
                  INNER JOIN tbl_borrower b ON
                      a.borrower_id = b.borrower_id
                  WHERE a.status = 0
                  ORDER BY
                      a.date_created
                  DESC";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['transaction_no'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['borrower_name'] ?></td>
                          <td class="sort-department text-capitalize">
                            <?php
                            if ($row['start_date'] == '0000-00-00') {
                              echo '-';
                            } else {
                              echo date('M-d-Y', strtotime($row['start_date']));
                            }

                            ?>
                          </td>
                          <td class="sort-returndate text-capitalize">
                            <?php
                            if ($row['expected_return_date'] == '0000-00-00') {
                              echo '-';
                            } else {
                              echo date('M-d-Y', strtotime($row['expected_return_date']));
                            }

                            ?>
                          </td>
                          <td class="sort-returnedate text-capitalize">
                            <?php
                            if ($row['return_date'] == '0000-00-00') {
                              echo '-';
                            } else {
                              echo date('M-d-Y', strtotime($row['return_date']));
                            }

                            ?>
                          </td>
                          <td class="sort-status">
                            <span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span>
                          </td>
                          <td>
                            <a href="#" class="badge bg-primary details text-decoration-none" title="View Details">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.999 3l.001 17" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                              </svg>
                            </a>
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