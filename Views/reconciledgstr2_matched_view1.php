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
                   
                    <table style="margin-bottom: 10px; overflow:scroll;" class='table table-bordered'>
                <thead>
                  <tr>
                  <th> # </th>
                  <th>ctin#$#inum </th>
                  <!-- <th> ctin 2 </th>
                  <th> ctin 2A </th> -->
                  <!-- <th> Invoice Number 2</th>
                  <th> Invoice Number 2A</th> -->
                  <!-- <th> Invoice Date 2</th>
                  <th> Invoice Date 2A</th> -->
                  <!-- <th> Invoice Value 2</th>
                  <th> Invoice Value  2A</th> -->
                  <!-- <th> itm_det</th> -->
                  <th> Tax Val 2</th>
                  <th> Tax Val 2A</th>
                  <th> DIFF Txval 2-2A</th>
                  <th> IGST 2</th>
                  <th> IGST 2A</th>
                  <th> DIFF IGST 2-2A</th>
                  <th> SGST 2</th>
                  <th> SGST 2A</th>
                  <th> DIFF SGST 2-2A</th>
                  <th> CGST 2</th>
                  <th> CGST 2A</th>
                  <th> DIFF CGST 2-2A</th>
                  <!-- <th> Supplier Name </th> 
                  <th> Flag </th> -->
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($gstlist1); ++$i) { ?>
                        <tr>
                          <td><?php echo ($i+1); ?></td>
                          <!-- <td><?php echo $gstlist1[$i]->ctin2; ?></td>
                          <td><?php echo $gstlist1[$i]->ctin2a; ?></td> -->
                           <td><?php echo $gstlist1[$i]->tabl1; ?></td>
                          
                          <!-- <td><?php echo $gstlist1[$i]->inum2; ?></td>
                          <td><?php echo $gstlist1[$i]->inum2a; ?></td> -->
                          
                          <!-- <?php if($gstlist1[$i]->idt2==$gstlist1[$i]->idt2a)
                          {
                            echo "<td>".$gstlist1[$i]->idt2."</td>";
                            echo "<td>".$gstlist1[$i]->idt2a."</td>";
                          }
                          else
                          {
                            echo "<td style='color: red;'>".$gstlist1[$i]->idt2."</td>
                            <td style='color: red;'>".$gstlist1[$i]->idt2a."";
                          } ?> -->
                          
                          <!-- <td><?php echo $gstlist1[$i]->val2; ?></td>
                          <td><?php echo $gstlist1[$i]->val2a; ?></td> -->
                          <!-- <td><?php echo $gstlist1[$i]->itm_det; ?></td> -->
                          <?php if($gstlist1[$i]->txval2==$gstlist1[$i]->txval2a)
                          {
                            echo "<td>".$gstlist1[$i]->txval2."</td>";
                            echo "<td>".$gstlist1[$i]->txval2a."</td>";
                          }
                          else
                          {
                            echo "<td style='color: red;'>".$gstlist1[$i]->txval2."</td>
                            <td style='color: red;'>".$gstlist1[$i]->txval2a."";
                          } ?>
                          <td><?php echo $gstlist1[$i]->txval2-$gstlist1[$i]->txval2a; ?></td>
                          <?php if($gstlist1[$i]->iamt2==$gstlist1[$i]->iamt2a)
                          {
                            echo "<td>".$gstlist1[$i]->iamt2."</td>";
                            echo "<td>".$gstlist1[$i]->iamt2a."</td>";
                          }
                          else
                          {
                            echo "<td style='color: red;'>".$gstlist1[$i]->iamt2."</td>
                            <td style='color: red;'>".$gstlist1[$i]->iamt2a."";
                          } ?>
                          <td><?php echo $gstlist1[$i]->iamt2-$gstlist1[$i]->iamt2a; ?></td>
                          <?php if($gstlist1[$i]->samt2==$gstlist1[$i]->samt2a)
                          {
                            echo "<td>".$gstlist1[$i]->samt2."</td>";
                            echo "<td>".$gstlist1[$i]->samt2a."</td>";
                          }
                          else
                          {
                            echo "<td style='color: red;'>".$gstlist1[$i]->samt2."</td>
                            <td style='color: red;'>".$gstlist1[$i]->samt2a."";
                          } ?>
                          <td><?php echo $gstlist1[$i]->samt2-$gstlist1[$i]->samt2a; ?></td>
                          <?php if($gstlist1[$i]->camt2==$gstlist1[$i]->camt2a)
                          {
                            echo "<td>".$gstlist1[$i]->camt2."</td>";
                            echo "<td>".$gstlist1[$i]->camt2a."</td>";
                          }
                          else
                          {
                            echo "<td style='color: red;'>".$gstlist1[$i]->camt2."</td>
                            <td style='color: red;'>".$gstlist1[$i]->camt2a."";
                          } ?>
                          <td><?php echo $gstlist1[$i]->camt2-$gstlist1[$i]->camt2a; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>  
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