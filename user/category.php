<?php
include '../connection.php';
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
          <div class="row align-items-center">
            <div class="col-5">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">

              </h2>
            </div>

          </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <?php
              if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT
               a.item_code,
               a.item_name,
               a.img_path,
               a.quantity,
               b.category_name,
               a.description
             FROM
               tbl_inventory a
             LEFT JOIN tbl_categories b ON
               a.category_id = b.category_id
             LEFT JOIN tbl_size c ON
               a.size_id = c.size_id
             WHERE a.category_id = $id
             ORDER BY
               a.date_created ASC";
                $rs = $conn->query($sql);
                if ($rs->num_rows > 0) {
                  foreach ($rs as $row) { ?>
                    <div class="col-lg-4">
                      <div class="card card-link card-link-pop">
                        <div class="card-stamp">
                          <div class="card-stamp-icon bg-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                              <path d="M12 12l8 -4.5" />
                              <path d="M12 12l0 9" />
                              <path d="M12 12l-8 -4.5" />
                            </svg>
                          </div>
                        </div>
                        <div class="card-status-bottom bg-primary"></div>
                        <div class="row row-0">
                          <div class="col-5">
                            <img src="../static/item/<?php echo $row['img_path'] ?>" height="225px" />
                          </div>
                          <div class="col">
                            <div class="card-body">
                              <h3 class="card-title text-uppercase"><strong><?php echo $row['item_name'] ?></strong></h3>
                              <p class="text-secondary text-capitalize"><?php echo $row['description'] ?></p>
                              <h4>CATEGORY: <?php echo $row['category_name'] ?></h4>
                              <h4>ITEM LEFT: <?php echo $row['quantity'] ?></h4>
                              <div class="d-flex justify-content-center gap-2">
                                <a href="borrowslip.php?code=<?php echo $row['item_code'] ?>" class="btn btn-success d-none d-sm-inline-block">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12l0 9" />
                                    <path d="M12 12l-8 -4.5" />
                                  </svg>
                                  BORROW</a>
                                <button class="btn btn-primary w-50 p-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-box-left-middle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 15h-2" />
                                    <path d="M13 12h-6" />
                                    <path d="M11 9h-4" />
                                  </svg>DETAILS</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } else { ?>
                  <div class="empty">
                    <div class="empty-img"><img src="../static/images/undraw_quitting_time_dm8t.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">No returns found</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your search or filter to find what you're looking for.
                    </p>
                    <div class="empty-action">
                      <a href="./items.php" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                          <path d="M21 21l-6 -6" />
                        </svg>
                        Search again
                      </a>
                    </div>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="empty">
                  <div class="empty-img"><img src="./static/images/undraw_quitting_time_dm8t.svg" height="128" alt="">
                  </div>
                  <p class="empty-title">Opps you entered wrong url</p>
                  <p class="empty-subtitle text-secondary">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti esse, nihil delectus provident laboriosam officiis dolorem alias hic ullam pariatur voluptatem, nobis perferendis dignissimos officia voluptatibus adipisci! Commodi, amet molestias?
                  </p>
                  <div class="empty-action">
                    <a href="./." class="btn btn-primary">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                      </svg>
                      Search again
                    </a>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>





      </div>
      <?php include '../components/footer.php' ?>
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
                url: "../ajax/department.php",
                data: {
                  id: id,
                  description: description,
                  status: checkStatus,
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


    $(document).on('click', '.update', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(4)").text();
      swal({
          title: "Are you sure?",
          text: "You want to update this data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "PUT",
              url: "../ajax/department.php",
              data: {
                id: col1,
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
        });
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