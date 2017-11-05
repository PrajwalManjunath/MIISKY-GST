<?php $firm_name = $this->session->userdata('firm_name');
if(!isset($firm_name)){ redirect ('Welcome');}
?>  
<link href="<?php echo base_url("assets/css/radiostyle.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/codemirror/codemirror.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/codemirror/ambiance.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/chosen/chosen.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/GstnManagement/InvoiceModule.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/GstnManagement/InvoiceModule.css"); ?>" rel="stylesheet">
<style type="text/css">
</style>
           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12 text-center">
                    <h1><?php $firm_name = $this->session->userdata('firm_name'); echo $firm_name; ?> - GST Management</h1>

                </div>
            </div>
             <br>
            <div class="fh-breadcrumb">

                <div>
                    <div class="full-height-scroll white-bg border-left">
                      <?php echo $this->session->flashdata('msg'); ?>
                        <div class="element-detail-box">
                            <div class="tab-content">
                               <div class="ibox-content">
                               <div class="form-group">
                                <div class="col-lg-12">
                                  <div class="row">
                                    <div style="text-align: center;">
<label class="control control--radio">Sales
<input type="radio" checked="checked" onclick="document.location='<?php echo base_url(); ?>index.php/Gstn_management/index4';" name="radio1"  />
<div class="control__indicator"></div>
</label>
<label class="control control--radio">Purchases
<input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Gstr2_data/GSTR2_purchasesCredential_view';" name="radio2"  />
<div class="control__indicator"></div>
</label>
</div>
    <ul class="nav nav-tabs">  
      <li class="active">
        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url(); ?>index.php/Gstn_management/index4/">INVOICE-MODULE <span style="margin-left: 8px;" class="caret"></span></a>
         <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/ProformaInvoice/index">Proforma Invoice</a></li>
        </ul> 
      </li>  
      <li><a class="dropdown-toggle" data-toggle="dropdown" href="/ci/index.php/Register_invoice_document/">REGISTERS<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/Gstr1_Invoiceupdate">Gstr1-View Data</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Gstr1_b2bupdate">Gstr1-Summary Reports</a></li>
           <li><a href="<?php echo base_url(); ?>index.php/Gstr3b_report">Gstr3B- Reports</a></li>
        </ul>
      </li>
          <li><a href="<?php echo base_url(); ?>index.php/Gstr1_sendmails/">GSTR1-SENDMAILS</a></li>
      <li><a href="/ci/index.php/Gst_compliances/">RETURNS - FORMS</a></li> 
      <li><a href="/ci/index.php/Gstr1_reconciliation/">RECONCILIATION</a></li>
      <li><a href="<?php echo base_url(); ?>index.php/Gstr1verify_report/index">GSTR1-VALIDATION</a></li>
      <li><a href="/ci/index.php/Gstn_management/expdata">EXPORT DATA</a></li>
    </ul>

    <?php $this->load->helper( 'form' ); ?>
  
    <div class="full-height">
        <div class="full-height-scroll white-bg border-left">
          <div class="row inv">
          <div style="text-align: center;">
