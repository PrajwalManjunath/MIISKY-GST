<?php $via = $this->session->userdata('firm_name');
if(!isset($firm_name)){ redirect ('Welcome');}
?>     
<link href="<?php echo base_url("assets/css/radiostyle.css"); ?>" rel="stylesheet">
<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->
<link href="<?php echo base_url("assets/css/style.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/GstnManagement/InvoiceModule.css"); ?>" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <style type="text/css">
.nav-header a {
    color: #FFEB3B !important;
}
</style>
<script type="text/javascript">

function updateText(type) { 
 var id = type+'Text';
 document.getElementById(id).value = document.getElementById(type).value;
}
</script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div style="float: left;" class="col-lg-4">
        <img style="    width: 90px;
height: 90px;     padding-top: 5px;" src="http://www.miisky.com/ci/GST.png" alt="GST Logo">
        
    </div>
    <div class="col-lg-4 text-center">
        <h1 style="    padding-top: 7px;
padding-right: 20%;">Inward Purchase Entry</h1>
        
    </div>
    <div style="float: right;" class="col-lg-4">
        <h1 style="padding-top:9px"><?php echo "Date: ". date("d/m/Y");?></h1>
        
    </div>
</div>

<div class="fh-breadcrumb">

    <div class="full-height">
        <div class="full-height-scroll white-bg border-left">
          <?php echo $this->session->flashdata('msg'); ?>
            <div class="element-detail-box">

                <div class="tab-content">
                   <div class="ibox-content">
                        
                <div class="form-group">

                  
                        <div class="row">
                        <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="tabs-container">
        
        <div class="tab-content">
          <div id="tab-1" class="tab-pane active">
      
      <div class="col-lg-12">
                                    <div class="row">
                                             <ul class="nav nav-tabs">  
    <li class="active"><a href="/ci/index.php/Gstr2_data/GSTR2_purchasesCredential_view"> ON WORK FLOW</a></li>
    <li><a class="dropdown-toggle" data-toggle="dropdown">GSTR2 DATA<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/Gstr2_viewfp">Gstr2-View Data</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Generategstr2_fp">Gstr2-Summary Reports</a></li>
           <li><a href="<?php echo base_url(); ?>index.php/Gstr2_data/Gstr2_data_view">Gstr2-All Data</a></li>
        </ul>
      </li>
      <li><a class="dropdown-toggle" data-toggle="dropdown">EXCEL<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/Gstr2_exporttoexcel">EXPORT TO EXCEL</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Gstr2_data/upload_gstr2">EXCEL UPLOAD</a></li>
        </ul>
      </li>
      <li ><a class="dropdown-toggle" data-toggle="dropdown">RECONCILIATION<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li ><a href="<?php echo base_url(); ?>index.php/Reconcilation">GSTR2A EXCEL UPLOAD</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Reconcilation/Reconcile">RECONCILATION</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Reconcilation_exportdata">RECONCILATION SINGLESHEET EXPORT</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Reconcilationmultiexport">RECONCILATION MULTISHEET EXPORT</a></li>
      </ul>
      </li>
    </ul>  
          <br> 
                          <?php $this->load->helper('form'); ?>
                        <?php $attributes = array("name" => "Sendquotation","autocomplete"=>"off");
                        echo form_open_multipart("Gstr2_data/add_purchase_credential", $attributes);?>
            
                   
        
        <div class="col-md-3"><label>Section Type </label>
            <select class="form-control" name="Gstr2_tableref" id="Section_type" required>
                    <option value="" >Section Type </option>
                    <?php foreach($section_details as $list){?>
                        <option value="<?php echo $list->Gstr_tableref;?>" ><?php echo $list->Section_type ."(". $list->Gstr_tableref ." ) ";?></option>
                    <?php }?>
                </select>
        </div>
      <div class="col-md-3"><label>Reverse Charge*</label>
                <select class="form-control"  required="" id="rchrg" name="rchrg" required>
                        <option value="" >Please select</option>                
                        <option value="Y" ><?php echo 'YES';?></option>
            <option value="N" ><?php echo 'NO';?></option>
          
                </select>       
            </div>


            <!-- <div class="col-md-3"><label>Vendor Code</label>
              <option value="<?php echo $list->Gstr_tableref;?>" ><?php echo $list->Section_type ."(". $list->Gstr_tableref ." ) ";?></option>
                <option type="text" placeholder="Vendor Code" class="form-control" value="<?php ?>" name="vendor_code" id="vendor_code" >  </option>

            </div> -->

            <div class="col-md-3"><label>GSTIN </label>
              <select class="form-control" name="vendor_code" id="vendor_code" required>
                    <option value="" >GSTIN</option>
                    <?php foreach($vendor_master as $list){?>
                         <option value="<?php echo $list->GSTIN;?>" ><?php echo $list->GSTIN;?></option>
                    <?php }?>
              </select>
            </div>

            <div class="col-md-3"><label>Vendor Name</label>
                <input type="text" placeholder="Vendor Name" class="form-control" value="" name="vendor_name" id="vendor_name" >   
            </div>

            <div class="col-md-3"><label>Vendor Email</label>
                <input type="text" placeholder="Vendor Email" class="form-control" value="" name="vendor_email" id="vendor_email" >   
            </div>
      
            <div class="col-lg-12 row" >
      <h3 style="margin-left: 25px; color:red;display: block;"><b><u>Purchaser Details:</u></b></h3>
      <div class="col-md-3"><label>Purchaser Vault Number</label>
                <input type="text" placeholder="Buyer Vault Number" class="form-control" value="<?php echo $vault_no; ?>" name="buyer_vault_no" >                    
            </div>  
      
             <div class="col-md-3"><label>Purchaser GSTIN* </label>
            <select class="form-control" name="Gstin_uid_purchaser" id="Gstin_uid_purchaser" required="">
                    <option value="" >Purchaser GSTIN </option>
                    <?php foreach($gstin as $list){?>
                        <option value="<?php echo $list->ChildGstinNo;?>" ><?php echo $list->ChildGstinNo;?></option>
                    <?php }?>
                </select>
      </div>      
      <div class="col-md-3"><label>Purchaser Name</label>
                <input type="text" placeholder="Purchaser Name" class="form-control" value="<?php echo $firm_name; ?>" name="Name_of_buyer" >                    
            </div>
      <div class="col-md-3"><label>Purchaser Name at POS</label>
                <input type="text" placeholder="Purchaser Name at POS" class="form-control" value="" name="Name_of_receiver" id="pos_loc" >                    
            </div>
      
      <div class="col-md-3"><label>Purchaser State</label>
                <input type="text" placeholder="Purchaser State" class="form-control" value="" name="pos_location" id="pos_location" >                    
            </div>
      
      
      <div class="col-md-3"><label>PO Number</label>
                <input type="text" placeholder="Purchase Order Number" class="form-control" value="" name="purchase_order_number" >                   
            </div>
      
      <div class="col-md-3"><label>Purchase Voucher Number</label>
                <input type="text" placeholder="Purchase Voucher Number" class="form-control" value="" name="num" >                   
            </div>
      <div class="col-md-3"><label>Purchase Account</label>
                <input type="text" placeholder="Purchase Account" class="form-control" value="" name="purchase_account">                   
            </div>
      
            </div>
            <div class="col-lg-12 row" >
      <h3 style="margin-left: 25px; color:red;display: block;"><b><u>Supplier Details:</u></b></h3>
        <div class="col-md-3"><label>Supplier Code</label>
            <select class="form-control" name="sup_code" id="sup_code" >
                    <option value="" >Select Supplier Code</option>
                    <?php foreach($vendor_master as $list){?>
          
                        <option value="<?php echo $list->VendorCode;?>" ><?php echo $list->VendorCode." - ".$list->VendorName;?></option>
                    <?php }?>
                </select>
      </div>
      <div class="col-md-3"><label>Supplier Name</label>
                <input type="text" placeholder="Supplier Name" class="form-control" value="" name="sup_name" id="sup_name" >                    
            </div>
      <div class="col-md-3"><label>Supplier Address</label>
                <input type="text" placeholder="Supplier Address" class="form-control" value="" name="sup_address" id="Address" >                    
            </div>
      <div class="col-md-3"><label>Supplier Email*</label>
                <input type="text" placeholder="Supplier email" class="form-control" value="" name="sup_email" id="sup_email" required>                    
            </div>  
      <div class="col-md-3"><label>Supplier GSTIN*</label>
                <input type="text" placeholder="Supplier GSTIN" class="form-control" value="" name="ctin" id="ctin" required>                    
            </div>  
                  <div class="col-md-3">
                     <label>Month</label>
                     <select name="Month" class="form-control">
                      <option value="1">Jan</option>
                      <option value="2">Feb</option>
                      <option value="3">Mar</option>
                      <option value="4">Apr</option>
                      <option value="5">May</option>
                      <option value="6">Jun</option>
                      <option value="7">Jul</option>
                      <option value="8">Aug</option>
                      <option value="9">Sep</option>
                      <option value="10">Oct</option>
                      <option value="11">Nov</option>
                      <option value="12">Dec</option>
                    </select>
                  </div>
                  
                  <div class="col-md-3">
                 <label>Year</label>
                 <select name="Year" class="form-control">
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                      <option value="2028">2028</option>
                      <option value="2029">2029</option>
                      <option value="2030">2030</option>
                    </select>
              </div>
            <div class="col-md-3"><label>Supplier State</label>
                <input type="text" placeholder="Supplier State" class="form-control" value="" name="sup_state" id="sup_state" >                    
            </div>
      
             <div class="col-md-3"><label>Supplier Invoice Number*</label>
                <input type="text" placeholder="Supplier Invoice Number" class="form-control" value="" name="inum"  required>                    
            </div>
      <div class="col-md-3"><label>Supplier Invoice Date*</label>
                <input type="date" placeholder="Supplier Invoice Date" class="form-control" value="" name="idt" >                    
            </div>
      <div class="col-md-3"><label>Select Supply Type*</label>                  
                <select class="form-control" name="ty" required="" id="ty">
                    <option value="" >Select Supply Type</option>                
                        <option value="Capital Goods" ><?php echo 'Capital Goods';?></option>
            <option value="Inventory" ><?php echo 'Inventory';?></option>
            <option value="Consumer_bills" ><?php echo 'Consumer_bills';?></option>
            <option value="Services" ><?php echo 'Services';?></option>
                </select>       
            </div>
        
            </div>
               <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
          <script>
     var csfrData = {};
     csfrData['<?php echo $this->security->get_csrf_token_name(); ?>']
                       = '<?php echo $this->security->get_csrf_hash(); ?>';
   </script>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success"><i class="fa fa-file-text"> </i> Submit</button>
            </div>
          
        </div>
      </div>
                                        <!--<div class="col-lg-12">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div> -->
                                         
                          <?php echo form_close(); ?>
          </div>
        </div>
      </div>
 
    </div>
  </div>
                       

                        </div>
                        
               
                </div>
         
