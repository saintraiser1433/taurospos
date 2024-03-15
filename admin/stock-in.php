<?php include '../connection.php';
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
                Stock In Panel
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
                  Add New Stock
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
                            Item Code
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Item Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Actual Quantity
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Added Quantity
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            New Quantity
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Date Added
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $sql = "SELECT
                              a.old_quantity,
                              a.added_quantity,
                              a.item_code,
                              b.item_name,
                              a.date_added
                          FROM
                              tbl_stock_in a
                          LEFT JOIN tbl_item b ON
                              a.item_code = b.item_code
                          ORDER BY
                              a.date_added
                          DESC";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $i++ ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['item_code'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['old_quantity'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['added_quantity'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['added_quantity'] + $row['old_quantity'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo date('M-d-Y', strtotime($row['date_added'])); ?></td>
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
<?php include '../dist/xx_close_api_admin.php' ?>
</html>

<script>
 
  let counter = parseInt($('#counter').val());
  let curStock = 0;

  $('#stockshow').hide();

  $('#add').on('click', function() {
    counter += 1;
    $('#counter').val(counter)
    $('#newstock').html(counter + curStock);
    if (counter == 0) {
      $('#saveStock').attr('disabled', true);
    } else {
      $('#saveStock').attr('disabled', false);
    }
  });

  $('#minus').on('click', function() {
    counter -= 1;

    if (counter < 0) {
      counter = 0;
    }
    if (counter == 0) {
      $('#saveStock').attr('disabled', true);
    } else {
      $('#saveStock').attr('disabled', false);
    }
    $('#counter').val(counter)
    $('#newstock').html(counter + curStock);


  });
  $(document).ready(function() {
    $(document).on('click', '.add', function() {
      $('#modal-stockin').modal('show');
    });

    $(document).on('change', '#selectItemName', function() {
      var value2 = $(this).find(':selected').data('qty');
      curStock = value2;
      $('#curstock').html(curStock);
      $('#newstock').html(curStock);
      $('#stockshow').show();
    });




    $(document).on('click', '#saveStock', function(e) {
      e.preventDefault();
      var itemCode = $('#selectItemName').val();
      swal({
          title: "Are you sure?",
          text: "You want to add quantity of this item?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/inventory.php",
              data: {
                itemCode: itemCode,
                qty: curStock,
                addedqty: counter,
                action: 'STOCKIN'
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