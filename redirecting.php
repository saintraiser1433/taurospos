<?php
include 'connection.php';

?>
<!doctype html>

<html lang="en">

<?php include 'components/indexheader.php' ?>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h1 class="text-center mb-4">Thank you for register</h1>
                    <p class="text-center">We will start by verifying your documents. After this, we will send you a notification to your phone number about the status of your account. Please wait for 2-4 hours for this process. Thank you</p>
                    <p class="text-center text-warning">We will redirecting you in login page in:</p>
                    <center>
                        <div class="item html">
                            <h2 class="text-white">0</h2>
                            <svg width="160" height="160" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <title>Layer 1</title>
                                    <circle id="circle" class="circle_animation" r="69.85699" cy="81" cx="81" stroke-width="12" stroke="#00b09b" fill="gray" />
                                </g>
                            </svg>
                        </div>
                    </center>
                </div>

            </div>

        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->


    <?php include 'components/indexscript.php' ?>
    <script src="dist/js/circularProgressBar.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {

        var time = 0;
        var initialOffset = '400';
        var i = 10

        /* Need initial run as interval hasn't yet occured... */
        $('.circle_animation').css('stroke-dashoffset', initialOffset - (1 * (initialOffset / i)));

        var interval = setInterval(function() {
            $('h2').text(i);
            if (i == time) {
                clearInterval(interval);
                window.location.href = "index.php";
            }
            $('.circle_animation').css('stroke-dashoffset', initialOffset - ((time + 1) * (initialOffset / i)));
            i--;
        }, 1000);

    });
</script>

<style>
    .item {
        position: relative;

    }

    .item h2 {
        text-align: center;
        position: absolute;
        line-height: 150px;
        width: 100%;
        z-index: 100;
    }

    svg {
        -webkit-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .circle_animation {
        stroke-dasharray: 440;
        /* this value is the pixel circumference of the circle */
        stroke-dashoffset: 440;
        transition: all 1s linear;
    }
</style>