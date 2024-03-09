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
                Category Panel
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
                  Create new sizes
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
                          <button class="table-sort" data-sort="sort-category">
                            Description
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
                      $sql = "SELECT * from tbl_size order by size_id asc";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <th class="sort-id"><?php echo $i++ ?></th>
                          <td class="sort-category text-capitalize"><?php echo $row['size_description'] ?></td>
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
                          <td class="d-none"><?php echo $row['size_id'] ?></td>
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
  $(document).ready(function() {
    let id = 0;
    $(document).on('click', '.add', function() {
      $('#modal-size').modal('show');
      $('#sizeDescription').val('');
      id = 0;
      $('.md-size-title').html('Insert Category');
    });

    $(document).on('click', '.edit', function() {
      let stat = '';
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      id = data[2];
      $('#modal-size').modal('show');
      $('#sizeDescription').val(data[0])
      $('.md-size-title').html('Update Size Description');
    });



    $(document).on('click', '#submit', function(e) {
      e.preventDefault();
      var description = $('#sizeDescription').val();
      swal({
          title: "Are you sure?",
          text: "You want to add this size?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            if (id === 0) {
              $.ajax({
                method: "POST",
                url: "../ajax/size.php",
                data: {
                  description: description,
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
                url: "../ajax/size.php",
                data: {
                  id: id,
                  description: description,
                  action: 'UPDATE'
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

          }
        });
    });



    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(2)").text();
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
              url: "../ajax/size.php",
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