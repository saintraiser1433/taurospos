<?php
include '../connection.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location:../index.php");
}

?>

<!doctype html>

<html lang="en">
<?php include '../components/head.php' ?>
<?php include '../components/script.php' ?>

<body class="layout-fluid">

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
                Cancel/Rejected Transaction
              </h2>
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
                            Transaction No #
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-department">
                            Borrower Name
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
                          b.first_name,
                          ', ',
                          b.last_name,
                          ' ',
                          LEFT(b.middle_name, 1)
                      ) AS borrower_name,
                      a.transaction_no,
                      a.status
                  FROM
                      tbl_transaction_header a
                  INNER JOIN tbl_borrower b ON
                      a.borrower_id = b.borrower_id
                  WHERE a.status IN (4,5)
                  ORDER BY
                      a.date_created
                  DESC";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                        <tr>
                          <td class="sort-id"><?php echo $row['transaction_no'] ?></td>
                          <td class="sort-department text-capitalize"><?php echo $row['borrower_name'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 4) {
                              echo '<span class="badge badge-sm bg-pink text-uppercase ms-auto text-white">REJECTED</span>';
                            } else if ($row['status'] == 5) {
                              echo '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">CANCELLED</span>';
                            }
                            ?>
                          </td>
                          <td>
                            <a href="#" class="badge bg-primary details text-decoration-none" title="View Details">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.999 3l.001 17" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
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

    function getDetails(data) {
      $.ajax({
        method: "POST",
        url: "../ajax/transborrow.php",
        data: {
          trans_code: data,
          action: 'GET'
        },
        success: function(response) {
          // Clear existing data first
          $('.thedata').empty();
          // Iterate over each object in the response array
          for (var i = 0; i < response.length; i++) {
            var item = response[i];

            $('#act').hide();
            $('#idreturn').hide();
            $('.thedata').append(
              `<tr>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td><span class="badge badge-sm bg-danger text-uppercase ms-auto text-white">Invalid</span></td>

                </tr>`
            );

          }

        },
        error: function(xhr, status, error) {
          console.error(error); // Log any errors for debugging
        }
      });
    }





    $(document).on('click', '.details', function() {
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      $('#modal-details').modal('show');
      getDetails(data[0]);
      transNo = data[0];
    });





  });
</script>