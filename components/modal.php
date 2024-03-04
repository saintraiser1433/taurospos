<!-- modal department -->
<div class="modal modal-blur fade" id="modal-department" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label">Department Name</label>
          <input type="text" class="form-control" id="departmentName" placeholder="Your report name">
        </div>
        <div class="mb-3 my-switch">
          <label class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="departmentStatus">
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


<!-- modal category -->
<div class="modal modal-blur fade" id="modal-category" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-title"></h5>
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



<!-- modal inventory -->
<div class="modal modal-blur fade" id="modal-inventory" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form enctype="multipart/form-data"></form>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4">
            <center>
              <img id="ImgID" src="../static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">
            </center><br>

            <input type="file" name="files[]" id="filer_input_single" class="form-control" onchange="readURL(this);" required />
            </center>

          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Item Code</label>
                  <input type="text" class="form-control" name="itemCode" id="itemCode" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Item Name</label>
                  <input type="text" name="itemName" class="form-control" id="itemName" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <input type="text" name="itemDescription" class="form-control" id="itemDescription" required>
                </div>
              </div>
              

            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Category</label>
                  <select class="form-select text-capitalize" name="itemCategory" id="itemCategory" required>
                    <option value="" selected>-</option>
                    <?php
                    $sql = "SELECT * FROM tbl_category order by category_id asc";
                    $rs = $conn->query($sql);
                    foreach ($rs as $row) {
                    ?>
                      <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Condition</label>
                  <select class="form-select" name="ItemCondition" id="itemCondition" required>
                    <option value="" selected>-</option>
                    <option value="Good">Good</option>
                    <option value="Slightly Damage">Slightly Damage</option>
                    <option value="Damage">Damage</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" name="itemQty" class="form-control" id="itemQty" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Size</label>
                  <select class="form-select" name="itemSize" id="itemSize" required>
                    <option value="" selected>-</option>
                    <?php
                    $sql = "SELECT * FROM tbl_size order by size_id asc";
                    $rs = $conn->query($sql);
                    foreach ($rs as $row) { ?>
                      <option value="<?php echo $row['size_id'] ?>"><?php echo $row['size_description'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
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

<!-- modal returned -->
<div class="modal modal-blur fade" id="modal-return" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Return Quantity</label>
          <input type="number" class="form-control" id="returnqty" placeholder="Quantity">
        </div>

      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button class="btn btn-primary ms-auto" id="returnSubmit">
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