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


<!-- modal stopckin -->
<div class="modal modal-blur fade" id="modal-stockin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-title">Insert New Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Item Name:</label>
          <select class="form-select text-capitalize" name="selectItemName" id="selectItemName" required>
            <option value="" selected>-</option>
            <?php
            $sql = "SELECT item_code,quantity,item_name FROM tbl_item where status=1 order by item_name asc";
            $rs = $conn->query($sql);
            foreach ($rs as $row) {
            ?>
              <option value="<?php echo $row['item_code'] ?>" data-qty="<?php echo $row['quantity'] ?>"><?php echo $row['item_name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div id="stockshow">
          <div class="mb-3">
            <label class="form-label">Added Stock:</label>
            <div class="d-flex justify-content-between align-center">
              <div class="input-group" style="width:140px">
                <button class="input-group-text" id="minus">-</button>
                <input type="text" class="form-control text-center" id="counter" value="0" autocomplete="off" readonly>
                <button class="input-group-text" id="add">+</button>
              </div>

            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Current Stock:</label>
            <h1 id="curstock">0</h1>
          </div>
          <div class="mb-3">
            <label class="form-label">New Stock:</label>
            <h1 id="newstock">0</h1>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary ms-auto" id="saveStock" disabled>
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
              <div class="col-lg-12">
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

<!-- modal returned -->
<div class="modal modal-blur fade" id="modal-database" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-ss">Export Database</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <h1 class="text-center"><a href="getdatabase.php" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
              </svg>
              Export Database
            </a></h1>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- modal retire -->
<div class="modal modal-blur fade" id="modal-retire" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title retirementTitle">Retirement Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Item Name</label>
          <input type="hidden" class="form-control" id="retireId" readonly>
          <input type="hidden" class="form-control" id="actualQty" readonly>
          <input type="text" class="form-control" id="itemtoRetire" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Quantity to Retire:</label>
          <div class="d-flex justify-content-between align-center">
            <div class="input-group" style="width:140px">
              <button class="input-group-text" id="minusq">-</button>
              <input type="text" class="form-control text-center" id="retireQty" value="1" autocomplete="off" readonly>
              <button class="input-group-text" id="addq">+</button>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Remarks</label>
          <textarea class="form-control" rows="6" id="remarks"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button class="btn btn-primary ms-auto" id="submitRetire">
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


<!-- modal id dcoments -->
<div class="modal modal-blur fade" id="modal-documents" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-approved">ID DOCUMENTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 d-flex flex-column align-items-center">
            <h3>Front ID</h3>
            <img id="FrontID" src="../static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">

          </div>
          <div class="col-lg-6 d-flex flex-column align-items-center">
            <h3>Back ID</h3>
            <img id="BackID" src="../static/images/no-image.png" width="230px" height="230px" style="max-height:230px; max-width:230px; min-width:230px; min-height:230px; border:2px solid gray">

          </div>

        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>

      </div>
    </div>
  </div>
</div>


<!-- modal size -->
<div class="modal modal-blur fade" id="modal-size" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-size-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Size Description</label>
          <input type="text" class="form-control" id="sizeDescription" placeholder="Your size name">
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




<!-- modal details -->
<div class="modal modal-blur fade" id="modal-details" data-bs-backdrop='static' data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title md-size-title">My Transaction Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
      </div>
      <div class="modal-body">
        <div id="listjs">
          <div id="pagination-container"></div>
          <div id="table-default" class="table-responsive">
            <table class="table" id="tables">
              <thead>
                <tr>
                  <th id="idname">
                    <button class="table-sort" data-sort="sort-department">
                      Item Name
                    </button>
                  </th>

                  <th id="idquantity">
                    <button class="table-sort" data-sort="sort-status">
                      Quantity
                    </button>
                  </th>
                  <th id="idreturn">
                    <button class="table-sort" data-sort="sort-status">
                      Returned Quantity
                    </button>
                  </th>
                  <th id="idstatus">
                    <button class="table-sort" data-sort="sort-status">
                      Status
                    </button>
                  </th>
                  <th id="act" class="d-none">To be return quantity</th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                </tr>
              </thead>
              <tbody class="table-tbody thedata">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>