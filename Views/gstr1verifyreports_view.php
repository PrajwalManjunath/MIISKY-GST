<?php $firm_name = $this->session->userdata('firm_name');
  if(!isset($firm_name)){ redirect ('Welcome');}
  ?>    
  <link href="<?php echo base_url("assets/css/radiostyle.css"); ?>" rel="stylesheet">
  <link href="<?php echo base_url("assets/css/plugins/codemirror/codemirror.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/codemirror/ambiance.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/chosen/chosen.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/GstnManagement/InvoiceModule.css"); ?>" rel="stylesheet">  
  
  <link rel="stylesheet" type="text/css"  href="<?php echo base_url("assets/css/jquery.dataTables.css"); ?>">
   <link rel="stylesheet" type="text/css"    href="<?php echo base_url("assets/css/jquery.dataTables.css"); ?>">
  <head>

   


  </head>
        
              <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-lg-12 text-center">
                      <h1>GSTR1-VERIFY REPORTS DATA</h1>
                      <div style="text-align: center;">
<label class="control control--radio">Sales
<input type="radio" checked="checked" onclick="document.location='<?php echo base_url(); ?>index.php/Gstn_management/index4';" name="radio1"  />
<div class="control__indicator"></div>
</label>
<label class="control control--radio">Purchases
<input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Gstr2_data/Gstr2_invoice_view';" name="radio2"  />
<div class="control__indicator"></div>
</label>
</div>
              </div>
                  
              </div>
               <ul class="nav nav-tabs">  
      <li >
        <a  href="<?php echo base_url(); ?>index.php/Gstn_management/index4/">INVOICE-MODULE</a>
       
      </li>  
      <li ><a class="dropdown-toggle" data-toggle="dropdown" href="">REGISTERS<span style="margin-left: 8px;" class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/Gstr1_Invoiceupdate">Gstr1-View Data</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Gstr1_b2bupdate">Gstr1-Summary Reports</a></li>
          <li><a href="<?php echo base_url(); ?>index.php/Gstr3b_report">Gstr3B Reports</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url(); ?>index.php/Gstr1_sendmails/">GSTR1-SENDMAILS</a></li>
    
      <li class="active"><a href="<?php echo base_url(); ?>index.php/Gstr1verify_report/index">GSTR1-VALIDATION</a></li>
      <li><a href="<?php echo base_url(); ?>index.php/Gstn_management/expdata">EXPORT DATA</a></li>
    </ul>
              <div class="fh-breadcrumb">
                   <br>
    <div class="row inv">
          <div style="text-align: center;">
<label class="control control--radio">Verified
<input type="radio" checked="checked" onclick="document.location='<?php echo base_url(); ?>index.php/Gstr1verify_report/index';" name="radio"  />
<div class="control__indicator"></div>
</label>
<!-- <label class="control control--radio">Errors
<input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Gstr1Validation/Errors';" name="radio"  />
<div class="control__indicator"></div>
</label> -->
<label class="control control--radio">Error Summary
<input type="radio" onclick="document.location='<?php echo base_url(); ?>index.php/Gstr1_errorsummary_display';" name="radio"  />
<div class="control__indicator"></div>
</label>

</div><br>
<?php $this->load->helper( 'form' ); ?>
                <?php $attributes = array("name" => "locationscearch", "class" => "form-inline");
        echo form_open("Gstr1Validation/index", $attributes);?>
                  <div class="full-height">
                      <div class="full-height-scroll white-bg border-left" style="margin-top: 30px;">
                     <div class="col-md-4">
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
                  
                  <div class="col-md-4">
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
                   <div class="col-md-4">
                   <button type="submit" class="btn btn-success" style="margin-top: 38px;">Verify Data</button>
                  </div>
                  
                  


                      </div>
                  </div>
                 <?php echo form_close(); ?>


              </div>
<script type="text/javascript" charset="utf8"   src="<?php echo base_url("assets/js/jquery.dataTables.js"); ?>"></script> 
<script type="text/javascript" charset="utf8"   src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script> 

<script>
$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
</script>
<script>
        $(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
    </script>
  
 
<script>
$(document).ready(function() {
  $.noConflict();
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
