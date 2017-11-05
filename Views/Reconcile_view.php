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
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/Reconcile';" name="radioven" checked/>
      <div class="control__indicator"></div>
    </label>
   
    <label class="control control--radio">GSTR2A DATA
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2a';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
     <label class="control control--radio">Matched
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2amatched';" name="radiocus" />
      <div class="control__indicator"></div>
    </label>
    <label class="control control--radio">Unmatched
      <input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Reconcilation/ReconcileGstr2aunmatched';" name="radiocus" />
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
                  <div class="row">
                   
                    <table id="one" style="margin-bottom: 10px; overflow:scroll;" class='table table-bordered'>
                <thead>
                  <tr>
                  <th> # </th>
                  <th> ctin </th>
                  <th> inum</th>
                  <th> idt</th>
                  <th> val </th>
                  <th> itm_det</th>
                  <th> txval</th>
                  <th> iamt</th>
                  <th> samt</th>
                  <th> camt</th>
                  
                  <!-- <th> Supplier Name </th> 
                  <th> Flag </th> -->
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($gstlist1); ++$i) { ?>
                        <tr>
                          <td><?php echo ($i+1); ?></td>
                          <td><?php echo $gstlist1[$i]->ctin; ?></td>
                          <td><?php echo $gstlist1[$i]->inum; ?></td>
                          <td><?php echo $gstlist1[$i]->idt; ?></td>
                          <td><?php echo $gstlist1[$i]->val; ?></td>
                          <td><?php echo $gstlist1[$i]->itm_det; ?></td>
                          <td><?php echo $gstlist1[$i]->txval; ?></td>
                          <td><?php echo $gstlist1[$i]->iamt; ?></td>
                          <td><?php echo $gstlist1[$i]->samt; ?></td>
                          <td><?php echo $gstlist1[$i]->camt; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>  
              <!-- <table id="two" style="margin-bottom: 10px; overflow:scroll;" class='table table-bordered'>
                <thead>
                  <tr>
                  <th> # </th>
                  <th> ctin </th>
                  <th> inum</th>
                  <th> idt</th>
                  <th> val </th>
                  <th> itm_det</th>
                  <th> txval</th>
                  <th> iamt</th>
                  <th> samt</th>
                  <th> camt</th>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($gstlist2); ++$i) { ?>
                        <tr>
                          <td><?php echo ($i+1); ?></td>
                          <td><?php echo $gstlist2[$i]->ctin; ?></td>
                          <td><?php echo $gstlist2[$i]->inum; ?></td>
                          <td><?php echo $gstlist2[$i]->idt; ?></td>
                          <td><?php echo $gstlist2[$i]->val; ?></td>
                          <td><?php echo $gstlist2[$i]->itm_det; ?></td>
                          <td><?php echo $gstlist2[$i]->txval; ?></td>
                          <td><?php echo $gstlist2[$i]->iamt; ?></td>
                          <td><?php echo $gstlist2[$i]->samt; ?></td>
                          <td><?php echo $gstlist2[$i]->camt; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>  
              <div id="message">
</div> -->
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
<!-- <script>
$(document).ready(function() {
  var table_one = [];
  var table_two = [];
  $("#one tr").each(function() {
    var temp_string = "";
    count = 1;
    $(this).find("td").each(function() {
      if (count == 2) {
        temp_string += "/";
      }
      temp_string = temp_string + $(this).text();
      count++;
    });
    table_one.push(temp_string);
  });
  $("#two tr").each(function() {
    var temp_string = "";
    count = 1;
    $(this).find("td").each(function() {
      if (count == 2) {
        temp_string += "/";
        temp_string = temp_string + $(this).text();
      } else {
        temp_string = temp_string + $(this).text();
      }
      count++;
    });
    table_two.push(temp_string);
  });
  console.log(table_one);
  console.log(table_two);
  var message = "";
  for (i = 0; i < table_two.length; i++) {
    var flag = 0;
    var temp = 0;
    table_two_entry = table_two[i].split("/");
    table_two_cell_one = table_two_entry[0];
    table_two_cell_two = table_two_entry[1];
    console.log(table_two_cell_one+":"+table_two_cell_two);
    for (j = 0; j < table_one.length; j++) {
      table_one_entry = table_one[j].split("/");
      table_one_cell_one = table_one_entry[0];
      table_one_cell_two = table_one_entry[1];
      console.log("1)"+table_one_cell_one+":"+table_one_cell_two);
      if (table_two_cell_one == table_one_cell_one) {
        flag++;
        if (table_one_cell_two == table_two_cell_two) {
          flag++;
          break;
        } else {
            temp = table_one_cell_two;
        }
      } else {}
    }
    if (flag == 2) {
      message += table_two_cell_one + " " + table_two_cell_two + " found in first table<br>";
    } else if (flag == 1) {
      message += table_two_cell_one + " bad - first table has " + temp  + "<br>";
    } else if (flag == 0) {
      message += table_two_cell_one + " not found in first table<br>";
    }
  }
  $('#message').html(message);
});
// $(document).ready(function() {
    
//         $('#one tbody tr').each(function(){
//         var row = $(this);
//         var left_cols = $(this).find("td:lt(3)");
//         $('#two tbody tr').each(function(){
//             var right_cols = $(this).find("td:lt(3)");
//             if(left_cols.html() == right_cols.html()) {
//                 left_cols.css('background-color', 'green').css('color', 'red');
//                 right_cols.css('background-color', 'green').css('color', 'red');
//              }
//          });
//       });
//    });

</script>
  
 -->