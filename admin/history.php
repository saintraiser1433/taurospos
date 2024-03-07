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
                History
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
                            Returned Date
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
                  WHERE a.status IN (0,4,5)
                  ORDER BY
                      a.date_created ASC";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['transaction_id']?></td>
                          <td class="sort-id"><?php echo $row['fname'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['quantity'] ?></td>
                          <td class="sort-id"> <?php
                            if ($row['return_date'] == '0000-00-00') {
                              echo '----------';
                            } else {
                              echo date('M-d-Y',strtotime($row['return_date']));
                            }
                            ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">RETURNED</span>';
                            } else if ($row['status'] == 4) {
                              echo '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">REJECTED</span>';
                            } else if ($row['status'] == 5) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">CANCELLED</span>';
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