</div>

                   

                    
                    
                </div>

            </div>

        </div>
    </div>



</div>


  

<script type="text/javascript">// <![CDATA[
  $("#Gstin_uid_purchaser").change(function () {
    //get the value of the select when it changes
  
    var value = $("#Gstin_uid_purchaser").val()

    //make an ajax request posting it to your controller
    $.post('<?=site_url("Gstr2_data/get_poslocation")?>', {data:value},function(result) {
      //change the input price with the returned value
     // $('#pos_loc').val(result);
    });
  });
  </script>
  
  
   <script type="text/javascript">// <![CDATA[
   $("#sup_code").change(function () {
    //get the value of the select when it changes
    var value = $("#sup_code").val()

    //make an ajax request posting it to your controller
    $.post('<?=site_url("Gstr2_data/get_supinfo")?>', {data:value},function(result) {
    //alert(result);
      //change the input price with the returned value
   var objJSON =  $.parseJSON(result);   
      //alert(objJSON);
        {
            $('#ctin').val(objJSON[0].GSTIN);
      //$('#supplier_vault_no').val(objJSON[0].vault_no);
            $('#sup_email').val(objJSON[0].EmailId);
            $('#sup_name').val(objJSON[0].VendorName);
            $('#Address').val(objJSON[0].Address);
            $('#sup_state').val(objJSON[0].StateCode);  
               
    }
    });
  });
