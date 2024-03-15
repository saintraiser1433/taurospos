<?php
include '../connection.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location:../index.php");
}

$date = date('Y');
$sql = "SELECT COUNT(*) AS cnt,MONTHNAME(date_created) as borrow from tbl_transaction_header where YEAR(date_created)='$date'";
$rs = $conn->query($sql);
$resultArray = array();

foreach ($rs as $row) {
    $resultArray[] = $row;
}


// Extracting the required data from the array
$cntData = array_column($resultArray, 'cnt');
$monthData = array_column($resultArray, 'borrow');


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
                                My Dashboard
                            </h2>
                        </div>
                        <!-- Page title actions -->

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">

                                    <div class="card card-sm">
                                        <div class="card-status-bottom bg-success"></div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-man" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 16v5" />
                                                            <path d="M14 16v5" />
                                                            <path d="M9 9h6l-1 7h-4z" />
                                                            <path d="M5 11c1.333 -1.333 2.667 -2 4 -2" />
                                                            <path d="M19 11c-1.333 -1.333 -2.667 -2 -4 -2" />
                                                            <path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) as cnt FROM tbl_borrower where status=1";
                                                        $rs = $conn->query($sql);
                                                        $row = $rs->fetch_assoc();
                                                        echo $row['cnt'] ?? 0;
                                                        ?>
                                                        Borrowers
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-status-bottom bg-success"></div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) as cnt FROM tbl_transaction_header where status=0";
                                                        $rs = $conn->query($sql);
                                                        $row = $rs->fetch_assoc();
                                                        echo $row['cnt'] ?? 0;
                                                        ?>
                                                        Returned
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-status-bottom bg-success"></div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) as cnt FROM tbl_retirement";
                                                        $rs = $conn->query($sql);
                                                        $row = $rs->fetch_assoc();
                                                        echo $row['cnt'] ?? 0;
                                                        ?>
                                                        Retired Items
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-status-bottom bg-success"></div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                            <path d="M12 12l8 -4.5" />
                                                            <path d="M12 12l0 9" />
                                                            <path d="M12 12l-8 -4.5" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) as cnt FROM tbl_item where status = 1";
                                                        $rs = $conn->query($sql);
                                                        $row = $rs->fetch_assoc();
                                                        echo $row['cnt'] ?? 0;
                                                        ?>
                                                        Total Items
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-status-bottom bg-success"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Traffic summary</h3>
                                    <div id="chart-mentions" class="chart-lg"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php include '../components/footer.php' ?>
        </div>
    </div>

    <?php include '../components/script.php' ?>
    <?php include '../components/modal.php' ?>
</body>

</html>

<script src="../dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
<?php include '../dist/xx_close_api_admin.php' ?>
<script>
 


    document.addEventListener("DOMContentLoaded", function() {
        var cntData = <?php echo json_encode($cntData); ?>;
        var monthData = <?php echo json_encode($monthData); ?>;
        window.ApexCharts &&
            new ApexCharts(document.getElementById("chart-mentions"), {
                chart: {
                    type: "bar",
                    fontFamily: "inherit",
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false,
                    },
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                        name: "Returned",
                        data: cntData,
                    },

                ],
                tooltip: {
                    theme: "dark",
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4,
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: "month",
                },
                yaxis: {
                    labels: {
                        padding: 4,
                    },
                },
                labels: monthData,
                colors: [
                    tabler.getColor("green", 0.8),
                    tabler.getColor("red"),

                ],
                legend: {
                    show: true,
                },
            }).render();
    });
    // @formatter:on
</script>