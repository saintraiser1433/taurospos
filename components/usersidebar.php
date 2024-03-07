<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
              </span>
              <span class="nav-link-title">
                My Dashboard
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./items.php" rel="noopener">
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
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transaction-yen" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 16h6" /><path d="M15 12l3 4.5" /><path d="M21 12l-3 4.5v4.5" /><path d="M15 19h6" /><path d="M5 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M7 5h8" /><path d="M7 5v8a3 3 0 0 0 3 3h1" /></svg>
              </span>
              <span class="nav-link-title">
                My Transaction
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