</script>
 <script type="text/javascript">// <![CDATA[
    $("#Gstin_uid_purchaser").change(function () {
        //get the value of the select when it changes
        var value1 = $("#Gstin_uid_purchaser").val()
        var value = value1.substring(0, 2);
        //make an ajax request posting it to your controller
        $.post('<?=site_url("Gstr2_data/get_state")?>', {data:value},function(result) {
            //change the input price with the returned value
            $('#pos_location').val(result);
        });
    });
</script> 
 <script type="text/javascript">// <![CDATA[  
  $("#ctin").click(function () {
    //get the value of the select when it changes
  //var mystring = "#ctin";
  var value1 = $("#ctin").val()
    //var value1 = $("#ctin").val()
    var value = value1.substring(0, 2);
  
    //make an ajax request posting it to your controller
    $.post('<?=site_url("Gstr2_data/get_state")?>', {data:value},function(result) {
      //change the input price with the returned value
      $('#sup_state').val(result);
    });
  });
  </script> 
<script type="text/javascript">// <![CDATA[  
$("#list").change(function () {
  //get the value of the select when it changes 
  var value = $("#list").val()    
    //make an ajax request posting it to your controller
  $.post('<?=site_url("Gstr2_data/get_hsn")?>', {data:value},function(result) {     
    var res =  $.parseJSON(result);  
    
    var res =  $.parseJSON(result); 
         {
            $('#hsn').val(res[0].HsnCode);
      
    }
    /*$.each(res, function(key, value){
        
        $("#hsn").append('<option  value='+res[0].HsnCode+'>'+res[0].HsnCode+'</option>');
      
        });// $('#hsn_sc').append(result);*/
    });
});
</script>   

