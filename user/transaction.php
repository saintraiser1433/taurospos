<?php 
include '../connection.php';

if(!isset($_SESSION['borrower_id'])){
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
    <?php include '../components/usersidebar.php' ?>
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
                            Returned Date
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
                       a.transaction_id,
                       a.item_code,
                       b.item_name,
                       a.quantity,
                       a.start_date,
                       a.expected_return_date,
                       a.status
                   FROM
                       tbl_transaction a
                   INNER JOIN tbl_item b ON
                       a.item_code = b.item_code
                   ORDER BY
                       a.date_created ASC";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['transaction_id'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['quantity'] ?></td>
                          <td class="sort-department text-capitalize">
                            <?php
                            if ($row['start_date'] == null) {
                              echo '-';
                            } else {
                              echo $row['start_date'];
                            }

                            ?>
                          </td>
                          <td class="sort-returnedate text-capitalize">
                            <?php
                            echo $row['expected_return_date'];
                            ?>
                          </td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">Partially Returned</span>';
                            } else if ($row['status'] == 2) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Waiting to Returned</span>';
                            } else if ($row['status'] == 3) {
                              echo '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">Waiting to Claim</span>';
                            } else if ($row['status'] == 4) {
                              echo '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">Rejected</span>';
                            } else if ($row['status'] == 5) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Cancelled</span>';
                            } else if ($row['status'] == 6) {
                              echo '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">For Approval</span>';
                            }else  if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Returned</span>';
                            }

                            
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($row['status'] == 3 ||  $row['status'] == 6) {
                              echo ' <a href="#" class="badge bg-danger cancel text-decoration-none" title="Reject">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
                              </a>';
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

  <?php include '../components/script.php' ?>

</body>

</html>
<script>
  $(document).ready(function() {
    $(document).on('click', '.cancel', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to cancelled this transaction?",
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
                action: 'CANCELLED'
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