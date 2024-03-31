<?php include '../connection.php';
// if (!isset($_SESSION['admin_id'])) {
//   header("Location:../index.php");
// }

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
                Discount Panel
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
                  Create new discount
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
                          <button class="table-sort" data-sort="sort-inventory">
                            Discount Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Discount Percentage
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Points
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
                      $sql = "SELECT * FROM tbl_discount order by date_created asc";
                      $rs = $conn->query($sql);
                      $i = 1;

                      foreach ($rs as $row) { ?>
                        <tr>
                          <td><?php echo $i++ ?></td>
                          <td class="sort-id text-capitalize"><?php echo $row['discount_name'] ?></td>
                          <td class="sort-id"><?php echo $row['discount_percent'] ?>%</td>
                          <td class="sort-id"><?php echo $row['points'] ?></td>
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
                          <td class="d-none"><?php echo $row['discount_id'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <div class="btn-toolbar">
                    <p class="mb-0" id="listjs-showing-items-label">Showing <?php echo $rs->num_rows ?> items</p>
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
    let id = null;


    $(document).on('click', '.add', function() {
      $('#modal-discount').modal('show');
      id = null;
      $('.xxDiscount').html('Insert Discount');
      $('#discountName').val('');
      $('#percentage').val('');
      $('#points').val('');
      $('.my-switch').css('display', 'none');
    });

    $(document).on('click', '.edit', function() {
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(6)").text();
      id = col1;
      $('#modal-discount').modal('show');
      $('.xxDiscount').html('Update Discount');
      $.ajax({
        method: "GET",
        url: "../ajax/server-discount.php",
        data: {
          id: col1,
        },
        dataType: 'json',
        success: function(res) {
          const html = res[0];
          if (html.status != 0) {
            stat = 'checked'
          } else {
            stat = ''
          }
          $('#discountName').val(html.discount_name);
          $('#percentage').val(html.discount_percent);
          $('#points').val(html.points);
          $('.my-switch').css('display', 'block');
          $('#discountStatus').prop('checked', stat);
        }
      });

    });

    $(document).on('click', '#submit', function(e) {
      e.preventDefault();
      let title;
      let discountName = $('#discountName').val();
      let percentage = $('#percentage').val();
      let points = $('#points').val();
      var status = $('#discountStatus').prop('checked');
      if (status) {
        checkStatus = 1;
      } else {
        checkStatus = 0;
      }
      if (id === null) {
        title = "You want to add this data?";
      } else {
        title = "You want to update this data?";
      }

      swal({
          title: "Are you sure?",
          text: title,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            if (id === null) {
              $.ajax({
                method: "POST",
                url: "../ajax/server-discount.php",
                data: {
                  discountName: discountName,
                  percentage: percentage,
                  points: points,
                  action: 'ADD'
                },
                success: function(html) {
                  swal("Success", {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });
                }
              });
            } else {
              $.ajax({
                method: "POST",
                url: "../ajax/server-discount.php",
                data: {
                  id: id,
                  discountName: discountName,
                  percentage: percentage,
                  points: points,
                  status: checkStatus,
                  action: 'UPDATE'
                },
                success: function(html) {
                  swal("Successfully Updated", {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });
                }
              });
            }
          }
        });
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(6)").text();
      swal({
          title: "Are you sure?",
          text: "You want to delete this discount?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/server-discount.php",
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