<script type="text/javascript">// <![CDATA[  
$("#list1").change(function () {
  //get the value of the select when it changes 
  var value = $("#list1").val()   
    //make an ajax request posting it to your controller
  $.post('<?=site_url("Gstr2_data/get_sac")?>', {data:value},function(result) {     
    var res =  $.parseJSON(result); 
         {
            $('#sac').val(res[0].SacCode);
      
    }   
    //$.each(res, function(key, value){
        
        //$("#sac").append('<option  value='+res[0].SacCode+'>'+res[0].SacCode+'</option>');
      
       // });// $('#hsn_sc').append(result);
    });
});
</script>  
<script type="text/javascript">// <![CDATA[  
$("#vendor_code").change(function () {
  //get the value of the select when it changes 
  var value = $("#vendor_code").val()   
    //make an ajax request posting it to your controller
  $.post('<?=site_url("Gstr2_data/get_VendorDetails")?>', {data:value},function(result) {     
    var res =  $.parseJSON(result); 
         {
            $('#vendor_name').val(res[0].VendorName);
            $('#vendor_email').val(res[0].EmailId);
      
    }   
    //$.each(res, function(key, value){
        
        //$("#sac").append('<option  value='+res[0].SacCode+'>'+res[0].SacCode+'</option>');
      
       // });// $('#hsn_sc').append(result);
    });
});
</script> 