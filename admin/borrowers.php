<?php
include '../connection.php';
if (!isset($_SESSION['admin_id'])) {
  header("Location:../index.php");
}

if (isset($_GET['stat']) && $_GET['stat'] != '' && isset($_GET['brw']) && $_GET['brw'] != '') {
  $stat = $_GET['stat'];
  $borrower = $_GET['brw'];

  if ($stat == 0) {
    $sql = "UPDATE tbl_borrower SET status=1 where borrower_id='312312'";
    $conn->query($sql);
  } else if ($stat == 1) {
    $sql = "UPDATE tbl_borrower SET status=0 where borrower_id='312312'";
    $conn->query($sql);
  }
}

?>

<!doctype html>

<html lang="en">
<?php include '../components/head.php' ?>

<body class=" layout-fluid">

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
                Borrower Panel
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">

                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                </a>
              </div>
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
                            Borrower ID
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Full Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Type
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Department
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Phone
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
                          a.first_name,
                          ', ',
                          a.last_name,
                          ' ',
                          LEFT(a.middle_name, 1)
                      ) AS fname,
                      a.borrower_id,
                      a.type,
                      a.status,
                      a.phone_number,
                      a.front_id_path,
                      a.back_id_path,
                      b.department_name
                  FROM
                      tbl_borrower a
                  LEFT JOIN tbl_department b ON
                      a.department_id = b.department_id
                  WHERE (a.status = 0 OR a.status = 1) and status_approval = 1
                  ORDER BY
                      a.department_id ASC";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['borrower_id'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['fname'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['type'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['department_name'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['phone_number'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 1) {
                              echo '<a href="?stat=0&brw=' . $row['borrower_id'] . '"><span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Active</span></a>';
                            } else if ($row['status'] == 0) {
                              echo '<a href="?stat=1&brw=' . $row['borrower_id'] . '"><span class="badge badge-sm bg-red text-uppercase ms-auto text-white">Inactive</span></a>';
                            }
                            ?>
                          </td>
                          <td>
                            <a href="#" class="badge bg-info viewtrans">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
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
  <?php include '../components/script.php' ?>

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

  function getDetails(data) {
    $.ajax({
      method: "POST",
      url: "../ajax/transborrow.php",
      data: {
        getBorrowID: data,
        action: 'SHOW-TRANSACTION'
      },
      success: function(response) {
        // Clear existing data first
        $('#mytransaction').empty();
        // Iterate over each object in the response array
        for (var i = 0; i < response.length; i++) {
          var item = response[i];
          // Define a variable to hold the status badge HTML
          var statusBadge;
          if (item.status == 0) {
            statusBadge = '<span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span>';
          } else if (item.status == 1) {
            statusBadge = '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">Partially Returned</span>';
          } else if (item.status == 2) {
            statusBadge = '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Waiting to return</span>';
          } else if (item.status == 3) {
            statusBadge = '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">Waiting to claim</span>';
          } else if (item.status == 4) {
            statusBadge = '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">Rejected</span>';
          } else if (item.status == 5) {
            statusBadge = '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">Cancelled</span>';
          } else if (item.status == 6) {
            statusBadge = '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">For Approval</span>';
          }

          $('#mytransaction').append(
            `<tr>
                <td>${item.transaction_no}</td>
                <td>${item.borrower_name}</td>
                <td>${item.start_date}</td>
                <td>${item.expected_return_date}</td>
                <td>${item.return_date}</td>
                <td>${statusBadge}</td>
                <td><a href="myborrow.php?trans_no=${item.transaction_no}" class="badge bg-primary details text-decoration-none" title="View Details">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.999 3l.001 17" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                              </svg>
                            </a></td>
                </tr>`
          );

        }

      },
      error: function(xhr, status, error) {
        console.error(error); // Log any errors for debugging
      }
    });
  }


  $(document).ready(function() {
    $(document).on('click', '.viewtrans', function() {
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      $('#modal-trans').modal('show');
      getDetails(data[0]);
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(4)").text();
      swal({
          title: "Are you sure?",
          text: "You want to reject this user?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/approval.php",
              data: {
                id: col1,
                action: 'DELETE'
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