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
padding-right: 20%;">Reconcile</h1>
        
    </div>
    <div style="float: right;" class="col-lg-4">
        <h1 style="padding-top:9px"><?php echo "Date: ". date("d/m/Y");?></h1>
        
    </div>
</div>
<br>
    <br><div style="text-align: center;"> 
   
     <label class="control control--radio">GSTR2 DATA
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/Reconcile';" name="radioven" />
      <div class="control__indicator"></div>
    </label>
   
    <label class="control control--radio">GSTR2A DATA
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2a';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
       <label class="control control--radio">Matched
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2amatched';" name="radiocus" checked />
      <div class="control__indicator"></div>
    </label>
     <label class="control control--radio">Matched With Difference
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/Reconcilematchedwithdiffer';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
     <label class="control control--radio">Unmatched of gstr2
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2unmatched';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
    <label class="control control--radio">Unmatched of gstr2a
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2aunmatched';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
   
    <label class="control control--radio">Summary
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2Summary';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
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
    <li><a href="/ci/index.php/Gstr2_data/GSTR2_purchasesCredential_view"> ON WORK FLOW</a></li>
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
      <li class="active"><a class="dropdown-toggle" data-toggle="dropdown">RECONCILIATION<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li ><a href="<?php echo base_url(); ?>index.php/Reconcilation">GSTR2A EXCEL UPLOAD</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Reconcilation/Reconcilation_Json">GSTR2A JSON UPLOAD</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Reconcilation/Reconcile">RECONCILE</a></li>
      </ul>
      </li>
    </ul>  
          <br> 
               <div class="ibox-content">
              <div class="form-group">
                  <div class="row table-responsive">
                   <?php $this->load->helper( 'form' ); ?>
                <?php $attributes = array("name" => "locationscearch", "class" => "form-inline");
        echo form_open("Reconcilation/ReconcileGstr2amatchedFp", $attributes);?>
                  <div class="full-height">
                      <div class="full-height-scroll white-bg border-left" style="margin-top: 30px;">
                     <div class="col-md-3">
                     <label  style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;" >Month</label>
                     <select name="Month" style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;">
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
                 <label style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;">Year </label>
                 <select name="Year" class="form-control" style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;">
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
              <div class="col-md-3">
                 <label style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;">Gstin </label>
                 <select name="ctin" class="form-control" style="margin-left: 10px;background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;color: inherit;display: block;padding: 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;width: 100%;font-size: 14px;">
                      <option value="Gstin">Gstin</option>
                      <option value="Gstinum">Gstin And Invoice Number</option>
                    </select>
              </div>
                   <div class="col-md-3">
                   <button type="submit" class="btn btn-success" style="margin-top: 38px;">View Data</button>
                  </div>
                      </div>
                  </div>
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
      $('#pos_loc').val(result);
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
            $('#ctin').val(objJSON[0].GSTIN_No);
      //$('#supplier_vault_no').val(objJSON[0].vault_no);
            $('#sup_email').val(objJSON[0].EmailID);
            $('#sup_name').val(objJSON[0].VendorName);
             $('#sup_address').val(objJSON[0].Address);     
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