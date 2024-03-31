<!-- modal category -->
<div class="modal modal-blur fade" id="modal-category" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title xxCategory"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Category Name</label>
          <input type="text" class="form-control" id="categoryName" placeholder="Your report name">
        </div>
        <div class="mb-3 my-switch">
          <label class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="categoryStatus">
            <span class="form-check-label">Active Status</span>
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="button" class="btn btn-primary ms-auto" id="submit">
          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
          </svg>
          Save
        </button>
      </div>
    </div>
  </div>
</div>

<!-- modal user -->
<div class="modal modal-blur fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title xxUser"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control text-capitalize" id="firstname" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middlename" class="form-control text-capitalize" id="middlename" required>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control text-capitalize" id="lastname" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" id="age" required>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <div class="input-group">
                  <div class="prepend-text bg-teal text-white">+63</div>
                  <input type="number" name="phonenumber" class="form-control" onKeyPress="if(this.value.length==10) return false;" id="phonenumber" required>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" rows="4" id="address"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3 my-switch">
                <label class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="status">
                  <span class="form-check-label">Active Status</span>
                </label>
              </div>
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="button" class="btn btn-primary ms-auto" id="submit">
          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
          </svg>
          Save
        </button>
      </div>
    </div>
  </div>
</div>


<!-- modal discount -->
<div class="modal modal-blur fade" id="modal-discount" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title xxDiscount"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Discount Name</label>
          <input type="text" class="form-control  text-capitalize" id="discountName">
        </div>
        <div class="mb-3">
          <label class="form-label">Percentage</label>
          <select class="form-select text-capitalize" id="percentage">
            <option selected></option>
            <?php for ($i = 1; $i < 101; $i++) { ?>
              <option value="<?php echo $i ?>"><?php echo $i ?>%</option>
            <?php } ?>

          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Points Needed</label>
          <input type="number" class="form-control" id="points">
        </div>
        <div class="mb-3 my-switch">
          <label class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="discountStatus">
            <span class="form-check-label">Active Status</span>
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="button" class="btn btn-primary ms-auto" id="submit">
          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
          </svg>
          Save
        </button>
      </div>
    </div>
  </div>
</div>


<!-- modal quantity -->
<div class="modal modal-blur fade" id="modal-quantity" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <form action="../ajax/server-pos.php" method="post">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-corner-up-right-double  mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 18v-6a3 3 0 0 1 3 -3h7"></path>
            <path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4"></path>
          </svg>
          <h3>Enter Quantity</h3>
          <div class="row">
            <input type="hidden" name="id" id="ids" class="form-control">
            <input type="hidden" name="action" id="qty" value="Quantity" class="form-control">
            <div class="col-lg-12">
              <input type="number" name="quantity" class="form-control" min="1" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button type="submit" name="submit" class="btn btn-success w-100">
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-discount" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <form action="" method="post">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-corner-up-right-double  mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 18v-6a3 3 0 0 1 3 -3h7"></path>
            <path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4"></path>
          </svg>
          <h3>Discount Type</h3>
          <div class="row">

            <div class="col-lg-12">
              <select name="discount" class="form-select form-control w-100">
                <?php
                $sql = "SELECT * FROM discount where status=0 order by discount_id";
                $rs = $conn->query($sql);
                foreach ($rs as $row) {
                ?>
                  <option value="<?php echo $row['percent'] ?>"><?php echo $row['description'] ?></option>

                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button type="submit" name="savediscount" class="btn btn-success w-100">
                  Add Discount
                </button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>