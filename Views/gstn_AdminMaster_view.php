<?php $firm_name = $this->session->userdata('firm_name');
if(!isset($firm_name)){ redirect ('Welcome');}
?>  
<link href="<?php echo base_url("assets/css/radiostyle.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/codemirror/codemirror.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/codemirror/ambiance.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/plugins/chosen/chosen.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/css/gstadmin.css"); ?>" rel="stylesheet">
           <div class="row wrapper border-bottom white-bg page-heading">
              <div class="col-lg-12 text-center">
                <h1><?php $firm_name = $this->session->userdata('firm_name'); echo $firm_name; ?> - Admin</h1>
              </div>
            </div>
            <br>
            <div class="fh-breadcrumb">

                <div class="full-height">
                    <div class="full-height-scroll white-bg border-left">
                      <?php echo $this->session->flashdata('msg'); ?>
                        <div class="element-detail-box">

                            <div class="tab-content">
                               <div class="ibox-content">
                               <div class="form-group">

                                <div class="col-lg-12">
                                    <div class="row">
                                             <ul class="nav nav-tabs tool-li">  
    <li class="active"><a href="/ci/index.php/Gstn_admin/">COMPANY LETTER HEAD</a></li>  
    <!-- <li><a href="/ci/index.php/Gstn_admin/administrativeControls_view">ADMINISTRATIVE CONTROLS</a></li> -->
    <!-- <li><a href="/ci/index.php/Gst_createuser">CREATE USER</a></li> -->
    <li><a href="/ci/index.php/Gstn_admin/ESign">E-SIGNATURE</a></li>
    <!-- <li><a href="/ci/index.php/Gstn_admin/adminOffice_view">GSTIN DETAILS</a></li> -->
    <li><a href="/ci/index.php/Gstn_admin/adminItemsAndServices_view">ITEMS AND SERVICES</a></li> 
    <!-- <li><a href="/ci/index.php/Gstn_admin/adminDocumentSereis_view">DOCUMENT SERIES NOS</a></li> -->
    <!-- <li><a href="/ci/index.php/Vendor_master">VENDOR MASTER</a></li> -->
    <!-- <li><a href="/ci/index.php/Product_master"> PRODUCT & SERVICES</a></li> -->
    <!-- <li><a href="/ci/index.php/Gstn_admin/itemMaster_view"> ITEM MASTER</a></li> -->
    <li><a href="/ci/index.php/Gstn_admin/excel_view"> EXCEL UPLOADS</a></li>
    <li ><a class="dropdown-toggle" data-toggle="dropdown" href="#">EXCEL MAPPING<span style="margin-left: 8px;" class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="<?php echo base_url(); ?>index.php/Gstn_admin/excel_mapping">GSTR1 EXCEL MAPPING</a></li>
                                              <li><a href="<?php echo base_url(); ?>index.php/Gstn_admin/Gstr2_excel_mapping">GSTR2 EXCEL MAPPING</a></li>
                                            </ul>
                                          </li>
     
    </ul>  
    <div class="full-height">
        <div class="full-height-scroll white-bg border-left">
        <?php echo $this->session->flashdata('messageupload'); ?>
                
                <?php $this->load->helper('form'); ?>
                <?php $attributes = array("name" => "upload_excel");
                                    echo form_open_multipart("Gstn_admin/import", $attributes);?>
            <div class="col-sm-6 text-center">   
              <br>
              <label style="color:#009688;">Please upload the logo</label>
              <input id="upload-file-selector" class="form-control" type="file" name="file" size="20" accept="image/x-png,image/gif,image/jpeg,image/jpg"  required/>
            </div>
        <div class="col-sm-12">
          <button type="submit" style="margin-bottom: 50px;" id="submit" name="import" class="btn btn-info">Submit <i class="fa fa-share-square-o" aria-hidden="true"></i></button>
        </div>
          <?php echo form_close(); ?> 
          <table style="margin-bottom: 10px;" class='table table-bordered'>
                <thead>
                  <tr>
                  <th> Name of the company </th>
                  <th> logo </th>
                </thead>
                  <tbody>
                      <?php for ($i = 0; $i < count($logodetails); ++$i) { ?>
                                <tr>
                                     <td><?php echo $firm_name = $this->session->userdata('firm_name');?></td>
                                      <td><a href="<?php echo base_url(); ?>application/views/gst_client_document_uploads/gst_documents/gstnDetails/<?php echo $logodetails[$i]->filename?>" class="btn btn-primary" role="button">View</a></td> 
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  

