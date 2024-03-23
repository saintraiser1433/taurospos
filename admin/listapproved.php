<?php
include '../connection.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location:../index.php");
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
                            Documents
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
                      a.borrower_id,
                      b.department_name
                  FROM
                      tbl_borrower a
                  LEFT JOIN tbl_department b ON
                      a.department_id = b.department_id
                  WHERE a.status = 0 and a.status_approval = 0
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
                            <a href="#" class="badge bg-info documents">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-script" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                              </svg>
                            </a>
                          </td>
                          <td>
                            <a href="#" class="badge bg-green edit">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 16m0 1a1 1 0 0 1 1 -1h1a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1z" />
                                <path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3" />
                              </svg>
                            </a> |
                            <a href="#" class="badge bg-red delete">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 14m0 1a1 1 0 0 1 1 -1h1a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1z" />
                                <path d="M6 15a1 1 0 0 1 1 -1h3.756a1 1 0 0 1 .958 .713l1.2 3c.09 .303 .133 .63 -.056 .884c-.188 .254 -.542 .403 -.858 .403h-2v2.467a1.1 1.1 0 0 1 -2.015 .61l-1.985 -3.077v-4z" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 11v-6a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.5" />
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
    });
  });
  $(document).ready(function() {
    function sendSMS(id, action) {
      $.ajax({
        url: "../ajax/sendsms.php",
        method: "POST",
        data: {
          examne: id,
          action: action
        },
        dataType: "text",
        success: function(html) {
          location.reload();

        }
      });
    }
    $(document).on('click', '.edit', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to approved this user?",
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
                action: 'UPDATE'
              },
              success: function(html) {
                swal("Success", {
                  icon: "success",
                }).then((value) => {
                  // sendSMS(col1, 'APPROVE');
                  location.reload();
                });
              }
            });
          }
        });
    });

    $(document).on('click', '.documents', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      $('#modal-documents').modal('show');
      $('#FrontID').attr('src', `../static/front/${col1}.png`)
      $('#BackID').attr('src', `../static/back/${col1}.png`)

      // var currentRow = $(this).closest("tr");
      // var col1 = currentRow.find("td:eq(0)").text();
      // swal({
      //     title: "Are you sure?",
      //     text: "You want to approved this user?",
      //     icon: "warning",
      //     buttons: true,
      //     dangerMode: true,
      //   })
      //   .then((isConfirm) => {
      //     if (isConfirm) {
      //       $.ajax({
      //         method: "POST",
      //         url: "../ajax/approval.php",
      //         data: {
      //           id: col1,
      //           action: 'UPDATE'
      //         },
      //         success: function(html) {
      //           swal("Success", {
      //             icon: "success",
      //           }).then((value) => {
      //             location.reload();
      //           });
      //         }
      //       });
      //     }
      //   });
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to reject this user?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            swal("Successfull rejected", {
              icon: "success",
            }).then((value) => {
              // sendSMS(col1, 'REJECT');
              location.reload();
            });
          }
        });
    });
  });
</script>