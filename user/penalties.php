<?php include '../connection.php';
if (!isset($_SESSION['borrower_id'])) {
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
                Penalties
              </h2>
            </div>
            <!-- Page title actions -->

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
                          <button class="table-sort" data-sort="sort-category">
                            Transaction No
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Borrower Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Penalty
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Status
                          </button>
                        </th>
                        <th class="d-none"></th>

                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $id = $_SESSION['borrower_id'];
                      $sql = "SELECT
                      a.amount,
                      a.status,
                      a.transaction_no,
                      a.penalty_id,
                      'OVERDUE' AS remarks,
                      CONCAT(
                          c.first_name,
                          ', ',
                          c.last_name,
                          ' ',
                          LEFT(c.middle_name, 1)
                      ) AS borrower_name
                  FROM
                      tbl_penalty a
                  INNER JOIN tbl_transaction_header b ON
                      a.transaction_no = b.transaction_no
                  INNER JOIN tbl_borrower c ON
                      b.borrower_id = c.borrower_id
                  WHERE b.borrower_id = '$id'
                  ORDER BY
                      a.status ASC";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $i++ ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['transaction_no'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['borrower_name'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['amount'] ?></td>
                          <td class="sort-category text-capitalize"><?php
                                                                    if ($row['status'] == 0) {
                                                                      echo '<span class="badge badge-sm bg-danger text-uppercase ms-auto text-white">NOT PAID</span>';
                                                                    } else if ($row['status'] == 1) {
                                                                      echo '<span class="badge badge-sm bg-success text-uppercase ms-auto text-white">PAID</span>';
                                                                    }
                                                                    ?>
                          </td>

                          <td class="d-none"><?php echo $row['penalty_id'] ?></td>
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
  $(document).ready(function() {

    $(document).on('click', '.paid', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(6)").text();
      swal({
          title: "Are you sure?",
          text: "This borrower is paid? this can't be undo",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/penalty.php",
              data: {
                penaltyId: col1,
                action: 'ADD',
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