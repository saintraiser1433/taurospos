<?php include '../connection.php';
$trn = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
?>

<!doctype html>

<html lang="en">
<?php include '../components/head.php' ?>

<body class=" layout-fluid">

  <div class="page">
    <!-- Navbar -->
    <?php include '../components/navbar.php' ?>
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
                Inventory Panel
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
                  Create new item
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
                            Item Code
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Item Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Category Name
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Qty
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Size
                          </button>
                        </th>
                        <th>
                          <button class="table-sort" data-sort="sort-status">
                            Condition
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
                      a.item_code,
                      a.item_name,
                      b.category_name,
                      a.quantity,
                      c.size_description,
                      a.item_condition,
                      a.status,
                      a.img_path
                  FROM
                      tbl_inventory a
                  LEFT JOIN tbl_categories b ON
                      a.category_id = b.category_id AND b.status = 1
                  LEFT JOIN tbl_size c ON
                      a.size_id = c.size_id
                  ORDER BY
                      a.item_code ASC";
                      $rs = $conn->query($sql);
                      $i = 1;

                      foreach ($rs as $row) { ?>
                        <tr>
                          <td><img src="../static/item/<?php echo $row['img_path'] ?>" class="rounded-circle" style="width:30px;height:30px;"></td>
                          <td class="sort-id"><?php echo $row['item_code'] ?></td>
                          <td class="sort-inventory text-capitalize"><?php echo $row['item_name'] ?></td>
                          <td class="sort-inventory text-capitalize"><?php echo $row['category_name'] ?></td>
                          <td class="sort-inventory"><?php echo $row['quantity'] ?></td>
                          <td class="sort-inventory"><?php echo $row['size_description'] ?></td>
                          <td class="sort-inventory"><?php echo $row['item_condition'] ?></td>
                          <td class="sort-status">
                            <?php
                            if ($row['status'] == 1) {
                              echo '<span class="badge badge-sm bg-green text-uppercase ms-auto text-white">Active</span>';
                            } else if ($row['status'] == 2) {
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
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#ImgID').attr('src', e.target.result);

      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $(document).ready(function() {
    let id = null;
    $(document).on('click', '.add', function() {
      $('#modal-inventory').modal('show');
      id = null;
      $('.md-title').html('Insert Item');
      $('#itemCode').val('<?php echo $trn ?>')
      $('#itemName').val('')
      $('#itemDescription').val('')
      $('#itemCategory').val('')
      $('#itemCondition').val('')
      $('#itemQty').val('')
      $('#itemSize').val('')
    });

    $(document).on('click', '.edit', function() {
      var currentRow = $(this).closest("tr");
      let stat = '';
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      id = data[1];
      $('#modal-inventory').modal('show');
      $('.md-title').html('Update Item');
      $.ajax({
        method: "GET",
        url: "../ajax/inventory.php",
        data: {
          itemCode: id,
          action: 'GET'
        },
        dataType:'json',
        success: function(res) {
          const html = res[0];
          $('#itemCode').val(html.item_code)
          $('#itemName').val(html.item_name)
          $('#itemDescription').val(html.description)
          $('#itemCategory').val(html.category_id)
          $('#itemCondition').val(html.item_condition)
          $('#itemQty').val(html.quantity)
          $('#itemSize').val(html.size_id)
          $('#ImgID').attr('src',`../static/item/${html.img_path}`)
        }
      });

    });



    $(document).on('click', '#submit', function(e) {
      e.preventDefault();
      var fileInput = document.getElementById('filer_input_single');
      var formData = new FormData();
      formData.append('itemCode', $('#itemCode').val());
      formData.append('itemName', $('#itemName').val());
      formData.append('itemDescription', $('#itemDescription').val());
      formData.append('itemCategory', $('#itemCategory').val());
      formData.append('itemCondition', $('#itemCondition').val());
      formData.append('itemQty', $('#itemQty').val());
      formData.append('itemSize', $('#itemSize').val());
      formData.append('files', fileInput.files[0]);
      if(id === null){
        formData.append('action', 'ADD');
      }else{
        formData.append('action', 'UPDATE');
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
            if (id === null) {
              $.ajax({
                method: "POST",
                url: "../ajax/inventory.php",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
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
                url: "../ajax/inventory.php",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
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
              url: "../ajax/inventory.php",
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
              url: "../ajax/inventory.php",
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