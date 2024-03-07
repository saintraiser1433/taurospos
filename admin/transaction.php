<?php 
include '../connection.php';
if(!isset($_SESSION['admin_id'])){
  header("Location:../index.php");
}

?>

<!doctype html>

<html lang="en">
<?php include '../components/head.php' ?>

<body class=" layout-fluid">

  <div class="page">
    <!-- Navbar -->
    <?php include '../components/navbar.php' ?>
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
                          <button class="table-sort" data-sort="sort-department">
                            Item Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Quantity
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
                            Returned Qty
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
                        <th class="d-none"></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $sql = "SELECT
                      CONCAT(
                          c.last_name,
                          ', ',
                          c.first_name,
                          ' ',
                          LEFT(C.middle_name, 1)
                      ) AS fname,
                      a.transaction_id,
                      a.item_code,
                      b.item_name,
                      a.quantity,
                      a.start_date,
                      a.return_date,
                      a.expected_return_date,
                      a.status,
                      a.return_quantity
                  FROM
                      tbl_transaction a
                  INNER JOIN tbl_item b ON
                      a.item_code = b.item_code
                  INNER JOIN tbl_borrower c ON
                      a.borrower_id = c.borrower_id
                  WHERE a.status IN (1,2,3,6)
                  ORDER BY
                      a.date_created ASC";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['transaction_id']?></td>
                          <td class="sort-id"><?php echo $row['fname'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['quantity'] ?></td>
                          <td class="sort-department text-capitalize">
                            <?php
                            if ($row['start_date'] == '0000-00-00') {
                              echo '----------';
                            } else {
                              echo date('M-d-Y',strtotime($row['start_date']));
                            }

                            ?>
                          </td>
                          <td class="sort-returnedate text-capitalize">
                            <?php
                            if ($row['expected_return_date'] == '0000-00-00') {
                              echo '----------';
                            } else {
                              echo date('M-d-Y',strtotime($row['expected_return_date']));
                            }
                            ?>
                          </td>
                          <td><?php 
                          if($row['return_quantity'] == 0){
                            echo '----------';
                          }else{
                            echo $row['return_quantity'];
                          }
                          ?>
                          
                         </td>
                          <td>
                          <?php
                            if ($row['return_date'] == '0000-00-00') {
                              echo '----------';
                            } else {
                              echo date('M-d-Y',strtotime($row['return_date']));
                            }
                            ?>
                          </td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">RETURNED</span>';
                            } else if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">PARTIALLY RETURNED</span>';
                            } else if ($row['status'] == 2) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">WAITING TO RETURNED</span>';
                            } else if ($row['status'] == 3) {
                              echo '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">WAITING TO RECEIVED</span>';
                            } else if ($row['status'] == 4) {
                              echo '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">REJECTED</span>';
                            } else if ($row['status'] == 5) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">CANCELLED</span>';
                            } else {
                              echo '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">FOR APPROVAL</span>';
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($row['status'] == 1 || $row['status'] == 2) {
                              echo '<a href="#" class="badge bg-info return text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 14l-4 -4l4 -4" /><path d="M8 14l-4 -4l4 -4" /><path d="M9 10h7a4 4 0 1 1 0 8h-1" /></svg></a>';
                            } else if ($row['status'] == 3) {
                              echo '<a href="#" class="badge bg-info receive   text-decoration-none" title="Receive"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hand-grab" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 11v-3.5a1.5 1.5 0 0 1 3 0v2.5" /><path d="M11 9.5v-3a1.5 1.5 0 0 1 3 0v3.5" /><path d="M14 7.5a1.5 1.5 0 0 1 3 0v2.5" /><path d="M17 9.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" /></svg></a>';
                            } else if ($row['status'] == 6) {
                              echo '<a href="#" class="badge bg-success approved text-decoration-none" title="Approved">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-up-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z" stroke-width="0" fill="currentColor" /><path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z" stroke-width="0" fill="currentColor" /></svg>
                              </a> | 
                              <a href="#" class="badge bg-danger reject text-decoration-none" title="Reject">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 21.008a3 3 0 0 0 2.995 -2.823l.005 -.177v-4h2a3 3 0 0 0 2.98 -2.65l.015 -.173l.005 -.177l-.02 -.196l-1.006 -5.032c-.381 -1.625 -1.502 -2.796 -2.81 -2.78l-.164 .008h-8a1 1 0 0 0 -.993 .884l-.007 .116l.001 9.536a1 1 0 0 0 .5 .866a2.998 2.998 0 0 1 1.492 2.396l.007 .202v1a3 3 0 0 0 3 3z" stroke-width="0" fill="currentColor" /><path d="M5 14.008a1 1 0 0 0 .993 -.883l.007 -.117v-9a1 1 0 0 0 -.883 -.993l-.117 -.007h-1a2 2 0 0 0 -1.995 1.852l-.005 .15v7a2 2 0 0 0 1.85 1.994l.15 .005h1z" stroke-width="0" fill="currentColor" /></svg>
                              </a>';
                            }
                            ?>
                          </td>
                          <td class="d-none"><?php echo $row['item_code'] ?></td>
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

  <?php include '../components/script.php' ?>

</body>

</html>
<script>
  $(document).ready(function() {
    let transId = 0;
    let itemcode = null;
    $(document).on('click', '.return', function() {
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      transId = data[0];
      itemcode = data[10];
      $('.md-title').html('Returned Items');
      $('#modal-return').modal('show');
    });


    $(document).on('click', '#returnSubmit', function(e) {
      e.preventDefault();
      var qty = parseInt($('#returnqty').val());
      swal({
          title: "Are you sure?",
          // text: "You want to approved this transaction?",
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
                qty : qty,
                item_code : itemcode,
                action: 'RETURN'
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
                transid: col1,
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
                transid: col1,
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
                transid: data[0],
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