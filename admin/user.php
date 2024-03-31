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
                User Panel
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
                  Create new user
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
                            Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Address
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Age
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Phone
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Status
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-inventory">
                            Username
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
                      $sql = "SELECT
                      CONCAT(last_name, ' ', first_name,' ',LEFT(middle_name, 1),'.') AS fname,
                      address,
                      phone,
                      STATUS as status,
                      username,
                      age,
                      password,
                      customer_id
                    FROM
                        tbl_customers
                    ORDER BY
                        date_created ASC";
                      $rs = $conn->query($sql);
                      $i = 1;

                      foreach ($rs as $row) { ?>
                        <tr>
                          <td><?php echo $i++ ?></td>
                          <td class="sort-id text-capitalize"><?php echo $row['fname'] ?></td>
                          <td class="sort-id w-25"><?php echo $row['address'] ?></td>
                          <td class="sort-id"><?php echo $row['age'] ?></td>
                          <td class="sort-id"><?php echo $row['phone'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Active</span>';
                            } else if ($row['status'] == 0) {
                              echo '<span class="badge badge-sm bg-red text-uppercase ms-auto text-white">Inactive</span>';
                            }
                            ?>

                          </td>
                          <td class="sort-id"><?php echo $row['username'] ?></td>
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
                          <td class="d-none"><?php echo $row['customer_id'] ?></td>
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
  $(document).ready(function() {
    let id = null;


    $(document).on('click', '.add', function() {
      $('#modal-user').modal('show');
      id = null;
      $('.xxUser').html('Insert User');
      $('#firstname').val('');
      $('#lastname').val('');
      $('#middlename').val('');
      $('#age').val('');
      $('#phonenumber').val('');
      $('#username').val('');
      $('#address').val('');
      $('.my-switch').css('display', 'none');
    });

    $(document).on('click', '.edit', function() {
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(8)").text();
      $('#modal-user').modal('show');
      $('.xxUser').html('Update User');
      $.ajax({
        method: "GET",
        url: "../ajax/server-user.php",
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
          id = col1;
          var words = html.phone.substring(3);
          $('#firstname').val(html.first_name);
          $('#lastname').val(html.last_name);
          $('#middlename').val(html.middle_name);
          $('#age').val(html.age);
          $('#phonenumber').val(words);
          $('#username').val(html.username);
          $('#address').val(html.address);
          $('.my-switch').css('display', 'block');
          $('#status').prop('checked', stat);
        }
      });

    });

    $(document).on('click', '#submit', function(e) {
      e.preventDefault();
      let title;
      let firstname = $('#firstname').val();
      let lastname = $('#lastname').val();
      let middlename = $('#middlename').val();
      let age = $('#age').val();
      let phonenumber = $('#phonenumber').val();
      let username = $('#username').val();
      let address = $('#address').val();
      let status = $('#status').prop('checked');
      if (id === null) {
        title = "You want to add this data?";
      } else {
        title = "You want to update this data?";
      }

      if (status) {
        checkStatus = 1;
      } else {
        checkStatus = 0;
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
                url: "../ajax/server-user.php",
                data: {
                  firstname: firstname,
                  lastname: lastname,
                  middlename: middlename,
                  age: age,
                  phonenumber: phonenumber,
                  username: username,
                  address: address,
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
                url: "../ajax/server-user.php",
                data: {
                  firstname: firstname,
                  lastname: lastname,
                  middlename: middlename,
                  age: age,
                  phonenumber: phonenumber,
                  username: username,
                  address: address,
                  id: id,
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

    $('#firstname, #lastname').on('keyup', function() {
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();

      var result = "";

      if (lastname.length > 0) {
        result += lastname + "_";
      }

      if (firstname.length > 0) {
        result += firstname.substring(0, 4);
      }

      $('#username').val(result + <?php echo date('s') ?>);
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      var currentRow = $(this).closest("tr");
      var col1 = currentRow.find("td:eq(8)").text();
      swal({
          title: "Are you sure?",
          text: "You want to remove this user?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            $.ajax({
              method: "POST",
              url: "../ajax/server-user.php",
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

<style>
  .input-group {
    display: flex;
    align-items: stretch;
  }

  .input-group .prepend-text {
    display: flex;
    align-items: center;
    /* padding: 0.375rem 0.75rem;*/
    padding: 5px;
    font-size: 11px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0.25rem 0 0 0.25rem;
  }

  .input-group .form-control {
    border-radius: 0 0.25rem 0.25rem 0;
  }
</style>