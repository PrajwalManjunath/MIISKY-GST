<style type="text/css">
   
.slimScrollBar{
        
    background: #000 !important;
    width: 12px !important;
    position: absolute;
    top: 0px;
    opacity: 0.4;
    display: none;
    border-radius: 7px;
    z-index: 99;
    right: 1px;
    height: 202.87px;
}
nav{
    font-size: 15px;
}
.nav-header a {
    color: #FFEB3B;
}
.control {
       display: inline-block !important;
}

</style>
<nav class="navbar-default navbar-static-side sidemenu" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <!-- <img alt="image" class="img-circle" src="<?php echo base_url("assets/img/profile_small.jpg"); ?>" /> -->
                                 </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"><?php echo $firm_name; ?></strong>
                                 </span> <!-- <span class="text-muted text-xs block"><b class="caret"></b></span> </span> --> </a>
                        </div>
                    </li>
                       
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Gstn_admin">
                        <span class="nav-label">Administration</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/EnterpriseMapping/Gstn_mapping">
                        <span class="nav-label">Enterprise Mapping</span></a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>index.php/Gstn_dashboard">
                        <span class="nav-label">Dashboard</span></a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>index.php/Gstn_masters">
                        <span class="nav-label">Masters</span></a>
                    </li>
                    
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Gstn_management/index4">
                        <span class="nav-label">GST Management</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/AR">
                        <span class="nav-label">Account Receivable</span></a>
                    </li>
                    
                    <!-- <li>
                        <a href="<?php echo base_url(); ?>index.php/Gstr/rfq">
                        <span class="nav-label">Request For Quote</span></a>
                    </li> -->
                    <!--  <li>
                        <a href="<?php echo base_url(); ?>index.php/Purchase_master">
                        <span class="nav-label">Purchase Management</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Sales_master">
                        <span class="nav-label">Sales Management</span></a>
                    </li> -->
                     <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst/ledger">
                        <span class="nav-label">General Ledger</span></a>
                    </li>
                    <li>
                        
                        <!-- <?php echo $password = $this->session->userdata('password'); ?> -->
                        <a target="_blank" href="http://miisky.com/frontaccounting-master/core/index.php?id=<?php echo$id=$this->session->userdata('id');?>&tok=<?php echo$password=$this->session->userdata('password');?>">
                        <span class="nav-label">Accounting</span></a>
                    </li>
                   <!--  <li>
                        <a href="<?php echo base_url(); ?>index.php/Reports">
                        <span class="nav-label">Reports</span></a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/PayUMoney_form/index">
                        <span class="nav-label">Payment Gateway</span></a>
                    </li>-->
                    <li>
                        <a href="#">
                        <span class="nav-label">Payment Gateway</span></a>
                    </li>
                    <li>
                        <a href="#">
                        <span class="nav-label">GST Simulation</span></a>
                    </li>
                    <li>
                        <a href="#">
                        <span class="nav-label">GST Accumulation</span></a>
                    </li>
                    <li>
                        <a href="#">
                        <span class="nav-label">GST Interactive</span></a>
                    </li>
                    <li>
                        <a href="#">
                        <span class="nav-label">Communication</span></a>
                    </li>
                   <!--  <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst_compliances/gstcal">
                        <span class="nav-label">GST Calender</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst/communication">
                        <span class="nav-label">Communication</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst">
                        <span class="nav-label">GST Formats</span></a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/GstAccumulation">
                        <span class="nav-label">GST Accumulation</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Purchase_retrieve/simulation">
                        <span class="nav-label">GST Simulation</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst_interactive">
                        <span class="nav-label">GST Interactive</span></a>
                    </li> -->
                   <!--  <li>
                        <a href="<?php echo base_url(); ?>index.php/Gst_tag_refer">
                        <span class="nav-label">Tag And Refer</span></a>
                    </li> -->
                   
                    <!-- <li class="<?php //if ($active=="gst_news") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_news"><i class="fa fa-newspaper-o"></i> <span class="nav-label">GST - News</span></a>
                    </li> -->
 
                    <!--  <li class="<?php //if ($active=="know_your_vendor") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_vendor"><i class="fa fa-user-circle"></i> <span class="nav-label">Know your Vendor</span></a>
                    </li>
                    <li class="<?php //if ($active=="know_your_customer") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_customer"><i class="fa fa-users"></i> <span class="nav-label">Know your Customer's</span></a>
                    </li> -->
                   <!--  <li class="<?php //if ($active=="appeals_escalations") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Appeals_escalations"><i class="fa fa-file-audio-o"></i> <span class="nav-label">Appeals and Escalations</span></a>
                    </li>
                     <li class="<?php //if ($active=="gst_credits") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_credits"><i class="fa fa-money"></i> <span class="nav-label">GST - Credits</span></a>
                    </li> 
                    <li class="<?php //if ($active=="business_category") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_business"><i class="fa fa-suitcase"></i> <span class="nav-label">Business Category</span></a>
                    </li>
                    <li class="<?php //if ($active=="gst_services") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_Services"><i class="fa fa-inr"></i> <span class="nav-label">Services Management</span></a>
                    </li>
                    <li class="<?php //if ($active=="gst_notices") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_notices"><i class="fa fa-file-text"></i> <span class="nav-label">Notices</span></a>
                    </li>
                     <li class="<?php //if ($active=="gst_admin") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_admin"><i class="fa fa-id-badge"></i> <span class="nav-label">Admin</span></a>
                    </li>
                    
                    <li class="<?php //if ($active=="gst_supports") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_supports"><i class="fa fa-phone"></i> <span class="nav-label">Supports</span></a>
                    </li>-->
                   <!--  <li class="<?php //if ($active=="gst_credits") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_rules"><i class="fa fa-money"></i> <span class="nav-label">GST - Rules</span></a>
                    </li>
                    <li class="<?php //if ($active=="gst_credits") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_form"><i class="fa fa-money"></i> <span class="nav-label">GST - Forms</span></a>
                    </li>
                    <li class="<?php //if ($active=="gst_credits") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_documents"><i class="fa fa-money"></i> <span class="nav-label">GST - Documents</span></a>
                    </li>
                    <li class="<?php //if ($active=="knowledge") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Gst_knowledge"><i class="fa fa-book"></i> <span class="nav-label">Knowledge</span></a>
                    </li>                  
                  
                    <li class="<?php //if ($active=="document_upload") {echo "active"; } else  {echo " ";}?>">
                        <a href="<?php echo base_url(); ?>index.php/Vendor_document"><i class="fa fa-address-card"></i> <span class="nav-label">Data Uploads</span></a>
                    </li> -->

                     <!-- <li>
                        <a href="<?php echo base_url(); ?>index.php/Others">
                        <span class="nav-label">Others</span></a>
                    </li> -->
                    
                              </ul>

            </div>
        </nav>
    <div id="page-wrapper" class="white-bg">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                
            </div>
                <ul class="nav navbar-top-links navbar-right">               
                    
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
            </div>
