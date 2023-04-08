<!-- Modal -->
<div class="modal fade" id="customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="customer_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group col-md-6">
              <label>Customer Name</label>
              <input type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Enter Customer Name">
              <small id="cust_error" class="form-text text-muted"></small>
            </div>
          </div>

          <div class="form-group">
            <label>Contact</label>
            <input type="text" class="form-control" id="c_contact" name="c_contact" placeholder="Enter Contact"/>
             <small id="contact_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control" id="c_location" name="c_location" placeholder="Enter Location"/>
             <small id="location_error" class="form-text text-muted"></small>
          </div>


          <button type="submit" class="btn btn-success">Add Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>