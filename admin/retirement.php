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
                Retirement
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
                            Quantity
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Date Retirement
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-category">
                            Remarks
                          </button>
                        </th>

                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <?php
                      $sql = "SELECT
                      a.item_code,
                      b.item_name,
                      a.quantity,
                      a.remarks,
                      a.date_retirement
                  FROM
                      tbl_retirement a
                  LEFT JOIN tbl_item b ON
                      a.item_code = b.item_code
                  ORDER BY
                      a.date_retirement
                  DESC";
                      $rs = $conn->query($sql);
                      $i = 1;
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $i++ ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['item_code'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['quantity'] ?></td>
                          <td class="sort-category text-capitalize"><?php echo date('M-d-Y', strtotime($row['date_retirement'])); ?></td>
                          <td class="sort-category text-capitalize"><?php echo $row['remarks'] ?></td>
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