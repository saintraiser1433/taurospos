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
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                Transaction
              </h2>
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
                            Start Date
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Expected Returned Date
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Return Date
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
                    <tbody class="table-tbody" id="append-transaction">

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
        type: 2,
        borrowid: '<?php echo $_SESSION['borrower_id'] ?>'
      },
      success: function(html) {
      
      }
    });
  });

  function getTransaction() {
    $.ajax({
      url: "../ajax/realtimetransact.php",
      method: "POST",
      data: {
        borrower_id: '<?php echo $_SESSION['borrower_id'] ?>'
      },
      success: function(html) {
        $('#append-transaction').empty();
        for (var i = 0; i < html.length; i++) {
          var item = html[i];


          $('#append-transaction').append(
            `
            <tr>
            <td class="sort-id">${item.transaction_no}</td>
            <td class="sort-id text-capitalize">${item.borrower_name}</td>
            <td class="sort-id text-capitalize">${item.start_date}</td>
            <td class="sort-id text-capitalize">${item.expected_return_date}</td>
            <td class="sort-id text-capitalize">${item.return_date}</td>
            <td class="sort-id text-capitalize">${item.status}</td>
            <td><a href="#" class="badge bg-primary details text-decoration-none" title="View Details">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.999 3l.001 17" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                              </svg>
                            </a></td>
            <td></td>
            </tr>
            `
          );



        }
      }
    });
  }

  setInterval(getTransaction,500)

  $(document).ready(function() {
    $(document).on('click', '.cancel', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(0)").text();
      swal({
          title: "Are you sure?",
          text: "You want to cancelled this transaction?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/transborrow.php",
              data: {
                trans_code: col1,
                action: 'CANCELLED'
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
    $(document).on('click', '.details', function() {
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      $.ajax({
        method: "POST",
        url: "../ajax/transborrow.php",
        data: {
          trans_code: data[0],
          action: 'GET'
        },
        success: function(response) {
          $('#modal-details').modal('show');
          // Clear existing data first
          $('.thedata').empty();
          // Iterate over each object in the response array
          for (var i = 0; i < response.length; i++) {
            var item = response[i];
            // Define a variable to hold the status badge HTML
            var statusBadge;
            if (item.status == 4) {
              statusBadge = '<span class="badge badge-sm bg-secondary text-uppercase ms-auto text-white">For Approval</span>';
            } else if (item.status == 3) {
              statusBadge = '<span class="badge badge-sm bg-teal text-uppercase ms-auto text-white">Waiting to claim</span>';
            } else if (item.status == 2) {
              statusBadge = '<span class="badge badge-sm bg-warning text-uppercase ms-auto text-white">Waiting to Returned</span>';
            } else if (item.status == 1) {
              statusBadge = '<span class="badge badge-sm bg-info text-uppercase ms-auto text-white">Partially Returned</span>';
            } else if (item.status == 0) {
              statusBadge = '<span class="badge badge-sm bg-success text-uppercase ms-auto text-white">Returned</span>';
            } else {
              statusBadge = '<span class="badge badge-sm bg-danger text-uppercase ms-auto text-white">Invalid</span>';
            }

            // Append a new row with data from the current object
            $('.thedata').append(
              `<tr>
            <td>${item.item_name}</td>
            <td>${item.qty}</td>
            <td>${item.return_quantity}</td>
            <td>${statusBadge}</td>
        </tr>`
            );
          }
        },
        error: function(xhr, status, error) {
          console.error(error); // Log any errors for debugging
        }
      });
    });
  });
</script>