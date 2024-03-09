<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php" rel="noopener">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                <path d="M12 12l8 -4.5" />
                <path d="M12 12l0 9" />
                <path d="M12 12l-8 -4.5" />
              </svg>
              <span class="nav-link-title">
                Items
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./transaction.php" rel="noopener">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transaction-yen" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M15 16h6" />
                  <path d="M15 12l3 4.5" />
                  <path d="M21 12l-3 4.5v4.5" />
                  <path d="M15 19h6" />
                  <path d="M5 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M7 5h8" />
                  <path d="M7 5v8a3 3 0 0 0 3 3h1" />
                </svg>
              </span>
              <span class="nav-link-title">
                My Transaction
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./history.php" rel="noopener">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v4" />
                  <path d="M22 22l-5 -5" />
                  <path d="M17 22l5 -5" />
                </svg>
              </span>
              <span class="nav-link-title">
                My History
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./cart.php" rel="noopener">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 17h-11v-14h-2" />
                <path d="M6 5l14 1l-1 7h-13" />
              </svg>
              <span class="nav-link-title">
                My Cart <span class="badge bg-danger rounded-circle text-white" id="countcart"></span>
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./penalties.php" rel="noopener">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
              </svg>
              <span class="nav-link-title">
                My Penalties</span>
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
      success: function(html) {
        $('#countcart').html(html);
      }
    });
  }
  setInterval(thecount, 100)
</script>