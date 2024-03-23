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
                Department
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="#" class="btn btn-primary d-none d-sm-inline-block add">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                  Create new department
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
                            #
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Department
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
                        <th class="d-none"></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $sql = "SELECT * from tbl_department order by department_id asc";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $i++ ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['department_name'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Active</span>';
                            } else if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-red text-uppercase ms-auto text-white">Inactive</span>';
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
                          <td class="d-none"><?php echo $row['department_id'] ?></td>
                          <td class="d-none"><?php echo $row['status'] ?></td>
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
    let id = 0;
    $(document).on('click', '.add', function() {
      $('#modal-department').modal('show');
      $('.md-title').html('Insert Department');
      $('.my-switch').css('display', 'none');
      $('#departmentName').val('');
    });

    $(document).on('click', '.edit', function() {
      var currentRow = $(this).closest("tr");
      let stat = '';
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      if (data[5] == 1) {
        stat = 'checked'
      } else {
        stat = ''
      }
      id = data[4];
      $('#modal-department').modal('show');
      $('#departmentName').val(data[1])
      $('.md-title').html('Update Department');
      $('.my-switch').css('display', 'block');
      $('#departmentStatus').prop('checked', stat);
    });



    $(document).on('click', '#submit', function(e) {
      e.preventDefault();
      let checkStatus = 0;
      var description = $('#departmentName').val();
      var status = $('#departmentStatus').prop('checked');
      if (status) {
        checkStatus = 1;
      } else {
        checkStatus = 0;
      }
      swal({
          title: "Are you sure?",
          text: "You want to add this data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            if (id === 0) {
              $.ajax({
                method: "POST",
                url: "../ajax/department.php",
                data: {
                  description: description,
                  action: 'ADD'
                },
                success: function(response) {
                  response = JSON.parse(response);
                  if (response.error) {
                    swal("Error", response.error, "error");
                  } else {
                    swal(response.success, {
                      icon: "success",
                    }).then((value) => {        
                      location.reload();
                    });

                  }
                },
                error: function(xhr, status, error) {
                  swal("Error", error, "error");
                }
              });
            } else {
              $.ajax({
                method: "POST",
                url: "../ajax/department.php",
                data: {
                  id: id,
                  description: description,
                  status: checkStatus,
                  action: 'UPDATE'
                },
                success: function(response) {
                  response = JSON.parse(response);
                  if (response.error) {
                    swal("Error", response.error, "error");
                  } else {
                    swal(response.success, {
                      icon: "success",
                    }).then((value) => {
                      location.reload();
                    });

                  }
                },
                error: function(xhr, status, error) {
                  swal("Error", error, "error");
                }
              });
            }
          }
        })
    });



    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(4)").text();
      swal({
          title: "Are you sure?",
          text: "You want to delete this data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/department.php",
              data: {
                id: col1,
                action: 'DELETE'
              },
              success: function(response) {
                response = JSON.parse(response);
                if (response.error) {
                  swal("Error", response.error, "error");
                } else {
                  swal(response.success, {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });

                }
              },
              error: function(xhr, status, error) {
                swal("Error", error, "error");
              }
            });
          }
        });
    });
  });
</script>