<?php include '../connection.php' ?>

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
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Active</span>';
                            } else if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-red text-uppercase ms-auto text-white">Active</span>';
                            }
                            ?>

                          </td>
                          <td>
                            <a href="#" class="badge bg-yellow edit">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                              </svg>

                            </a> |
                            <a href="#" class="badge bg-red delete">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7h16" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                <path d="M10 12l4 4m0 -4l-4 4" />
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

  <?php include '../components/script.php' ?>

</body>

</html>
<script>
  $(document).ready(function() {
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