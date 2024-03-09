<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php" rel="noopener">
              <img src="../static/icon/box.png">
              <span class="nav-link-title">
                Items
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./transaction.php" rel="noopener">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <img src="../static/icon/exchange.png">
              </span>
              <span class="nav-link-title">
                My Transaction
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./history.php" rel="noopener">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <img src="../static/icon/history.png">
              </span>
              <span class="nav-link-title">
                My History
              </span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="./penalties.php" rel="noopener">
              <img src="../static/icon/penalty-card.png">
              <span class="nav-link-title">
                My Penalties</span>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./cart.php" rel="noopener">
              <img src="../static/icon/shopping-cart.png">
              <span class="nav-link-title">
                My Cart <span class="badge bg-danger rounded-circle text-white" id="countcart"></span>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>

<script>
  function thecount() {
    $.ajax({
      method: "GET",
      url: "../ajax/countcart.php",
      data: {
        borrower_id: '<?php echo $_SESSION['borrower_id'] ?>'
      },
      success: function(html) {
        $('#countcart').html(html);
      }
    });
  }
  setInterval(thecount, 100)
</script>