<?php
include '../connection.php';
$cashierid = $_SESSION['staff_id'];


if (isset($_GET['crt'])) {
  $id = $_GET['crt'];
  $sql = "DELETE FROM tbl_cart where cart_id=$id and transact_by=$cashierid";
  $conn->query($sql);
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../components/head.php' ?>

<body class="layout-fluid">
  <div class="page">

    <!-- Navbar -->
    <?php include '../components/navbaradmin.php' ?>
    <div class="page-wrapper">
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row">
            <div class="col-lg-7">
              <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                      <a href="#all" class="nav-link active" data-bs-toggle="tab">All</a>
                      <?php
                      $sql = "SELECT * FROM tbl_category where status = 1 order by category_id";
                      $rs = $conn->query($sql);
                      foreach ($rs as $row) { ?>
                    <li class="nav-item">
                      <a href="#<?php echo str_replace(' ', '', $row['category_name']) ?>" class="nav-link text-capitalize" data-bs-toggle="tab"><?php echo $row['category_name'] ?></a>
                    </li>
                  <?php } ?>
                  </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active show" id="all">
                      <div class="row mb-3">
                        <div class="col-lg-12">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                <path d="M5 11h1v2h-1z" />
                                <path d="M10 11l0 2" />
                                <path d="M14 11h1v2h-1z" />
                                <path d="M19 11l0 2" />
                              </svg>
                            </span>
                            <video style="display:none" id="preview" width="100%" height="150%"></video>
                            <input type="text" id="searchInput" class="form-control" placeholder="Scan QR CODE...." autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="row" id="cardContainer">
                        <?php
                        $sqls = "SELECT
                                  item_id,
                                  item_code,
                                  item_name,
                                  description,
                                  price,
                                  img_path
                                FROM
                                  tbl_inventory a
                                INNER JOIN
                                  tbl_category b ON a.category_id = b.category_id
                                WHERE
                                  a.status = 1 and b.status = 1
                                ORDER BY 
                                  a.date_created asc";
                        $rss = $conn->query($sqls);
                        foreach ($rss as $rows) { ?>

                          <div class="col-lg-3 pb-2">
                            <div class="card card-link card-link-pop" onclick="quantity('<?php echo $rows['item_id'] ?>')" style="cursor:pointer">
                              <div class="card-status-bottom bg-success"></div>
                              <!-- Photo -->
                              <div class="img-responsive img-responsive-4x3 card-img-top" style="background-image: url('../static/item/<?php echo $rows['img_path'] ?>')""></div>
                              <div class=" card-body" style="height: 150px;">
                                <span class="text-capitalize fw-bolder asname"><?php echo $rows['item_name'] ?></span>
                                <p class="text-muted asdes">
                                  <?php
                                  $description = $rows['description'];
                                  $limited_description = strlen($description) > 120 ? substr($description, 0, 120) . '...' : $description;
                                  echo $limited_description;
                                  ?>
                                </p>
                              </div>
                              <div class="card-body">
                                <h4 class="">₱ <?php echo $rows['price'] ?></h4>
                              </div>

                            </div>
                          </div>
                        <?php } ?>

                      </div>
                    </div>

                    <?php
                    foreach ($rs as $rowx) { ?>
                      <div class="tab-pane fade show" id="<?php echo str_replace(' ', '', $rowx['category_name']) ?>">
                        <div class="row">
                          <?php
                          $catid = $rowx['category_id'];
                          $sqlx = "SELECT
                                      item_id,
                                      item_code,
                                      item_name,
                                      description,
                                      price,
                                      img_path
                                    FROM
                                      tbl_inventory a
                                    INNER JOIN
                                      tbl_category b ON a.category_id = b.category_id
                                    WHERE
                                      a.status = 1 and b.category_id=$catid
                                    ORDER BY 
                                     a.date_created asc";
                          $rst = $conn->query($sqlx);
                          foreach ($rst as $row) { ?>
                            <div class="col-lg-3 pb-2">
                              <div class="card card-link card-link-pop" onclick="quantity('<?php echo $row['item_id'] ?>')" style="cursor:pointer">
                                <div class="card-status-bottom bg-success"></div>
                                <!-- Photo -->
                                <div class="img-responsive img-responsive-4x3 card-img-top" style="background-image: url('../static/item/<?php echo $row['img_path'] ?>')""></div>
                              <div class=" card-body" style="height: 150px;">
                                  <span class="text-capitalize fw-bolder asname"><?php echo $row['item_name'] ?></span>
                                  <p class="text-muted asdes">
                                    <?php
                                    $description = $row['description'];
                                    $limited_description = strlen($description) > 120 ? substr($description, 0, 120) . '...' : $description;
                                    echo $limited_description;
                                    ?>
                                  </p>
                                </div>
                                <div class="card-body">
                                  <h4 class="">₱ <?php echo $row['price'] ?></h4>
                                </div>

                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="card">
                <div class="card-header">
                  <h1 class="card-title text-muted">CURRENT ORDERS</h1>
                  <div class="card-actions">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-discount">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 15l3 -3m2 -2l1 -1" />
                        <path d="M9.148 9.145a.498 .498 0 0 0 .352 .855a.5 .5 0 0 0 .35 -.142" />
                        <path d="M14.148 14.145a.498 .498 0 0 0 .352 .855a.5 .5 0 0 0 .35 -.142" />
                        <path d="M8.887 4.89a2.2 2.2 0 0 0 .863 -.53l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.528 .858m-.757 3.248a2.193 2.193 0 0 1 -1.555 .644h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1c0 -.604 .244 -1.152 .638 -1.55" />
                        <path d="M3 3l18 18" />
                      </svg>
                      (F1) Customers
                    </a>
                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-discount">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 15l3 -3m2 -2l1 -1" />
                        <path d="M9.148 9.145a.498 .498 0 0 0 .352 .855a.5 .5 0 0 0 .35 -.142" />
                        <path d="M14.148 14.145a.498 .498 0 0 0 .352 .855a.5 .5 0 0 0 .35 -.142" />
                        <path d="M8.887 4.89a2.2 2.2 0 0 0 .863 -.53l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.528 .858m-.757 3.248a2.193 2.193 0 0 1 -1.555 .644h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1c0 -.604 .244 -1.152 .638 -1.55" />
                        <path d="M3 3l18 18" />
                      </svg>
                      (F1) DISCOUNT
                    </a>
                    <a href="#" class="btn btn-outline-primary clearall">

                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 6h12" />
                        <path d="M6 12h12" />
                        <path d="M4 18h12" />
                      </svg>
                      (F2) Clear All
                    </a>
                  </div>
                </div>
                <form action="" method="post">
                  <div class="card-body p-0 p-lg-0">
                    <div id="listjs">
                      <div id="table-default" class="table-responsive">
                        <table class="table" id="tables">
                          <thead>
                            <tr>
                              <th>Img</th>
                              <th>
                                <button class="table-sort" data-sort="sort-name">
                                  Item Name
                                </button>
                              </th>
                              <th class="qtys">
                                <button class="table-sort qty" data-sort="sort-gender">
                                  Quantity
                                </button>
                              </th>
                              <th>
                                <button class="table-sort price" data-sort="sort-gender">
                                  Price
                                </button>
                              </th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="table-tbody">
                            <?php
                            $sql = "SELECT
                            a.quantity,
                            a.cart_id,
                            b.item_name,
                            b.price,
                            b.img_path
                        FROM
                            tbl_cart a,
                            tbl_inventory b
                        WHERE
                            a.item_id = b.item_id AND a.transact_by = $cashierid
                        ORDER BY
                            a.cart_id";
                            $rsq = $conn->query($sql);
                            $sum = 0; // Initialize the sum variable
                            if ($rsq->num_rows > 0) {
                              $checkorder =  1;
                              foreach ($rsq as $rows) {
                                $totalPrice = $rows['quantity'] * $rows['price'];
                                $sum += $totalPrice;
                            ?>
                                <tr>
                                  <td>
                                    <div class="avatar bg-muted-lt" data-demo-color>
                                      <img src="../static/item/<?php echo $rows['img_path']; ?>" class="rounded-circle" style="width:30px;height:30px;">
                                    </div>
                                  </td>
                                  <td class="sort-name text-capitalize w-25"><span class="text-gray"><?php echo $rows['item_name'] ?></span></td>

                                  <td>
                                    <?php echo $rows['quantity'] ?>
                                  </td>
                                  <td class="pricetd"> ₱<?php echo number_format($totalPrice, 2)  ?> </td>
                                  <td><a href="?crt=<?php echo $rows['cart_id'] ?>" class="badge bg-danger">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-playstation-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 21a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9a9 9 0 0 0 -9 9a9 9 0 0 0 9 9z"></path>
                                        <path d="M8.5 8.5l7 7"></path>
                                        <path d="M8.5 15.5l7 -7"></path>
                                      </svg></a></td>

                                </tr>
                            <?php }
                            } else {
                              $checkorder =  0;
                              echo '
                             <tr>
                            <td colspan="5" class="text-center">No orders found</td>
                             </tr>';
                            }
                            ?>
                          </tbody>
                        </table>

                      </div>

                    </div>
                    <br><br><br><br><br><br><br>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card text-white" style="background-color: #50C878;">
                          <div class="card-body p-3">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-6">Subtotal</div>
                              <div class="col-lg-6 col-md-6 col-6 text-end sub-total">₱ </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6 col-md-6  col-6">Discount</div>
                              <div class="col-lg-6  col-md-6 col-6 text-end">
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-lg-6 col-md-6  col-6">
                                <h1>Grand Total</h1>
                              </div>
                              <div class="col-lg-6  col-md-6 col-6 text-end">
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-lg-6 col-md-6  col-6">
                                <h1>Change</h1>
                              </div>
                              <div class="col-lg-6  col-md-6 col-6 text-end">
                                <h1 class="change">₱ 0.00</h1>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6 col-md-6  col-6">
                                <h1>Balance</h1>
                              </div>
                              <div class="col-lg-6  col-md-6 col-6 text-end">
                                <h1 class="change">₱ 0.00</h1>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row p-2">
                      <h2>Transaction Details:</h2>
                      <div class="col-lg-6 "><label class="fw-bold">Customer Name </label> : <span>John Rey Decosta</span></div>
                      <div class="col-lg-6"><label class="fw-bold">Address </label>: <span> Brgy Javier, Polomolok, South Cotabato</span></div>
                      <div class="col-lg-6 mt-2"><label class="fw-bold">Phone Number </label> : <span>+639301791280</span></div>
                      <div class="col-lg-6 mt-2"><label class="fw-bold ">Availed Discount </label> :<span> Loyalty Award </span></div>

                    </div>
                    <div class="row px-2">
                      <div class="col-lg-6" id="pickupDate">
                        <h4 class="fw-bold">Pickup Date: </h4>
                        <input type="date" class="form-control">
                      </div>
                      <div class="col-lg-6">
                        <h4 class="fw-bold">Payment Method: </h4>
                        <select class="form-select" id="paymentMethod" required>
                          <option selected></option>
                          <option value="cash">CASH</option>
                          <option value="gcash">G-CASH</option>
                        </select>
                      </div>

                      <div class="col-lg-6 mt-3" id="referenceNum">
                        <h4 class="fw-bold">Reference Number</h4>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-lg-6 mt-3" id="fpPayment">
                        <h4 class="fw-bold">Full/Partial Payment</h4>
                        <input type="number" class="form-control">
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-12">

                        <button type="button" id="savebill" class="btn btn-primary w-100">
                          Save Transaction
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include '../components/footer.php'; ?>
  </div>
  </div>



  <?php include '../components/script.php' ?>
  <?php include '../components/modal.php' ?>




</body>

</html>


<script>
  $(document).ready(function() {

    $('#paymentMethod').on('change', function() {
      var value = this.value;
      if (value == 'cash') {
        $('#fpPayment').show();
        $('#pickupDate').show();
        $('#referenceNum').hide();
        $('#referenceNum').removeClass('col-lg-6').addClass('col-lg-12');
        $('#fpPayment').removeClass('col-lg-6').addClass('col-lg-12');
      } else if (value == 'gcash') {
        $('#referenceNum').removeClass('col-lg-12').addClass('col-lg-6');
        $('#fpPayment').removeClass('col-lg-12').addClass('col-lg-6');
        $('#referenceNum').show();
        $('#fpPayment').show();
        $('#pickupDate').show();
      } else {
        $('#referenceNum').hide();
        $('#fpPayment').hide();
        $('#pickupDate').hide();

      }
    });


    $("#searchInput").autocomplete({
      source: "../static/ajax/fetchitems.php",
      minLength: 1,
      select: function(event, ui) {
        if (ui.item.qty > 0) {
          $('#modal-quantity').modal('show');
          $('#ids').val(ui.item.id);
        } else {
          swal({
            title: "This item is out of stock",
            icon: "error",
            button: "Exit!",
          })
        }

      }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };
  });
</script>
<script>
  function quantity(itemid) {
    $('#modal-quantity').modal('show');
    $('#ids').val(itemid);

  }

  $(document).ready(function() {
    $('#cashtendered').on('keyup', function() {
      var num1 = parseFloat($('#cashtendered').val()) || 0; // Parse the input as a floating-point number
      var num2 = parseFloat($('#grandtotal').val()) || 0;
      var sum = num1 - num2;
      var roundedSum = sum.toFixed(2);
      var formattedSum = parseFloat(roundedSum).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }); // Round the sum to 2 decimal places
      if (roundedSum < 0) {
        $('#savebill').attr('disabled', true);
      } else {
        $('#savebill').attr('disabled', false);
      }
      $('.change').html('₱ ' + formattedSum);
      $('#changes').val(roundedSum);

    });
  });


  $(document).keydown(function(event) {
    if (event.key === 'F1') {
      event.preventDefault();
      $('#modal-discount').modal('show');
    }
    if (event.key === 'F2') {
      event.preventDefault();
      swal({
          title: "Are you sure?",
          text: "You want to clear all orders ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              method: "POST",
              url: "../static/ajax/deleteall.php",
              success: function(html) {
                location.reload();
              }
            });
          }
        });
    }

  });

  $(document).on('click', '#savebill', function(e) {
    var cash = $('#cashtendered').val();
    var grandtotal = $('#grandtotal').val();
    var subtotal = $('#subtotal').val();
    var discount = $('#discount').val();
    var change = $('#changes').val();
    e.preventDefault();
    if ($.isEmptyObject(cash)) {

      swal({
        title: "Please enter cash before proceed to bill",
        icon: "error",
        button: "Exit!",
      })
    } else {
      swal({
          title: "Are you sure?",
          text: "Click 'Bill Button' if the transaction is complete.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              method: "POST",
              url: "../static/ajax/savebill.php",
              data: {
                cashtendered: cash,
                grandtotal: grandtotal,
                subtotal: subtotal,
                discount: discount,
                change: change
              },
              success: function(html) {
                swal("Success! ", {
                  icon: "success",
                }).then((value) => {
                  setInterval(function() {
                    window.location.href = '../static/report/output/receipt.pdf';
                  }, 1000);


                });
              }

            });

          }
        });
    }

  });


  $(document).on('click', '.clearall', function(e) {
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "You want to clear all orders ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            method: "POST",
            url: "../static/ajax/deleteall.php",
            success: function(html) {
              location.reload();

            }
          });
        }
      });
  });
</script>

<style type="text/css">
  .ui-autocomplete-row {
    padding: 8px;
    background-color: #f4f4f4;
    border-bottom: 1px solid #ccc;
    font-weight: bold;
  }

  .ui-autocomplete-row:hover {
    background-color: #ddd;
  }
</style>