<label class="control control--radio">Create
<input type="radio" checked="checked" onclick="document.location='<?php echo base_url(); ?>index.php/Gstn_management/index4';" name="radio"  />
<div class="control__indicator"></div>
</label>
<label class="control control--radio">Verify and Submit
<input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Gstn_management/index5';" name="radio"  />
<div class="control__indicator"></div>
</label>
</div>
<?php $attributes = array("name" => "locationform", "autocomplete"=>"off");
    echo form_open_multipart("Gstn_management/insert_data1", $attributes);?>
    <?php echo $this->session->flashdata('msg'); ?>
              <h3 style="margin-left: 25px; color:red;display: block;"><b><u>Invoice Details:</u></b></h3>
             
                <div class="col-md-4">
                 <label style="margin-left: 10px;">Invoice No.</label>
                 <input type="text" placeholder="Invoice no." class="form-control" name="inum" required="">
                </div>
                <input type="hidden" class="form-control" value="0" name="status">
               <div class="col-md-4">
                     <label style="margin-left: 10px;">Gstr Table Ref</label>
                 <select type="text" placeholder="Gstr Table Ref" class="form-control" name="Gstr_tableref">
                 <option value="">Select Gstr Table Ref</option>
                 <?php 
                         foreach($sectiontype as $row)
                            { 
                                echo '<option value="'.$row->Gstr_tableref.'">'.$row->Gstr_tableref.'</option>';
                            }
                      ?>
                      </select>
                  </div>
                  <div class="col-md-4">
                     <label style="margin-left: 10px;">Sales Order No/Purchase Order No </label>
                     <input type="text" placeholder="Sales Order No/Purchase Order No" class="form-control" name="od_num">
                  </div>
                  
                  <div class="col-md-4">
                 <label style="margin-left: 10px;">Invoice Date</label>
                 <input type="date" id="InvoiceDate" placeholder="Invoice date" class="form-control" name="idt" required="">
              </div>
               <div class="col-md-2">
                 <label style="margin-left: 10px;">Financial Month</label>
                  <select  name="FinancialMonth" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select> 
              </div>
              <div class="col-md-2">
                 <label style="margin-left: 10px;">Financial Year</label>
                  <select  name="FinancialYear" class="form-control">
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2029</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select> 
              </div>
    
                  <div class="col-md-4">
                     <label style="margin-left: 10px;"> Select Product/Services</label>
                      <select  type="text" id="DueDate" placeholder="Due Date" class="form-control" name="product_services" required>
                    <option value="">Please select product/services</option>
                    <option value="1">Product</option>
                    <option value="2">Services</option>
                  </select> 

                  </div>
              <?php for ($i = 0; $i < count($client_doc); ++$i) { ?>
              <h3 style="margin-left: 25px; color:red;display: block;"><b><u>Seller Details:</u></b></h3>
              <div class="col-md-3">
                 <label style="margin-left: 10px;">Seller Vault No. </label>
                 <input type="text" placeholder="Seller Vault No." class="form-control" value='<?php echo $client_doc[$i]->vault_no; ?>' name="Seller_vaultno" readonly>


              </div>
              <div class="col-md-3">
                 <label style="margin-left: 10px;">GSTIN No Of Seller </label>
                 <!-- <input id="seller_gstin" type="text" placeholder="GSTIN No Of Seller" class="form-control" value="<?php echo $client_doc[$i]->gstno; ?>" name="Gstinno_seller" required=""> -->
                 <select id="seller_gstin" type="text" placeholder="GSTIN No Of Seller" class="form-control" value="<?php echo $client_doc[$i]->gstno; ?>" name="Gstinno_seller" required="">
                 <option value="">Select Gstin Number of Seller</option>
                 
                 <?php 
                         foreach($details_seller as $row)
                            { 
                                echo '<option value="'.$row->ChildGstinNo.'">'.$row->ChildGstinNo.'</option>';
                            }
                      ?>
                      </select>
                 <input type="hidden" value="<?php echo $client_doc[$i]->address; ?>" name="Address_of_seller">
                 <input type="hidden" value="<?php echo $client_doc[$i]->firm_name; ?>" name="Name_of_Seller">
              </div>
              <div class="col-md-3">
                 <label style="margin-left: 10px;">Seller State</label>
                 <input id="state" type="text" placeholder="state" class="form-control" name="SellerState">
                
              </div>
               <div class="col-md-3">
                  <label style="margin-left: 10px;">Email of Seller</label>
                  <input id="email" type="email" placeholder="Email of Seller" class="form-control" name="EmailofSeller" required="">
              </div>

               <div class="col-md-4">
                 <label style="margin-left: 10px;">Supply Type*</label>
                  <select id="sply_ty" type="text" placeholder="Supply Type" class="form-control" name="sply_ty" required>
                    <option value="">Supply Type Inter/Intra*</option>
                    <option value="inter">inter</option>
                    <option value="intra">intra</option>
                  </select> 
              </div>
             
              <div class="col-md-8">
                 <label style="margin-left: 10px;">Address of seller </label>
                 <input id="Address2" type="text" value="<?php echo $client_doc[$i]->address; ?>" placeholder="Address of seller" class="form-control" name="Address_of_seller" required>
              </div>
             
              <h3 style="margin-left: 25px; color:red;display: block;"><b><u>Billed To/Customer Details:</u></b></h3>
              <div class="col-md-4">
                 <label style="margin-left: 10px;">GSTIN No Of Customer </label>
                  <select id="sup_code" type="text" placeholder="GSTIN No Of Customer" class="form-control" id="SectionType" name="Gstinno_customer" maxlength="15" minlength="15">
                 <option value="">Select Gstin Number of Customer</option>
                 <option value="NA">Not Applicable</option>
                 <?php 
                         foreach($details as $row)
                            { 
                                echo '<option value="'.$row->GSTIN.'">'.$row->GSTIN." - ".$row->CustomerName.'</option>';
                            }
                      ?>
                      </select>
              </div>
               <div class="col-md-4">
                 <label style="margin-left: 10px;">Name Of Customer </label>
                 <input type="text" id="CustomerName" placeholder="Name Of Customer" class="form-control" name="Name_of_customer" required>
              </div>
              
              <div class="col-md-4">
                 <label style="margin-left: 10px;">State of Customer </label>
                 <input id="State" type="text" placeholder="state" class="form-control" name="StatecodeofCustomer" required="">
                
              </div>
              <div class="col-md-4">
                 <label style="margin-left: 10px;">Address Of Customer </label>
                 <input type="text" id="Address" placeholder="Address Of Customer" class="form-control" name="AddressOfCustomer" required>
              </div>
              <div class="col-md-4">
                  <label style="margin-left: 10px;">Email of Customer</label>
                  <input id="email2" type="email" placeholder="Email of Customer" class="form-control" name="EmailofReceiver">
              </div>
              <div class="col-md-4">
                     <label style="margin-left: 10px;">Customer Code of POS</label>
                     <input id="CustomerCode" type="text" placeholder="Customer Code of POS" class="form-control" name="CustomerCode" >
                  </div>
              
               <br><h3 style="margin-left: 25px; color:red;display: block;"><b><u>Shipped To/Receiver Details:</u></b></h3>
               <div class="col-md-3">
                 <label style="margin-left: 10px;">Name of Receiver</label>
                 <input type="Name" placeholder="Name" class="form-control" name="Name_of_receiver" required="">
              </div>
              <div class="col-md-3">
                  <label style="margin-left: 10px;">Email of Receiver</label>
                  <input type="email" placeholder="Email of Receiver" class="form-control" name="EmailofReceiver">
              </div>
              <div class="col-md-3">
                  <label style="margin-left: 10px;">Gstin of Receiver</label>
                  <input type="text" placeholder="Gstin of Receiver" class="form-control" name="ctin" maxlength="15" minlength="15">
              </div>
               <div class="col-md-2">
                 <label style="margin-left: 10px;">POS State</label>
                 <select type="text" placeholder="state" class="form-control" name="pos" required="">
                 <option value="">select state</option>
                 <?php 
                         foreach($Statelist as $row)
                            { 
                         echo '<option value="'.$row->StateCode.'">'.$row->StateName.'</option>';
                            }
                      ?>
                      </select>
              </div>
              <div class="col-md-8">
                 <label style="margin-left: 10px;">Address of Receiver</label>
                 <input type="Address" placeholder="Address" class="form-control" name="Address_of_receiver" required="">
              </div>
              <div class="col-md-2">
                <label style="margin-left: 10px;">Reverse charge</label>
                 <select class="form-control" name="rchrg">
                 <option value="N">No</option>
                 <option value="Y">Yes </option>
                  
                </select>
              </div>
             <div style="margin-bottom: 20px;" class="col-md-12">
              <button type="submit" class="btn btn-success">Save</button>
            </div><br>
          </div>
        </div> 
    </div> 
     <?php echo form_close(); ?>
  <?php } ?>

