<header class="navbar navbar-expand-md d-print-none">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3 text-muted">
      <img src="../static/images/logo.png" width="48px" height="48px"> Taurus Artech Design Central POS System
    </h1>
    <div class="navbar-nav flex-row order-md-last gap-4">
      <div class="d-none d-md-flex justify-content-between align-items-center">
        <div class="fw-bold ml-2">Your Points: <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
            <path d="M12 7v10" />
          </svg></div>
        <div class="text-success fw-bold">
          20
        </div>
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url(../static/images/seait.png)"></span>
          <div class="d-none d-xl-block ps-2">
            <div class="text-capitalize">
              <?php
              if (!isset($_SESSION['name'])) {
                echo "Administrator";
              } else {
                echo $_SESSION['name'];
              }

              ?>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="../logout.php?borrowid=<?php echo $_SESSION['borrower_id'] ?>&type=<?php echo 2 ?>" class="dropdown-item">Logout</a>
        </div>
      </div>
    </div>
  </div>
</header>