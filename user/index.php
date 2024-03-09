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
        <!-- <div class="container-xl">
          <div class="row align-items-center">
            <div class="col-5"> -->
        <!-- Page pre-title -->
        <!-- <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                All Items
              </h2>
            </div>

          </div>
        </div> -->

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row">
              <div class="card">
                <div class="card-header">

                  <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                      <a href="#all" class="nav-link active" data-bs-toggle="tab">All</a>
                    </li>
                    <?php
                    $sql = "SELECT * FROM tbl_category order by category_id";
                    $rs = $conn->query($sql);
                    foreach ($rs as $row) { ?>
                      <li class="nav-item">
                        <a href="#<?php echo str_replace(' ', '', $row['category_name']) ?>" class="nav-link text-capitalize" data-bs-toggle="tab"><?php echo $row['category_name'] ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="card-body w-75">
                  <div class="tab-content">
                    <div class="tab-pane active show" id="all">
                      <div class="row" id="cardContainer">
                        <?php
                        $sqls = "SELECT
                                      a.item_code,
                                      a.item_name,
                                      a.img_path,
                                      a.quantity,
                                      b.category_name,
                                      a.description
                                  FROM
                                      tbl_item a
                                  LEFT JOIN tbl_category b ON
                                      a.category_id = b.category_id
                                  LEFT JOIN tbl_size c ON
                                      a.size_id = c.size_id
                                  WHERE a.status=1
                                  ORDER BY
                                      a.date_created ASC";
                        $rss = $conn->query($sqls);
                        foreach ($rss as $rows) { ?>
                          <div class="col-lg-3 pb-2">

                            <div class="card card-link card-link-pop" onclick="window.location.href='borrowslip.php?code=<?php echo $rows['item_code'] ?>'" style="cursor:pointer">

                              <?php
                              if ($rows['quantity'] === '0') {

                                echo "
                                
                                <div class='ribbon bg-danger'> Out of Stock </div>";
                              } else {
                                echo "<div class='ribbon bg-success'> Qty : " . $rows['quantity'] . "</div>";
                              }
                              ?>
                              <div class="card-status-bottom bg-success"></div>
                              <!-- Photo -->
                              <div class="img-responsive img-responsive-16x9 card-img-top" style="background-image: url('../static/item/<?php echo $rows['img_path'] ?>')"></div>
                              <div class="card-body">
                                <span class="text-capitalize fw-bolder asname"><?php echo $rows['item_name'] ?></span>
                                <p class="text-muted asdes"><?php echo $rows['description'] ?></p>

                              </div>
                            </div>
                          </div>

                        <?php } ?>
                      </div>
                    </div>
                    <?php
                    foreach ($rs as $rowx) { ?>
                      <!-- <div class="tab-pane fade active show" id="tabs-home-8"> -->
                      <div class="tab-pane fade show" id="<?php echo str_replace(' ', '', $rowx['category_name']) ?>">
                        <div class="row">
                          <?php
                          $catid = $rowx['category_id'];
                          $sql = "SELECT
                          a.item_code,
                          a.item_name,
                          a.img_path,
                          a.quantity,
                          b.category_name,
                          a.description
                      FROM
                          tbl_item a
                      LEFT JOIN tbl_category b ON
                          a.category_id = b.category_id
                      LEFT JOIN tbl_size c ON
                          a.size_id = c.size_id
                      WHERE a.status=1 and a.category_id=$catid
                      ORDER BY
                          a.date_created ASC";
                          $rst = $conn->query($sql);
                          foreach ($rst as $rowt) { ?>
                            <div class="col-lg-3 pb-2">

                              <div class="card card-link card-link-pop" onclick="window.location.href='borrowslip.php?code=<?php echo $rowt['item_code'] ?>'" style="cursor:pointer">
                                <?php
                                if ($rowt['quantity'] === '0') {
                                  echo "<div class='ribbon bg-danger'> Out of Stock </div>";
                                } else {
                                  echo "<div class='ribbon bg-success'> Qty : " . $rowt['quantity'] . "</div>";
                                }
                                ?>
                                <div class="card-status-bottom bg-success"></div>
                                <!-- Photo -->
                                <div class="img-responsive img-responsive-4x3 card-img-top" style="background-image: url('../static/item/<?php echo $rowt['img_path'] ?>')"></div>
                                <div class="card-body">
                                  <span class="text-capitalize fw-bolder"><?php echo $rowt['item_name'] ?></span>
                                  <p class="text-muted"><?php echo $rowt['description'] ?></p>
                                </div>
                              </div>
                            </div>

                          <?php } ?>
                        </div>
                      </div>
                    <?php
                    } ?>
                  </div>
                </div>
              </div>
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
      success: function(html) {

      }
    });
  });
</script>