<br><br>
</div>

</div>

</div>
            </div>
            

                                
                            </div>

                        </div>
                        
              </div>
              </div>



            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

  function calcdue() {
    // var tt = document.getElementById('txtDate').value;
    var CreditPeriod=document.getElementById('CreditPeriod').value;
    var InvoiceDate=document.getElementById('InvoiceDate').value;
    var c=parseInt(CreditPeriod);
    var date = new Date(InvoiceDate);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + c);
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var someFormattedDate = mm + '/' + dd + '/' + y;
    document.getElementById('DueDate').value = someFormattedDate;
}

   $("#sup_code").change(function () {
    //get the value of the select when it changes
    var value = $("#sup_code").val()

    //make an ajax request posting it to your controller
    $.post('<?=site_url("Gstn_management/get_supinfo")?>', {data:value},function(result) {
  
      //change the input price with the returned value
   var objJSON =  $.parseJSON(result);      
        {
          $('#CustomerCode').val(objJSON[0].CustomerCode);
          $('#CustomerName').val(objJSON[0].CustomerName);
          $('#Address').val(objJSON[0].Address);
          $('#State').val(objJSON[0].StateCode);
          $('#email2').val(objJSON[0].EmailId);
  }
    });
  });
   $("#seller_gstin").change(function () {
    //get the value of the select when it changes
    var value = $("#seller_gstin").val()

    //make an ajax request posting it to your controller
    $.post('<?=site_url("Gstn_management/get_sellerinfo")?>', {data:value},function(result) {
  
      //change the input price with the returned value
   var objJSON =  $.parseJSON(result);      
        {
          $('#state').val(objJSON[0].state);
          $('#Address2').val(objJSON[0].Address);
          $('#email').val(objJSON[0].email);
          $('#contactNo').val(objJSON[0].contactNo);
  }
    });
  });


</script>
           

