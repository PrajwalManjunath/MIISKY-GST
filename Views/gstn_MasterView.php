<?php $firm_name = $this->session->userdata('firm_name');
if(!isset($firm_name)){ redirect ('Welcome');}
?>  
<link href="<?php echo base_url("assets/css/radiostyle.css"); ?>" rel="stylesheet">
 <link href="<?php echo base_url("assets/css/plugins/codemirror/codemirror.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/plugins/codemirror/ambiance.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/plugins/chosen/chosen.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/CustomerMaster/CustomerMaster.css"); ?>" rel="stylesheet">
        <style type="text/css">
              
</style>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 text-center">
      <h1><?php $firm_name = $this->session->userdata('firm_name'); echo $firm_name; ?> -Customer Master</h1>
    </div>
  </div>
   <br>
    <div class="fh-breadcrumb">
      <div class="full-height">
        <div class="full-height-scroll white-bg border-left">
          <?php $this->load->helper( 'form' ); ?>
            <?php $attributes = array("name" => "locationform", "autocomplete"=>"on");
            echo form_open_multipart("Gstn_masters/insert_data", $attributes);?>
          <?php echo $this->session->flashdata('msg'); ?>
           <div class="element-detail-box">
            <div class="tab-content form-group ibox-content">
             <div class="col-lg-12">
              <div class="row"> 
                <ul class="nav nav-tabs" role="tablist">
                  <li class="active"><a class="dropdown-toggle" data-toggle="dropdown">Customer Master<span style="margin-left: 8px;" class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="<?php echo base_url("index.php/CustomerMaster/Customer_master"); ?>">Add Customer</a></li>
                                              <li><a href="<?php echo base_url("index.php/CustomerMaster/Customer_master/CustomerExcelUpload"); ?>">Excel Upload</a></li>
                                            </ul>
                  </li>
                  <li><a class="dropdown-toggle" data-toggle="dropdown">Vendor Master<span style="margin-left: 8px;" class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="<?php echo base_url("index.php/VendorMaster/Vendor_master"); ?>">Add Vendor</a></li>
                                              <li><a href="<?php echo base_url("index.php/VendorMaster/Vendor_master/VendorExcelUpload"); ?>">Excel Upload</a></li>
                                            </ul>
                  </li>
                  <li><a class="dropdown-toggle" data-toggle="dropdown">Item Master<span style="margin-left: 8px;" class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="<?php echo base_url("index.php/Item_master"); ?>">HSN Master</a></li>
                                              <li><a href="<?php echo base_url("index.php/Item_master/item_sac"); ?>">SAC Master</a></li>
                                            </ul>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="element-detail-box">
                  <div class="row">
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Customer Name</label>
                     <input type="text" id="CustomerName" placeholder="Customer Name" class="form-control" name="CustomerName" required="">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Customer Code</label>
                     <input type="text" id="CustomerCode" placeholder="Customer Code" class="form-control" name="CustomerCode" required="">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Division Code</label>
                     <input type="text" id="DivisionCode" placeholder="Division Code" class="form-control" name="DivisionCode">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Division Name</label>
                     <input type="text" id="DivisionName" placeholder="Division Name" class="form-control" name="DivisionName">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Address</label>
                     <input type="text" id="Address" placeholder="Address" class="form-control" name="Address" required="">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">City</label>
                     <input type="text" id="City" placeholder="City" class="form-control" name="City">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;"> State Name</label>
                     <select type="text" placeholder="state" class="form-control" name="StateCode" required="">
                      <option value="">select state</option>
                        <?php 
                         foreach($Statelist as $row){ 
                         echo '<option value="'.$row->StateCode.'">'.$row->StateName.'</option>';
                        }?>
                      </select>
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Name Of The Contact Person</label>
                     <input type="text" id="ContactPersonName" placeholder="Name Of The Contact Person" class="form-control" name="ContactPersonName">
                    </div>
                     <div class="col-md-4">
                     <label style="margin-left: 10px;"> Contact No.</label>
                     <input type="number" id="ContactNo" placeholder="Contact No" class="form-control" name="ContactNo">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">Email Id</label>
                     <input type="text" id="EmailId" placeholder="Email Id" class="form-control" name="EmailId">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">PIN</label>
                     <input type="number" id="Pin" placeholder="Pin" class="form-control" name="Pin" required="">
                    </div>
                    <div class="col-md-4">
                     <label style="margin-left: 10px;">GSTIN</label>
                     <input type="text" id="GSTIN" placeholder="GSTIN" class="form-control" name="GSTIN" required="">
                    </div>
                     <input type="hidden"  name="EmailId">
                    <div style="margin-bottom: 20px;" class="col-md-12">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div><br>
                    <h1><a class="col-md-12" href="http://www.miisky.com/ci/index.php/CustomerMaster/Customer_master/CustomerViewData" style="margin-left: 25px;font-size: 15px;font-weight: 600;text-decoration: underline;">View Records</a></h1>
                  </div>
                </div> 
              </div>
              <?php echo form_close(); ?>
  <?php  ?>
               
              <div class="tab-pane" id="profile" role="tabpanel">
               
      </div>
    </div>
  </div>            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQOxByRV0s-YkzRerTMsQgU1HHRdnk6mU&libraries=places&callback=initAutocomplete"
        async defer></script>
  

