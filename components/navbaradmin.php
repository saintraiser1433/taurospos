<header class="navbar navbar-expand-md d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <img src="../static/images/seait.png" width="26px" height="26px"> SCIENCE LABORATORY BORROWING SYSTEM
        </h1>
        <div class="navbar-nav flex-row order-md-last">

          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
              <span class="avatar avatar-sm" style="background-image: url(../static/images/seait.png)"></span>
              <div class="d-none d-xl-block ps-2">
                <div class="text-capitalize">
                  <?php 
                  if(!isset($_SESSION['name'])){
                    echo "Administrator";
                  }else{
                    echo $_SESSION['name'];
                  }
                  
                  ?>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <a href="../logout.php?admin_id=<?php echo $_SESSION['admin_id'] ?>&type=<?php echo 1 ?>" class="dropdown-item">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </header>

    