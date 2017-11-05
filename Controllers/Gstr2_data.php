<?php

class Gstr2_data extends CI_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url');
          $this->load->database();
          $this->load->library(array('session', 'form_validation'));
          $this->load->model('User_model');
          $this->load->model('Gst_model');
          $this->load->model('Report_model'); 
          $this->load->model('Gstr_model');
		  //$this->load->library('Breadcrumb');
         		  
     }
    public function check_authentication()
    {            
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile; 
        $data['id'] = $details[0]->id;
		$data['gstno']=$details[0]->gstno;
        return $data;  
        //print_r($details);		  
    }
	
	  
	public function side_menus($data,$viewpage)
    {            
        $this->load->view('view_header', $data);
        $this->load->view('view_menu');
        $this->load->view($viewpage,$data);
        $this->load->view('view_footer');    
        //return $data;  
    }
	
    public function index()
    {            
          $data=$this->check_authentication();
          $data['total_customer'] = $this->Report_model->getTotalcustomer();
          $data['updated_customer'] = $this->Report_model->getUpdatedcustomer();
          $this->load->model('Report_model');  
          $cusresult = $this->Report_model->get_customer_location_list();           
          $data['cuslist'] = $cusresult;	  
		  $viewpage="Gstr2_uploads";
          $this->side_menus($data,$viewpage);
    }
  
	
	
    public function toExcel()
    {
          $data=$this->check_authentication();
          $vault_no = $data['vault_no'];
          $table_name="GSTR2_B2B_invoice_data";
	      $data['details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
          $this->load->view('gstr2_purchase_view',$data);               
    }
  
  
    public function gstr1_sale_details()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];		  
		$table_name="GSTR1_B2BINVOICES";
	    $data['details']=$this->Gstr_model->get_oneValue(array("Customer_vaultno"=>$vault_no),$table_name);
        $viewpage="b2binvoicedetails_view";
        $this->side_menus($data,$viewpage); 
    }
  
    function gstr2_b2b_purchases_view()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_orderbyValue(array("vault_no"=>$vault_no),'inum',$table_name);		
		$viewpage="gstr2_b2b_purchases_view";
        $this->side_menus($data,$viewpage);
		
    }
	
	function gstr2_purchases_main_view()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_groupbyValue(array("vault_no"=>$vault_no),'inum',$table_name);		
		$viewpage="gstr2_purchases_main_view";
        $this->side_menus($data,$viewpage); 
    }
    
	
	function GSTR2_view_purchases_invoice($inum)
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$inum),$table_name);	
//print_r($data['details']);exit;		
		$viewpage="GSTR2_view_purchases_invoice";
        $this->side_menus($data,$viewpage); 
    }
	
	 public function gstr2_invoice_details()
     {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];         
	    $table_name="GSTR2_B2B_invoice_data";
        $data['details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);			
		$viewpage="gstr2_invoice_details";
        $this->side_menus($data,$viewpage); 
        
     }
	 
	 public function GSTR2_purchasesCredential_view()
    {  
        $data=$this->check_authentication();     
        $vault_no = $data['vault_no'];
		
		 $data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);		  
          
         
		  $table_name="Gstr2_sectiontypemaster";
		  $data['section_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
         
          $table_name="Gst_adminDocumentSereis";
		  $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        
          $query=$this->db->get('UQC_master');
          $uqc= $query->result();
          $data['uqc'] = $uqc;
		 
		  $table_name="GstVendorMaster";
		  $data['VendorCode']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  				  
		  $table_name="gst_stateMaster";
		  $data['state']=$this->Gstr_model->get_oneValue(array(),$table_name);
		  
          $table_name="Gst_hsncode_ratemaster";
		  $data['hsn_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
		         
          $table_name="Gst_adminOffice";
	      $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name=" gst_itemmaster_hsc";
		  $data['item_hsc']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name=" gst_itemmaster_sac";
		  $data['item_sac']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  		  
		  $viewpage="GSTR2_purchasesCredential_view";
          $this->side_menus($data,$viewpage); 
         
    }
	
	public function add_purchase_credential(){
        $data=$this->check_authentication();              
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $date = date("Y-m-d H:i:s");
        $section_type = $this->input->post('Section_type'); 
        $Month= $this->input->post('Month');
          $Year= $this->input->post('Year');
          $Financial_period=$Month.$Year;

        $input_data = $this->input->post();			
        $array2 = array( "vault_no" => $vault_no,"Userid" => $Userid,"Financial_period" => $Financial_period,"created_at"=>$date);
        $data= array_merge($input_data , $array2 );	
		  
        $inum = $this->input->post('inum');
		$table_name=" GSTR2_B2B_invoice_data";
		$details=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$inum),$table_name);
	
	    if((count( $details))==0){	   
           $table_name="GSTR2_B2B_invoice_data";              			
		   $id= $this->Gstr_model->insert_details($data,$table_name);
           redirect("Gstr2_data/GSTR2_purchases_add/".$id);		   
		}
	    else{
			 echo"already exists"; 
		}
    }

	 function Gstr2_invoice_view()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
		      $Month= $this->input->post('Month');
          $Year= $this->input->post('Year');
          $Financial_period=$Month.$Year;
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_groupbyValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),'inum',$table_name);		
		$viewpage="Gstr2_invoice_view";
        $this->side_menus($data,$viewpage);
		
    }
function Gstr2_data_view()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
         
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_groupbyValue(array("vault_no"=>$vault_no,"inum!="=>""),"inum",$table_name);    
    $viewpage="Gstr2_data_view";
        $this->side_menus($data,$viewpage);
    
    }
    function Gstr2_invoice_view2()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
          $Month= $this->input->post('Month');
          $Year= $this->input->post('Year');
          $Financial_period=$Month.$Year;
        $table_name="GSTR2_B2B_invoice_data";
        // $id=$this->uri->segment(3);
        $data['details']=$this->Gstr_model->get_groupbyValue(array("vault_no"=>$vault_no),'inum',$table_name);    
        $viewpage="Gstr2_invoice_view";
        $this->side_menus($data,$viewpage);
        $this->session->set_flashdata('msg1','<div class="alert alert-success text-center">Succesfully Added!</div>');
    
    }
	
	
	 public function GSTR2_purchases_add($id)
    {  
          $data=$this->check_authentication();
         
          //load the department_view
          $vault_no = $data['vault_no'];
          /* $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('gst_itemmaster');
          $item= $query->result();
          $data['item'] = $item;*/
		  
		  $table_name="GSTR2_B2B_invoice_data";
		  $data['b2b_details']=$this->Gstr_model->get_oneValue(array("id"=>$id,"vault_no"=>$vault_no),$table_name);
		  
        //  print_r($data['b2b_details']);exit;
         $table_name="Gstr2_sectiontypemaster";
		  $data['section_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
         
          $table_name="Gst_adminDocumentSereis";
		  $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
          // $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('UQC_master');
          $uqc= $query->result();
          $data['uqc'] = $uqc;
		  		 
		  /*$purchase_voucher_number=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		   $pvn_pold=max($purchase_voucher_number[0]->Purchase_Voucher_Number);
		   $pvn=$pvn_pold+1;
		   $data['PVN']=$pvn;*/
		  $table_name="gst_vendor_location";
		  $data['vendor_code']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		 // $data['vendor_code']=$this->Gstr_model->get_vendor_code($vault_no);
				  
		  $table_name="gst_stateMaster";
		  $data['state']=$this->Gstr_model->get_oneValue(array(),$table_name);
		  
          $table_name="Gst_hsncode_ratemaster";
		  $data['hsn_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
		         
          $table_name="Gst_adminOffice";
	      $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name=" gst_itemmaster_hsc";
		  $data['item_hsc']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name=" gst_itemmaster_sac";
		  $data['item_sac']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		   
		 $table_name=" GSTR2_B2B_invoice_data"; 
		// $gstresulthsn = $this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$data['b2b_details'][0]->inum,"hsn_sc!="=>""),$table_name);
         $gstresulthsn = $this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$data['b2b_details'][0]->inum,"uqc!="=>""),$table_name);		 
         $data['gstlisthsn'] = $gstresulthsn;
		  		  
		  $viewpage="GSTR2_createInvoice_view";
          $this->side_menus($data,$viewpage); 
          
    }

	
    public function GSTR2_purchases_view()
    {  
          $data=$this->check_authentication();         
          //load the department_view
          $vault_no = $data['vault_no'];
          /* $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('gst_itemmaster');
          $item= $query->result();
          $data['item'] = $item;*/
		  
		  $table_name="Gstr2_sectiontypemaster";
		  $data['section_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
         
          $table_name="Gst_adminDocumentSereis";
		  $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
          // $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('UQC_master');
          $uqc= $query->result();
          $data['uqc'] = $uqc;
		  		 
		  /*$purchase_voucher_number=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		   $pvn_pold=max($purchase_voucher_number[0]->Purchase_Voucher_Number);
		   $pvn=$pvn_pold+1;
		   $data['PVN']=$pvn;*/
		  $table_name="gst_vendor_location";
		  $data['vendor_code']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		 // $data['vendor_code']=$this->Gstr_model->get_vendor_code($vault_no);
				  
		  $table_name="gst_stateMaster";
		  $data['state']=$this->Gstr_model->get_oneValue(array(),$table_name);
		  
          $table_name="Gst_hsncode_ratemaster";
		  $data['hsn_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
		         
          $table_name="Gst_adminOffice";
	      $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name="gst_itemmaster_hsc";
		  $data['item_hsc']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name="gst_itemmaster_sac";
		  $data['item_sac']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  		  
		  $viewpage="GSTR2_purchases_view";
          $this->side_menus($data,$viewpage); 
         
    }
	
	 public function GSTR2_purchases_edit($id)
    {  
          $data=$this->check_authentication();         
          //load the department_view
          $vault_no = $data['vault_no'];
          /* $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('gst_itemmaster');
          $item= $query->result();
          $data['item'] = $item;*/		  
		  $table_name="GSTR2_B2B_invoice_data";
		  $data['b2b_details']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);          
          $table_name="Gst_adminDocumentSereis";
		  $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
          // $this->db->where('vault_no', $vault_no);
          $query=$this->db->get('UQC_master');
          $uqc= $query->result();
          $data['uqc'] = $uqc;		  
		  $table_name="Gst_adminDocumentSereis";
		  $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  /*$purchase_voucher_number=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		   $pvn_pold=max($purchase_voucher_number[0]->Purchase_Voucher_Number);
		   $pvn=$pvn_pold+1;
		   $data['PVN']=$pvn;*/
		  $table_name="gst_vendormaster";
		  $data['vendor_code']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);		  
		  // $data['vendor_code']=$this->Gstr_model->get_vendor_code($vault_no);				  
		  $table_name="gst_stateMaster";
		  $data['state']=$this->Gstr_model->get_oneValue(array(),$table_name);
		  
          $table_name="Gst_hsncode_ratemaster";
		  $data['hsn_details']=$this->Gstr_model->get_oneValue(array(),$table_name);
		         
          $table_name="Gst_adminOffice";
	      $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		  $table_name="gst_productmaster";
		  $data['item']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  		  
		  $viewpage="Gstr2_editPurchase_view";
          $this->side_menus($data,$viewpage); 
         
    }

	public function get_poslocation(){
		 $data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);	
       //check if is an ajax request
        if($this->input->is_ajax_request()){
        //checks if the variable data exists on the posted data
            if($this->input->post('data')){
			    $gstin=$this->input->post('data');
			    $table_name="Gst_adminOffice";
			    $gstin=$this->Gstr_model->get_oneValue(array("GSTIN_No"=>$gstin),$table_name);		
			    $pos_loc =$gstin[0]->Address;                           
                print_r($pos_loc);
            }
        }
    }
	
	public function get_state(){
       //check if is an ajax request
        if($this->input->is_ajax_request()){
        //checks if the variable data exists on the posted data
            if($this->input->post('data')){
			    $state_code=$this->input->post('data');
			    $table_name="gst_stateMaster";
			    $state_deatils=$this->Gstr_model->get_oneValue(array("StateCode"=>$state_code),$table_name);		
			    $state =$state_deatils[0]->StateName;           
                //query in your model you should verify if the data passed is legit before querying          
                print_r($state);
            }
        }
    }

    public function get_supinfo(){
        //check if is an ajax request
        if($this->input->is_ajax_request()){
            //checks if the variable data exists on the posted data
            if($this->input->post('data')){
			    $sup_code=$this->input->post('data');
				
			    $table_name="GstVendorMaster";
			   $sup_details=$this->Gstr_model->get_oneValue(array("VendorCode"=>$sup_code),$table_name);
			   // print_r($sup_detailsss);  print_r(json_encode($sup_detailsss));
               // $sup_details=$this->Report_model->gst_sup_info($sup_code);	//print_r($sup_details);			
              
				$details=json_encode($sup_details);
                print_r($details);
            }
        }
    }
	
	
	
	 public function get_hsn(){
        //check if is an ajax request
        if($this->input->is_ajax_request()){
            //checks if the variable data exists on the posted data
            if($this->input->post('data')){
			    $ProductName=$this->input->post('data');
			    $table_name="gst_itemmaster_hsc";
			    $item_details=$this->Gstr_model->get_oneValue(array("ItemCode"=>$ProductName),$table_name);					           
                //query in your model you should verify if the data passed is legit before querying
                // $price = $this->your_model->get_price($this->input->post('data', TRUE));
				$details=json_encode($item_details);
				//$hsn =$item_details[0]->Hsncode;  				
                print_r($details);
            }
        }
    }
	
	 public function get_sac(){
        //check if is an ajax request
        if($this->input->is_ajax_request()){
            //checks if the variable data exists on the posted data
            if($this->input->post('data')){
			    $ProductName=$this->input->post('data');
			    $table_name="gst_itemmaster_sac";
			    $item_details=$this->Gstr_model->get_oneValue(array("ItemCode"=>$ProductName),$table_name);					           
                //query in your model you should verify if the data passed is legit before querying
                // $price = $this->your_model->get_price($this->input->post('data', TRUE));
				$details=json_encode($item_details);
				//$hsn =$item_details[0]->Hsncode;  				
                print_r($details);
            }
        }
    }

    public function add_b2b_purchase(){
        $data=$this->check_authentication();		
        $vault_no=$data["vault_no"];
        $date = date("Y-m-d H:i:s");
	    $section_type = $this->input->post('Gstr2_tableref');	       
        $table_name="Gstr2_sectiontypemaster";
		$section_details=$this->Gstr_model->get_oneValue(array("Gstr_tableref"=>$section_type),$table_name);
        $section=$section_details[0]->Section_type;		
 	    $input_data = $this->input->post();	
		
        $inum = $this->input->post('inum');		
	    $array2 = array( "vault_no" => $vault_no,"created_at"=>$date,"Section_type"=> $section);
	    $data= array_merge($input_data , $array2 );	
		$table_name="GSTR2_B2B_invoice_data";
        $id= $this->Gstr_model->insert_details($data,$table_name);
	   // switch ($section_type)
	    //{              
             //case '3':
               /* $table_name="GSTR2_B2B_invoice_data";
                if($this->input->post('id'))
				{
					$id=$this->input->post('id');
					$this->Gstr_model->update_details($data,$data1=array("id"=>$id),$table_name);print_r("updated");
                }	
                else
				{					
					$id= $this->Gstr_model->insert_details($data,$table_name);echo"success";										
		        }*/
				redirect('Gstr2_data/GSTR2_purchases_add/'.$id);
				redirect('Gstr2_data/GSTR2_journalVoucherPurchases_view/'.$id);             	
				$sup_code=$this->input->post('sup_code');
				$table_name="gst_vendor_location";
				$supplier_details=$this->Gstr_model->get_oneValue(array("sup_code"=>$sup_code),$table_name);
				$sup_email= $client_name = $supplier_details[0]->EmailID;				 
				$this->db->where('vault_no', $vault_no);
                $query=$this->db->get('client_mailing_details');
                $client_details= $query->result();
                $data['client_details'] = $client_details;
                $client_name = $client_details[0]->client_name;
                $userid = $client_details[0]->userid;
                $client_mail = $client_details[0]->client_mail;
                $client_pid = $client_details[0]->Provisional_ID;
                $client_contact_no = $client_details[0]->Contact_no;

                $ContactPerson = $client_details[0]->ContactPerson;
                $QueryMail = $client_details[0]->QueryMail;
                $ContactAddress = $client_details[0]->ContactAddress;
                $State = $client_details[0]->State;
		        $Vault_decript = base64_encode($data['vault_no']);

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
		

                $message =
                 '<!-- html ignored --><!-- head ignored --><!-- meta ignored -->
<div class="row wrapper border-bottom white-bg page-heading">&nbsp;</div>
<p>&nbsp;</p>
<div class="fh-breadcrumb">
<div class="full-height">
<div class="full-height-scroll white-bg border-left">
<div class="element-detail-box">
<div class="tab-content">
<div class="ibox-content">
<div class="form-group">
<div class="col-lg-12">
<div class="row">
<h2 align="center"><strong> WORKFLOW MAIL &ndash; Input Entry Acceptance</strong></h2>
<br /><br />
<div>
<div class="col-md-12">
<h3 align="left">Dear Sir / Madam,</h3>
<div class="col-md-3" style="display: block;">&nbsp;</div>
<br />
<div class="col-md-12">
<div class="col-md-6" style="display: block; padding: 0px;">
<h3 style="display: block;" align="left">Company name :Miisky Technovation</h3>
</div>
</div>
<div class="col-md-12">
<p style="">Has generated Invoice No :'.$invoice_no.'&nbsp; &nbsp; Dated :'.$invoice_date.' &nbsp; </p>
<p style="">Have been accepted &nbsp; </p>
</div>
</div>
</div>
<div class="col-md-12" style="margin-left: 10px;">
<p style=">Thanks for your co-operation</p>
<p>MIISKY MAIL</p>
</div>
<div style="min-height: 100%;">&nbsp;</div>

</div>
<br /> <br /> <br /><br /></div>
</div>
<hr /></div>
</div>
</div>
</div>
</div>
</div>
</div>';
				
	//$mail_to = "$Email_decript";
        // $from_mail = $client_mail;

        $mail_to =  $sup_email;
        $from_mail = $client_mail;
        $from_name = $client_name;
        $reply_to = $client_mail;
        $subject = "Invoice Details ".$client_name." ";

        //$file_name = $datamail['varafile'];
        //$path = realpath('uploads/abstract');

        // Read the file content
        //$file = $path . '/' . $file_name;

        $this->load->library('email', $config);
        $this->email->from($from_mail, $from_name);
        $this->email->to($mail_to);
        $this->email->cc($client_mail);
         {
			$this->email->bcc('innovations@miisky.com');
        }
        $this->email->subject($subject);
        $this->email->message($message);
        //$this->email->attach($file);
        if ($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Mail Succesfully Sent!</div>');
             redirect('Gstr2_data/GSTR2_journalVoucherPurchases_view/'.$id);
        }	
				
          /*  break;             
        case 'B2BUR':			
				$table_name="GSTR2_B2BUR_invoice_data";	
				$this->Gstr_model->insert_details($data,$table_name);
				// $this->Gst_model->insert_gstr2_b2b_data($data);			
		    break;
        default:
                   $this->load->view('spreadsheet_view',$data);
	    }*/
	    //array_push($data,$data["vault_no"]);
	    //print_r( $data);exit;
		
	}
	public function view_purchase_validate($id)
	{
		$data=$this->check_authentication();
          // print_r($cust_details);
          //load the department_view		 
        $table_name="GSTR2_B2B_invoice_data";
        $data['b2b_details']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('GSTR2_purchases_validate',$data);
        $this->load->view('view_footer', $data);
	}

	public function add_details(){
		    $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
            $data['firm_name'] = $details[0]->firm_name;
            $data['email'] = $details[0]->email;
            $vault_no= $details[0]->vault_no;   
            $data["vault_no"]=$vault_no;
            $date = date("Y-m-d H:i:s");
            $input_data = $this->input->post();
			$array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
			$data= array_merge($input_data , $array2 );
			$this->Gst_model->insert_gstr2_data($data);
			//array_push($data,$data["vault_no"]);
			print_r( $data);exit;		
	}
	public function add_b2b_details(){
            $this->load->model('Gstr_model'); 
	        $data=$this->check_authentication();
           
            $data["vault_no"]=$vault_no;
            $date = date("Y-m-d H:i:s");
	        $section_type = $this->input->post('Section_type');
	        $input_data = $this->input->post();			
	        $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
	        $data= array_merge($input_data , $array2 );
	        //print_r($section_type);exit;
	    switch ($section_type)
	    {
              
            case 'B2B':
			      $gstr1_id = $this->input->post('gstr1_id');
			      $gstr_id=$this->Gstr_model->get_check_exists($gstr1_id);
		          if(count($gstr_id)==0){
                   $table_name="GSTR2_B2B_invoice_data";	
		           $this->Gstr_model->insert_details($data,$table_name);echo"success";			      	
                  // $this->Gst_model->insert_gstr2_b2b_data($data);
				  }
				  else{
					  $this->Gstr_model->update_gstr2_b2b_data($data,$gstr1_id);
				  }
                  break;
             
            case 'B2BA':
			$gstr1_id = $this->input->post('gstr1_id');
			$gstr_id=$this->Gstr_model->get_b2ba_check_exists($gstr1_id);
			if(count($gstr_id)==0){
				$table_name="GSTR2_B2BA_invoices";	
				$this->Gstr_model->insert_details($data,$table_name);
				// $this->Gst_model->insert_gstr2_b2b_data($data);
			}
			else{
				//$this->Gst_model->update_gstr2_b2b_data($data,$gstr1_id);
				$table_name="GSTR2_B2BA_invoices";	
				$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
			}
			break;
              default:
                   $this->load->view('spreadsheet_view',$data);
	    }
	    //array_push($data,$data["vault_no"]);
	    //print_r( $data);exit;
		
	}
	
	 public function GSTR_b2b_view()
    {  
          
          $data=$this->check_authentication();          
           // print_r($cust_details);
          //load the department_view
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('Gstr2_b2b',$data);
          $this->load->view('view_footer', $data);
    }
        public function do_update()
        {
            $data=$this->check_authentication();
            $date = date("Y-m-d H:i:s");
            $id = $this->input->post('id');
            // print($id);
            // echo "<br>";
            $Customer_ID = $this->input->post('Customer_ID');
            $CustomerCode = $this->input->post('CustomerCode');
            $CustomerName = $this->input->post('CustomerName');
            $Address= $this->input->post('Address');
            $State= $this->input->post('State');
            $Location= $this->input->post('Location');
            $PIN_CODE= $this->input->post('PIN_CODE');
            $GSTN_contactperson = $this->input->post('GSTN_contactperson');
            $GSTN_contactNo= $this->input->post('GSTN_contactNo');
            $GSTN_emailID= $this->input->post('GSTN_emailID');
            $ARN_No= $this->input->post('ARN_No');
            $total = count($_FILES['upload']['name']);
            for($i=0; $i<$total; $i++) {
              $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
              $newFilePath = $_FILES['upload']['name'][$i];
              $newFilePath1 = "application/views/gst_client_document_uploads/gst_documents/gstn_details_customer/". $_FILES['upload']['name'][$i] ;
              $fil1=move_uploaded_file($tmpFilePath, $newFilePath1);

            $GSTIN_No= $this->input->post('GSTIN_No');
            $date = date("Y-m-d H:i:s");
                        $data = array(
                                        'Customer_ID' => $Customer_ID,
                                        'CustomerCode ' =>$CustomerCode ,
                                        'CustomerName ' =>$CustomerName ,
                                        'Address' =>$Address,
                                        'State' =>$State,
                                        'Location' =>$Location,
                                        'PIN_CODE' =>$PIN_CODE,
                                        'GSTN_contactperson ' =>$GSTN_contactperson,
                                        'GSTN_contactNo' =>$GSTN_contactNo,
                                        'GSTN_emailID' =>$GSTN_emailID,                                    
                                        'GSTIN_No' =>$GSTIN_No,
                                         'ARN_No' =>$ARN_No,
                                         'vault_no'=>$data['vault_no'],
                                         'FinalDoc' =>$newFilePath,
                                        'updated_at' =>$date
                                    );
                      }
                       
                        $this->Gst_model->update_gst_customer_location($id,$data);
                        //var_dump($upda); echo "<br>";
                        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Updated!</div>');
                            // var_dump($data);
                            redirect('Customerlocation');
                        
                        
                
        }


       public function view_b2b_gstr1_details(){
		  $data=$this->check_authentication();
         // $data['vault_no'] = $details[0]->vault_no;
		  $vault_no= $data['vault_no'];
         
          $data['total_customer'] = $this->Report_model->getTotalcustomer();
          $data['updated_customer'] = $this->Report_model->getUpdatedcustomer();
          //load the department_model
          $this->load->model('Report_model');  
          //call the model function to get the department data
          $cusresult = $this->Report_model->get_customer_location_list();           
          $data['cuslist'] = $cusresult;
		  $this->db->where('vault_no',$vault_no); 
		  $query=$this->db->get('GSTR1_B2BINVOICES');
          $custlist= $query->result();
          $data['custlist'] = $custlist;
          // print_r($cust_details);
          //load the department_view
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('b2b_gstr1_details_view',$data);
          $this->load->view('view_footer', $data);	
	}

        public function acceptto_gstr2($id){
		$this->load->model('Gstr_model');
		$details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $vault_no= $details[0]->vault_no;   
        $data["vault_no"]=$vault_no;
        $date = date("Y-m-d H:i:s");
		
		$this->db->where('id', $id);
        $query=$this->db->get('GSTR1_B2BINVOICES');
        $list= $query->result();
		$gstr1_id=$list[0]->id;
        $data=array(
			'supplier_vault_no'=>$list[0]->Seller_vaultno,
			'buyer_vault_no'=>$list[0]->Customer_vaultno,
			'supplier_loc_vault_no'=>$list[0]->Subcustomer_vaultno,
			'ctin'=>$list[0]->Gstinno_seller,
			'Gstin_uid_purchaser'=>$list[0]->Gstinno_seller,
			'inum'=>$list[0]->inum,
			'idt'=>$list[0]->idt,
			'val'=>$list[0]->val,
			'rchrg'=>$list[0]->rchrg,
			'pos_location'=>$list[0]->pos,
			'ty'=>$list[0]->ty,
			'hsn_sc'=>$list[0]->hsn_sc,
			'basic_rate'=>$list[0]->Basic_rate,
			'discount'=>$list[0]->Discount,
			'discount_value'=>$list[0]->DiscountValue,
			'net_basic'=>$list[0]->Basic_value,
			'uqc'=>$list[0]->Uqt,
			'qty_purchased'=>$list[0]->Quantity,
			'txval'=>$list[0]->txval,
			'irt'=>$list[0]->irt,
			'iamt'=>$list[0]->iamt,
			'crt'=>$list[0]->crt,
			'camt'=>$list[0]->camt,
			'srt'=>$list[0]->srt,
			'samt'=>$list[0]->samt,
			'csrt'=>$list[0]->csrt,
			'csamt'=>$list[0]->csamt,
			'gstr1_id'=>$list[0]->id,
			'vault_no'=>$data["vault_no"],
			'created_at' =>$date
		);
		$gstr_id=$this->Gstr_model->get_check_exists($gstr1_id);
		//print_r(count($gstr_id));exit;
		if(count($gstr_id)==0){
		$this->Gstr_model->insert_gstr2_b2b_data($data);
		$this->session->set_flashdata('message','<div class="alert alert-success text-center">Accepted..</div>');
		redirect('Gstr2_data/view_b2b_gstr1_details');	
		}
		else
		{
		$this->session->set_flashdata('message','<div class="alert alert-success text-center">already exists..</div>');
		redirect('Gstr2_data/view_b2b_gstr1_details');	
		}
		
	}
       public function view_gstr2_imps()
    {  
          
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['firm_name'] = $details[0]->firm_name;
          $data['email'] = $details[0]->email;
          $data['vault_no'] = $details[0]->vault_no;
          $data['mobile'] = $details[0]->mobile;
		  $table_name="GSTR1_B2BINVOICES";
		  $id=$this->uri->segment(3);
		  $data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('view_gstr2_imps',$data);
          $this->load->view('view_footer', $data);
    }

    public function add_imps_details(){
       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
       $data['firm_name'] = $details[0]->firm_name;
       $data['email'] = $details[0]->email;
       $vault_no= $details[0]->vault_no;   
       $data["vault_no"]=$vault_no;
       $date = date("Y-m-d H:i:s");
       $section_type = $this->input->post('Section_type');

       $input_data = $this->input->post();
			
       $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
       $data= array_merge($input_data , $array2 );
						
	switch ($section_type)
	{
              
              case 'IMPS':
                 
	          $gstr1_id = $this->input->post('gstr1_id');
                  $table_name="GSTR2_IMPS_invoice_data";
                  $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		  if(count($gstr_id)==0){
				
			$this->Gstr_model->insert_details($data,$table_name);	print_r( $data);exit;						
		  }
		  else{
			$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);print_r("updated");
		  }
	      break;
              case 'IMPSA':
		  $gstr1_id = $this->input->post('gstr1_id');
		  $gstr_id=$this->Gstr_model->get_check_exists($gstr1_id);
                  $table_name="GSTR2_IMPSA_invoice_data";	
		  if(count($gstr_id)==0){
			
			$this->Gstr_model->insert_details($data,$table_name);
							
		  }
		  else{
		        $this->Gst_model->update_gstr2_b2b_data($data,$gstr1_id);
			$table_name="GSTR2_B2BA_invoices";	
			$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
		  }
	      break;
              default:
                   $this->load->view('spreadsheet_view',$data);
			}
			
			
		
	}

        public function view_gstr2_impg()
    {  
          
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['firm_name'] = $details[0]->firm_name;
          $data['email'] = $details[0]->email;
          $data['vault_no'] = $details[0]->vault_no;
          $data['mobile'] = $details[0]->mobile;
		  $table_name="GSTR1_B2BINVOICES";
		  $id=$this->uri->segment(3);
		  $data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('view_gstr2_impg',$data);
          $this->load->view('view_footer', $data);
    }

     public function add_impg_details(){
       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
       $data['firm_name'] = $details[0]->firm_name;
       $data['email'] = $details[0]->email;
       $vault_no= $details[0]->vault_no;   
       $data["vault_no"]=$vault_no;
       $date = date("Y-m-d H:i:s");
       $section_type = $this->input->post('Section_type');
       $input_data = $this->input->post();			
       $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
       $data= array_merge($input_data , $array2 );
	   $gstr1_id = $this->input->post('gstr1_id');				
	   switch ($section_type)
	   {
              
            case 'IMPG':         	            
                $table_name="GSTR2_IMPG_invoice_data";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		        if(count($gstr_id)==0){				
					$this->Gstr_model->insert_details($data,$table_name);	print_r( $data);exit;						
				}
				else{
					$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);print_r("updated");
				}
				break;
            case 'IMPGA':				
				$table_name="GSTR2_IMPGA_invoice_data";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
				if(count($gstr_id)==0){			
					$this->Gstr_model->insert_details($data,$table_name);							
		        }
				else{
					$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
				}
				break;
             default:
                   
		}
	}

        public function view_gstr2_cdn()
        {  
          
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['firm_name'] = $details[0]->firm_name;
          $data['email'] = $details[0]->email;
          $data['vault_no'] = $details[0]->vault_no;
          $data['mobile'] = $details[0]->mobile;
	      $table_name="GSTR1_B2BINVOICES";
	      $id=$this->uri->segment(3);
	      $data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('view_gstr2_cdn',$data);
          $this->load->view('view_footer', $data);
       }


       public function add_cdn_details(){
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['firm_name'] = $details[0]->firm_name;
          $data['email'] = $details[0]->email;
          $vault_no= $details[0]->vault_no;   
          $data["vault_no"]=$vault_no;
          $date = date("Y-m-d H:i:s");
          $section_type = $this->input->post('Section_type');
          $input_data = $this->input->post();			
          $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
          $data= array_merge($input_data , $array2 );
	  $gstr1_id = $this->input->post('gstr1_id');				
	  switch ($section_type)
	  {
              
            case 'CDN':         	            
                $table_name="GSTR2_CDN_Payload";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		if(count($gstr_id)==0){				
		     $this->Gstr_model->insert_details($data,$table_name);	print_r( $data);exit;						
		}
		else{
		     $this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);print_r("updated");
		}
		break;
            case 'CDNA':
				
		$table_name=" GSTR2_CDNA_payload";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		if(count($gstr_id)==0){			
			$this->Gstr_model->insert_details($data,$table_name);							
		}
		else{
		        $this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
		}
		break;
            default:
                   
	  }
      }

      public function view_gstr2_b2bur()
    {  
          
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
	    $table_name="GSTR1_B2BINVOICES";
	    $id=$this->uri->segment(3);
	    //$data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
		$data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id ,"ctin"=>"37AAHCS8120M1ZY"),$table_name);	print_r($data['custlist']);exit;
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('view_gstr2_b2bur',$data);
        $this->load->view('view_footer', $data);
    }

     public function add_b2bur_details(){
       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
       $data['firm_name'] = $details[0]->firm_name;
       $data['email'] = $details[0]->email;
       $vault_no= $details[0]->vault_no;   
       $data["vault_no"]=$vault_no;
       $date = date("Y-m-d H:i:s");
       $section_type = $this->input->post('Section_type');
       $input_data = $this->input->post();			
       $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
       $data= array_merge($input_data , $array2 );
       $gstr1_id = $this->input->post('gstr1_id');				
       switch ($section_type)
       {             
            case 'B2BUR':         	            
                $table_name="GSTR2_B2BUR_invoice_data";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		if(count($gstr_id)==0){				
			$this->Gstr_model->insert_details($data,$table_name);	print_r( $data);echo'insereted';exit;						
		}
		else{
			$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);print_r("updated");
		}
		break;
            case 'B2BURA':	
		$table_name="GSTR2_B2BURA_invoices";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		if(count($gstr_id)==0){			
			$this->Gstr_model->insert_details($data,$table_name);							
		}
		else{
			$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
		}
		break;
            default:                   
	}
     }

     public function view_nil_rated_supply()
    {  
          
        $data=$this->check_authentication(); 
		$table_name="GSTR1_B2BINVOICES";
		$id=$this->uri->segment(3);
		$data['custlist']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
		
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('view_nil_rated_supply',$data);
        $this->load->view('view_footer', $data);
    }

     public function add_nil_rated_supply(){
      $data=$this->check_authentication(); 
       $data["vault_no"]=$vault_no;
       $date = date("Y-m-d H:i:s");
       $section_type = $this->input->post('Section_type');
       $input_data = $this->input->post();			
       $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
       $data= array_merge($input_data , $array2 );
	   $gstr1_id = $this->input->post('gstr1_id');				
	   switch ($section_type)
	   {             
            case 'Nil_rated':         	            
                $table_name="GSTR2_nil_rated_invoice";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		        if(count($gstr_id)==0){				
					$this->Gstr_model->insert_details($data,$table_name);	print_r( $data);echo'insereted';exit;						
				}
				else{
					$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);print_r("updated");
				}
				break;
            case 'B2BURA':	
				$table_name="GSTR2_B2BURA_invoices";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
				if(count($gstr_id)==0){			
					$this->Gstr_model->insert_details($data,$table_name);							
		        }
				else{
					$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
				}
				break;
             default:                   
		}
	}
	

     public function add_b2b_purchase_validate(){
       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
       $data['firm_name'] = $details[0]->firm_name;
       $data['email'] = $details[0]->email;
       $vault_no= $details[0]->vault_no;   
       $data["vault_no"]=$vault_no;
       $date = date("Y-m-d H:i:s");
       $section_type = $this->input->post('Section_type');
       $input_data = $this->input->post();			
       $array2 = array( "vault_no" => $vault_no,"created_at"=>$date);
       $data= array_merge($input_data , $array2 );
       $id = $this->input->post('id');
       $invoice_no=$this->input->post('purchase_invoice_number');
	   $invoice_date=$this->input->post('oidt');	   
       switch ($section_type)
       {             
             case 'B2B':         	            
                $table_name="GSTR2_B2B_invoice_data";
                $update_id=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);		        
		        $this->Gstr_model->update_details($data,$data1=array("id"=>$id),$table_name);print_r("updated");
		        $this->db->where('vault_no', $vault_no);
                $query=$this->db->get('client_mailing_details');
                $client_details= $query->result();
                $data['client_details'] = $client_details;
                $client_name = $client_details[0]->client_name;
                $userid = $client_details[0]->userid;
                $client_mail = $client_details[0]->client_mail;
                $client_pid = $client_details[0]->Provisional_ID;
                $client_contact_no = $client_details[0]->Contact_no;

                $ContactPerson = $client_details[0]->ContactPerson;
                $QueryMail = $client_details[0]->QueryMail;
                $ContactAddress = $client_details[0]->ContactAddress;
                $State = $client_details[0]->State;
		        $Vault_decript = base64_encode($data['vault_no']);

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
		
		$message =
                 '<!-- html ignored --><!-- head ignored --><!-- meta ignored -->
<div class="row wrapper border-bottom white-bg page-heading">&nbsp;</div>
<p>&nbsp;</p>
<div class="fh-breadcrumb">
<div class="full-height">
<div class="full-height-scroll white-bg border-left">
<div class="element-detail-box">
<div class="tab-content">
<div class="ibox-content">
<div class="form-group">
<div class="col-lg-12">
<div class="row">
<h2 align="center"><strong> WORKFLOW MAIL &ndash; Input Entry Acceptance</strong></h2>
<br /><br />
<div>
<div class="col-md-12">
<h3 align="left">Dear Sir / Madam,</h3>
<div class="col-md-3" style="display: block;">&nbsp;</div>
<br />
<div class="col-md-12">
<div class="col-md-6" style="display: block; padding: 0px;">
<h3 style="display: block;" align="left">Company name :Miisky Technovation</h3>
</div>
</div>
<div class="col-md-12">
<p style="">Has generated Invoice No :'.$invoice_no.'&nbsp; &nbsp; Dated :'.$invoice_date.' &nbsp; </p>
<p style="">Have been accepted &nbsp; </p>
</div>
</div>
</div>
<div class="col-md-12" style="margin-left: 10px;">
<p style=">Thanks for your co-operation</p>
<p>MIISKY MAIL</p>
</div>
<div style="min-height: 100%;">&nbsp;</div>

</div>
<br /> <br /> <br /><br /></div>
</div>
<hr /></div>
</div>
</div>
</div>
</div>
</div>
</div>';
				
	//$mail_to = "$Email_decript";
        // $from_mail = $client_mail;

        $mail_to = "snehahegde100@gmail.com";
        $from_mail = $client_mail;
        $from_name = $client_name;
        $reply_to = $client_mail;
        $subject = "Online Vendor GST Updation for ".$client_name." ";

        //$file_name = $datamail['varafile'];
        //$path = realpath('uploads/abstract');

        // Read the file content
        //$file = $path . '/' . $file_name;

        $this->load->library('email', $config);
        $this->email->from($from_mail, $from_name);
        $this->email->to($mail_to);
        $this->email->cc($client_mail);
        if($vault_no==536391560078253548){
        $this->email->bcc('kalpana.mukherjee@sequent.in, mayank.shah@sequent.in, Lalitkumar.L@sequent.in, ravi.aray@sequent.in, innovations@miisky.com');
        }else{
			$this->email->bcc('innovations@miisky.com');
        }
        $this->email->subject($subject);
        $this->email->message($message);
        //$this->email->attach($file);
        if ($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Mail Succesfully Sent!</div>');
             redirect('Gstr2_data/GSTR2_journalVoucherPurchases_view/'.$id);
        }	

		
		break;
             case 'B2BA':	
		$table_name="GSTR2_B2BURA_invoices";
                $gstr_id=$this->Gstr_model->get_oneValue(array("gstr1_id"=>$gstr1_id),$table_name);
		if(count($gstr_id)==0){			
			$this->Gstr_model->insert_details($data,$table_name);							
		}
		else{
			$this->Gstr_model->update_details($data,$data1=array("gstr1_id"=>$gstr1_id),$table_name);
		}
		break;
             default:                   
        }
    }

       public function update_reject($id){
        $data=$this->check_authentication();  
        $data["vault_no"]=$vault_no;
        $date = date("Y-m-d H:i:s");
        $section_type = $this->input->post('Section_type');             	            
        $table_name="GSTR2_B2B_invoice_data";               
        
		
		$detail=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);	
        $invoice_no = $detail[0]->purchase_invoice_number;
	    $invoice_date =  $detail[0]->oidt;
		$this->Gstr_model->delete_row($data=array("id"=>$id),$table_name);
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('client_mailing_details');
        $client_details= $query->result();
        $data['client_details'] = $client_details;
        $client_name = $client_details[0]->client_name;
        $userid = $client_details[0]->userid;
        $client_mail = $client_details[0]->client_mail;
        $client_pid = $client_details[0]->Provisional_ID;
        $client_contact_no = $client_details[0]->Contact_no;

        $ContactPerson = $client_details[0]->ContactPerson;
        $QueryMail = $client_details[0]->QueryMail;
        $ContactAddress = $client_details[0]->ContactAddress;
        $State = $client_details[0]->State;
		$Vault_decript = base64_encode($data['vault_no']);

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
		$message =
                 '<!-- html ignored --><!-- head ignored --><!-- meta ignored -->
<div class="row wrapper border-bottom white-bg page-heading">&nbsp;</div>
<p>&nbsp;</p>
<div class="fh-breadcrumb">
<div class="full-height">
<div class="full-height-scroll white-bg border-left">
<div class="element-detail-box">
<div class="tab-content">
<div class="ibox-content">
<div class="form-group">
<div class="col-lg-12">
<div class="row">
<h2 align="center"><strong> WORKFLOW MAIL &ndash; INVOICE GENERATION </strong></h2>
<br /><br />
<div>
<div class="col-md-12">
<h3 align="left">Dear Sir / Madam,</h3>
<div class="col-md-3" style="display: block;">&nbsp;</div>
<br />
<div class="col-md-12">
<div class="col-md-6" style="display: block; padding: 0px;">
<h3 style="display: block;" align="left">Company name :</h3>
</div>
</div>
<div class="col-md-12">
<p style="">Has generated Invoice No :'.$invoice_no.'&nbsp; &nbsp; Dated :'.$invoice_date.' &nbsp; </p>
</div>
</div>
<div class=" row">
<div style="text-align: center; margin-top: 20px; margin-bottom: 20px;"><label class="control control--radio" ><label class="control control--radio" > <input checked="checked" name="radio" type="radio" />ACCEPT</label></label>
<div class="control__indicator">&nbsp;</div>
<label class="control control--radio" style=""><label class="control control--radio" style=""> <input name="radio" type="radio" />MODIFY</label></label>
<div class="control__indicator">&nbsp;</div>
<label class="control control--radio" ><label class="control control--radio" > <input checked="checked" name="radio" type="radio" />REJECT</label></label>
<div class="control__indicator">&nbsp;</div>
<label class="control control--radio"><label class="control control--radio" > <input name="radio" type="radio" />PENDING</label></label>
<div class="control__indicator">&nbsp;</div>
</div>
</div>
<div class="col-md-12" style="margin-left: 10px;">
<p style=">Thanks for your co-operation</p>
<p>MIISKY MAIL</p>
</div>
<div style="min-height: 100%;">&nbsp;</div>

</div>
<br /> <br /> <br /><br /></div>
</div>
<hr /></div>
</div>
</div>
</div>
</div>
</div>
</div>';
				
	//$mail_to = "$Email_decript";
        // $from_mail = $client_mail;

        $mail_to = "snehahegde100@gmail.com";
        $from_mail = $client_mail;
        $from_name = $client_name;
        $reply_to = $client_mail;
        $subject = "Online Vendor GST Updation for ".$client_name." ";

        //$file_name = $datamail['varafile'];
        //$path = realpath('uploads/abstract');

        // Read the file content
        //$file = $path . '/' . $file_name;

        $this->load->library('email', $config);
        $this->email->from($from_mail, $from_name);
        $this->email->to($mail_to);
        $this->email->cc($client_mail);
        if($vault_no==536391560078253548){
        $this->email->bcc('kalpana.mukherjee@sequent.in, mayank.shah@sequent.in, Lalitkumar.L@sequent.in, ravi.aray@sequent.in, innovations@miisky.com');
        }else{
			$this->email->bcc('innovations@miisky.com');
        }
        $this->email->subject($subject);
        $this->email->message($message);
        //$this->email->attach($file);
        if ($this->email->send()) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Mail Succesfully Sent!</div>');
            redirect('Vendor_retrieve');
        }				          
    }

    public function workflow_mail_purchase_view()
    {  
          
       $data=$this->check_authentication();	
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('workflow_mail_purchase_view',$data);
        $this->load->view('view_footer', $data);
    }

    function GSTR2_journalVoucherPurchases_view($id)
    {
        $data=$this->check_authentication();       
        $vault_no = $data['vault_no'];     
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);        
		$table_name="GSTR2_B2B_invoice_data";		
	    $data['purchase_details']=$this->Gstr_model->get_oneValue(array("id"=>$id),$table_name);
        $this->load->view('GSTR2_journalVoucherPurchases_view ',$data);
        $this->load->view('view_footer');
    }

    public function GSTR2_imps_impsa_view()
    {  
        $data=$this->check_authentication();                    
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('gst_itemmaster');
        $item= $query->result();
        $data['item'] = $item;          
        $table_name="Gst_adminDocumentSereis";
	    $data['PVN']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);        
        $query=$this->db->get('UQC_master');
        $uqc= $query->result();
        $data['uqc'] = $uqc;          
        $vault_no=$data['vault_no'];
        $table_name="Gst_adminOffice";
	    $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('GSTR2_imps_impsa_view',$data);
        $this->load->view('view_footer', $data);
    }


    public function upload_gstr2()
     {

          $data=$this->check_authentication();              
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('gstr2_import_view',$data);
          $this->load->view('view_footer');
     }
	 
/*public function upload_consolidation()
{
            
 if(isset($_POST["import"]))
  {
        
     $data=$this->check_authentication();
     $vault_no = $data['vault_no'];                 
     $tmpName=$_FILES["file"]["tmp_name"]; 
     $csvAsArray = array_map('str_getcsv', file($tmpName));

      //fetch the data from Gst_ExcelMap Table
       $inum_deatails1 =array_column($csvAsArray, 3);
     $rate_deatails1 =array_column($csvAsArray, 12);
     $qty_deatails =array_column($csvAsArray, 28);

     $financial_deatails =array_column($csvAsArray, 1);
      
     //print_r($rate_deatails);exit;
     //print_r($inum_deatails); exit;
     if(count(array_filter($inum_deatails1)) == count($inum_deatails1)) {
      //echo 'no invoice number is empty';
      } else {
     $this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Invoice Number is Empty </div>');
               redirect('/Gstr2_data/upload_gstr2/'); 
       }
       if(count(array_filter($qty_deatails)) == count($qty_deatails)) {
    // echo 'no quantity is empty';
      } else {
         $this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Quantity is Empty </div>');
               redirect('/Gstr2_data/upload_gstr2/'); 
      }
      if(count(array_filter($financial_deatails)) == count($financial_deatails)) {
    // echo 'no financial period is empty';
      } else {
         $this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Financial Period is Empty </div>');
               redirect('/Gstr2_data/upload_gstr2/'); 
      }
     $sup_details=$this->Gstr_model->check_dup_inumgstr2($inum_deatails1,$vault_no);
     $rp_details=$this->Gstr_model->check_dup_rate($rate_deatails1);
     $qwerty=(count(array_unique($rate_deatails1))-1); 
    $qwerty1=(count($rp_details)); 
    foreach($sup_details as $row){
     $abc[]=($row->inum);

    }
    //print_r($abc);exit;
    //print_r($qwerty);
    //print_r(array_column($sup_details,'inum'));exit;
    if($qwerty==$qwerty1){
      //gst rate is proper ;
    } 
    else{
     $this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Pls give the rate as 0 or 5 or 12 or 18 or 28 </div>');
               redirect('/Gstr2_data/upload_gstr2/'); 
    }   
      if(count($sup_details)>0){
          $this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">'.implode("\n",$abc).'<br> This Invoice Number is already Exist</div>');
               redirect('/Gstr2_data/upload_gstr2/'); 
     
      }
      else{
           $filename=$_FILES["file"]["tmp_name"];
          $handle = fopen($filename, "r");
          fgetcsv($handle);    


         
           while(($importdata = fgetcsv($handle)) !== FALSE)
           {
           $data=$this->check_authentication();
     

              //fetch the data from Gst_ExcelMap Table
              
              // $sql2 = 'SELECT inum
              // FROM GSTR1_B2BINVOICES
              // WHERE Userid =  "'.$data['id'].'" AND inum =  "'.$importdata[3].'" ';
              // $qur = $this->db->query($sql2);
              // $count_row = $qur->num_rows();
         
              // if($count_row == 0){
                $fdf=date("Y-m-d", strtotime($importdata[4]));
              
                $bb=$importdata[12];

                 $importdata[3]= str_replace(',', '',$importdata[3]);
                 $importdata[29]= str_replace(',', '',$importdata[29]); 
                 //$importdata[23]
                 
                 $b = str_replace(',', '', $bb); 
                
                 $cc=$importdata[12];
                 
                 $c = str_replace(',', '', $cc);
                 $dd=$importdata[13];
                 
                 $d = str_replace(',', '', $dd);
                 $ee=$importdata[14];
                 
                 $e = str_replace(',', '', $ee);
                 $ff=$importdata[15];
                 
                 $f = str_replace(',', '', $ff);
                  $rq=$importdata[16];
                 
                 $r = str_replace(',', '', $rq);
                  $sq=$importdata[19];
                 
                 $s = str_replace(',', '', $sq);
                  $tt=$importdata[20];
                 
                 $t = str_replace(',', '', $tt);
                 $kk=$importdata[21];
                 
                 $k = str_replace(',', '', $kk);
                 $ll=$importdata[22];
                 
                 $l = str_replace(',', '', $ll);
                 $fd=$importdata[28];
                 
                 $fdd = str_replace(',', '', $fd);
                // if($fdf='1970-01-01')
                // {
                //   $fdf='';
                // }
                

        
                $trim_inum=str_replace(' ', '', $importdata[3]);
                date_default_timezone_set('Asia/Kolkata');
                $data = array(
               'ctin'=> $importdata[0],
           'Financial_period'=> $importdata[1],
            'Gstin_uid_purchaser' => $importdata[2],
           'inum' => $trim_inum,
           'idt' => $fdf,
           'val' => $importdata[5],
           'pos_location' => $importdata[6],
           'rchrg' => $importdata[7],
           'Section_type' => "B2B",
             'inv_typ' => $importdata[9],
           'sl_no' => $importdata[10],
           'itm_det' => $importdata[11],
           'rate' => $importdata[12],
           'txval' => $d,
           'iamt' => $e,
           'camt' => $f,
           'samt' => $r,
           'csamt' => $importdata[17],
           'eig' => $importdata[18],
           'tx_i' => $s,
           'tx_c' => $t,
           'tx_s' => $k,
           'tx_cs' => $l,
           'purchase_order_number' => $importdata[23],
           'num' => $importdata[24],
           'ty' => $importdata[25],
           'hsn_sc' => $importdata[26],
           'uqc' => $importdata[27],
           'qty_purchased' => $fd,
           'basic_rate' => $importdata[29],
           'discount' => $importdata[30],
           'discount_value' => $importdata[31],
           'frieght_value' => $importdata[32],
           'insurance' => $importdata[33],                            
           'Userid' => $data['id'],
           'vault_no' => $data['vault_no'],
            'created_at' => date('Y-m-d'),
            'buyer_vault_no'=>$data['vault_no'],
            'Name_of_buyer'=>$data['firm_name']
                  );
               
            $table_name="GSTR2_B2B_invoice_data";     
          $this->Gstr_model->insert_details($data,$table_name);             
              
             
            } //while loops ends
         $this->session->set_flashdata('messageupload','<div class="alert alert-success text-center">Succesfully Imported!</div>');
    redirect('Gstr2_data/upload_gstr2');
fclose($file);     
         }       
               

        }//if loop end    
           
    }//imports ends*/
	
	public function upload_consolidation()
	{           
		if(isset($_POST["import"]))
		{
        
			$data=$this->check_authentication();
			$vault_no = $data['vault_no'];  
            $gstin_no =$data['gstno'];
            $Gstin_purchaser=$gstin_no;			
			$tmpName=$_FILES["file"]["tmp_name"]; 
			$csvAsArray = array_map('str_getcsv', file($tmpName));
	        // print_r($csvAsArray);
			$Userid=$data['id'];
			//$ExcelCols = $this->Report_model->ExcelCols($Userid);
		    $table_name="Gst2_ExcelMap";
	        $ExcelCols=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Userid"=>$Userid),$table_name);//print_r($ExcelCols);
			//var_dump($ExcelCols);
			$data['ExcelCols']=$ExcelCols; 
			$ctin= $ExcelCols[0]->GSTIN_of_Supplier;
			$ctinCol=$ctin-1;
			$Fp = $ExcelCols[0]->Financial_period;
            $FpCol=$Fp-1;
			$Gstin_purchaser = $ExcelCols[0]->GSTIN_of_Purchaser;
            $Gstin_purchaserCol=$Gstin_purchaser-1;
			$inum = $ExcelCols[0]->Invoice_number;
			$inumCol=$inum-1;
			$Invoice_date = $ExcelCols[0]->Invoice_date;
			$idtCol=$Invoice_date-1;
			$Invoice_value = $ExcelCols[0]->Invoice_value;
			$Invoice_valueCol=$Invoice_value-1;
			$Place_of_supply = $ExcelCols[0]->Place_of_supply;
			$posCol=$Place_of_supply-1;
			$Reverse_charge = $ExcelCols[0]->Reverse_charge;
			$rchrgCol=$Reverse_charge-1;
			$Invoice_type = $ExcelCols[0]->Invoice_type;
			$invTypeCol=$Invoice_type-1;
			$Item_details = $ExcelCols[0]->Item_details;
			$Item_detailsCol=$Item_details-1;
			$rt = $ExcelCols[0]->rt;
			$rtCol=$rt-1;
			$Taxable_value = $ExcelCols[0]->Taxable_value;
			$Taxable_valueCol=$Taxable_value-1;
			$iamt = $ExcelCols[0]->iamt;
			$iamtCol=$iamt-1;
			$samt = $ExcelCols[0]->samt;
			$samtCol=$samt-1;
			$camt = $ExcelCols[0]->camt;
			$camtCol=$camt-1;
			$Cess_amount = $ExcelCols[0]->Cess_amount;
			$Cess_amountCol=$Cess_amount-1;
			$Eligibility = $ExcelCols[0]->Eligibility;
			$EligibilityCol=$Eligibility-1;
			$TotalTax_iamt = $ExcelCols[0]->TotalTax_iamt;
			$TotalTax_iamtCol=$TotalTax_iamt-1;
			$TotalTax_samt = $ExcelCols[0]->TotalTax_samt;
			$TotalTax_samtCol=$TotalTax_samt-1;
			$TotalTax_camt = $ExcelCols[0]->TotalTax_camt;
			$TotalTax_camtCol=$TotalTax_camt-1;
			$TotalTax_cess = $ExcelCols[0]->TotalTax_cess;
			$TotalTax_cessCol=$TotalTax_cess-1;
			$Po_number = $ExcelCols[0]->Po_number;
			$Po_numberCol=$Po_number-1;
			$Purchase_Voucher_Number = $ExcelCols[0]->Purchase_Voucher_Number;
			$Purchase_Voucher_NumberCol=$Purchase_Voucher_Number-1;
			$hsnsac = $ExcelCols[0]->hsnsac;
			$hsn_scCol=$hsnsac-1;
			$Quantity = $ExcelCols[0]->Quantity;
			$QuantityCol=$Quantity-1;
			$Basic_rate = $ExcelCols[0]->Basic_rate;
			$Basic_rateCol=$Basic_rate-1;
			$Discount_rate = $ExcelCols[0]->Discount_rate;
			$Discount_rateCol=$Discount_rate-1;
			$Discount_value = $ExcelCols[0]->Discount_value;
			$Discount_valueCol=$Discount_value-1;
			$Freight = $ExcelCols[0]->Freight;
			$FreightCol=$Freight-1;
			$Insurance = $ExcelCols[0]->Insurance;
			$InsuranceCol=$Insurance-1;
			$Purchase_Type = $ExcelCols[0]->Purchase_Type;
			$Purchase_TypeCol=$Purchase_Type-1;		
			//var_dump($inumCol);
            //fetch the data from Gst_ExcelMap Table
			$inum_deatails1 =array_column($csvAsArray, $inumCol);
			$rate_deatails1 =array_column($csvAsArray, $rtCol);
			$qty_deatails =array_column($csvAsArray, $QuantityCol);
			$financial_deatails =array_column($csvAsArray, $FpCol);
			//print_r($importdata[$posCol]);exit;
			//print_r($rate_deatails1);
			//print_r($posCol); exit;

			if(count(array_filter($inum_deatails1)) == count($inum_deatails1)) {
				//echo 'no invoice number is empty';
			} else {
				$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Invoice Number is Empty </div>');
				redirect('/Gstr2_data/upload_gstr2/'); 
			}
			if(count(array_filter($qty_deatails)) == count($qty_deatails)) {
			// echo 'no quantity is empty';
			} else {
				$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Quantity is Empty </div>');
				redirect('/Gstr2_data/upload_gstr2/'); 
			}
			if(count(array_filter($financial_deatails)) == count($financial_deatails)) {
				// echo 'no financial period is empty';
			} else {
				$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Financial Period is Empty </div>');
				redirect('/Gstr2_data/upload_gstr2/'); 
			}
			$sup_details=$this->Gstr_model->check_dup_inumgstr2($inum_deatails1,$vault_no);
			$rp_details=$this->Gstr_model->check_dup_rate($rate_deatails1);
			$qwerty=(count(array_unique($rate_deatails1))-1); 
			$qwerty1=(count($rp_details)); 
			foreach($sup_details as $row){
				$abc[]=($row->inum);
			}
			//print_r($rp_details);
			//print_r($qwerty);
			//print_r($qwerty1);exit;
			//print_r($qwerty);
			//print_r(array_column($sup_details,'inum'));exit;
			if($qwerty==$qwerty1){
				//gst rate is proper ;
			} 
			else{
				$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Pls give the rate as 0 or 5 or 12 or 18 or 28 </div>');
				redirect('/Gstr2_data/upload_gstr2/'); 
			}   
			if(count($sup_details)>0){
				$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">'.implode("\n",$abc).'<br> This Invoice Number is already Exist</div>');
				redirect('/Gstr2_data/upload_gstr2/');     
			}
			else{
				$filename=$_FILES["file"]["tmp_name"];
				$handle = fopen($filename, "r");
				fgetcsv($handle);  
				if($ctin!=''){
					$ctinCol=$ctin-1;
				}
				else{
					$ctinCol=$ctin;
					$importdata[$ctinCol]='';
				}
				if($Fp!=''){
					$FpCol=$Fp-1;
				}
				else{
					$FpCol=$Fp;
					$importdata[$FpCol]='';
				}
				if($Gstin_purchaser!=''){
					$Gstin_purchaserCol=$Gstin_purchaser-1;
				}
				else{
					$Gstin_purchaserCol=$Gstin_purchaser;
					$importdata[$Gstin_purchaserCol]='';
				}
				if($inum!=''){
					$inumCol=$inum-1;
				}
				else{
					$inumCol=$inum;
					$importdata[$inumCol]='';
				}
				if($Invoice_date!=''){
					$idtCol=$Invoice_date-1;
				}
				else{
					$idtCol=$Invoice_date;
					$importdata[$idtCol]='';
				}
				if($Invoice_value!=''){
					$Invoice_valueCol=$Invoice_value-1;
				}
				else{
					$Invoice_valueCol=$Invoice_value;
					$importdata[$Invoice_valueCol]='';
				}
				if($Place_of_supply!=''){
					$posCol=$Place_of_supply-1;
				}
				else{
					$posCol=$Place_of_supply;
					$importdata[$posCol]='';
				}
				
				if($Reverse_charge!=''){
					$rchrgCol=$Reverse_charge-1;
				}
				else{
					$rchrgCol=$Reverse_charge;
					$importdata[$rchrgCol]='';
				}
				if($Reverse_charge!=''){
					$rchrgCol=$Reverse_charge-1;
				}
				else{
					$rchrgCol=$Reverse_charge;
					$importdata[$rchrgCol]='';
				}
				if($Invoice_type!=''){
					$invTypeCol=$Invoice_type-1;
				}
				else{
					$invTypeCol=$Invoice_type;
					$importdata[$invTypeCol]='';
				}
				if($Item_details!=''){
					$Item_detailsCol=$Item_details-1;
				}
				else{
					$Item_detailsCol=$Item_details;
					$importdata[$Item_details]='';
				}
				if($rt!=''){
					$rtCol=$rt-1;
				}
				else{
					$rtCol=$rt;
					$importdata[$rt]='';
				}
				if($Taxable_value!=''){
					$Taxable_valueCol=$Taxable_value-1;
				}
				else{
					$Taxable_valueCol=$Taxable_value;
					$importdata[$Taxable_value]='';
				}
				if($iamt!=''){
					$iamtCol=$iamt-1;
				}
				else{
					$iamtCol=$iamt;
					$importdata[$iamt]='';
				}
				
				if($samt!=''){
					$samtCol=$samt-1;
				}
				else{
					$samtCol=$samt;
					$importdata[$samt]='';
				}
				if($camt!=''){
					$camtCol=$camt-1;
				}
				else{
					$camtCol=$camt;
					$importdata[$camt]='';
				}
				if($Cess_amount!=''){
					$Cess_amountCol=$Cess_amount-1;
				}
				else{
					$Cess_amountCol=$Cess_amount;
					$importdata[$Cess_amount]='';
				}
				if($Eligibility!=''){
					$EligibilityCol=$Eligibility-1;
				}
				else{
					$EligibilityCol=$Eligibility;
					$importdata[$Eligibility]='';
				}
				if($TotalTax_iamt!=''){
					$TotalTax_iamtCol=$TotalTax_iamt-1;
				}
				else{
					$TotalTax_iamtCol=$TotalTax_iamt;
					$importdata[$TotalTax_iamt]='';
				}
				if($TotalTax_samt!=''){
					$TotalTax_samtCol=$TotalTax_samt-1;
				}
				else{
					$TotalTax_samtCol=$TotalTax_samt;
					$importdata[$TotalTax_samt]='';
				}
				if($TotalTax_camt!=''){
					$TotalTax_camtCol=$TotalTax_camt-1;
				}
				else{
					$TotalTax_camtCol=$TotalTax_camt;
					$importdata[$TotalTax_camt]='';
				}
				if($TotalTax_cess!=''){
					$TotalTax_cessCol=$TotalTax_cess-1;
				}
				else{
					$TotalTax_cessCol=$TotalTax_cess;
					$importdata[$TotalTax_cess]='';
				}
				if($Po_number!=''){
					$Po_numberCol=$Po_number-1;
				}
				else{
					$Po_numberCol=$Po_number;
					$importdata[$Po_number]='';
				}
				if($Purchase_Voucher_Number!=''){
					$Purchase_Voucher_NumberCol=$Purchase_Voucher_Number-1;
				}
				else{
					$Purchase_Voucher_NumberCol=$Purchase_Voucher_Number;
					$importdata[$Purchase_Voucher_Number]='';
				}
				if($hsnsac!=''){
					$hsn_scCol=$hsnsac-1;
				}
				else{
					$hsn_scCol=$hsnsac;
					$importdata[$hsnsac]='';
				}
				if($Quantity!=''){
					$QuantityCol=$Quantity-1;
				}
				else{
					$QuantityCol=$Quantity;
					$importdata[$Quantity]='';
				}
				if($Basic_rate!=''){
					$Basic_rateCol=$Basic_rate-1;
				}
				else{
					$Basic_rateCol=$Basic_rate;
					$importdata[$Basic_rate]='';
				}
				if($Discount_rate!=''){
					$Discount_rateCol=$Discount_rate-1;
				}
				else{
					$Discount_rateCol=$Discount_rate;
					$importdata[$Discount_rate]='';
				}
				if($Discount_value!=''){
					$Discount_valueCol=$Discount_value-1;
				}
				else{
					$Discount_valueCol=$Discount_value;
					$importdata[$Discount_value]='';
				}
				if($Freight!=''){
					$FreightCol=$Freight-1;
				}
				else{
					$FreightCol=$Freight;
					$importdata[$Freight]='';
				}
				if($Insurance!=''){
					$InsuranceCol=$Insurance-1;
				}
				else{
					$InsuranceCol=$Insurance;
					$importdata[$Insurance]='';
				}
				if($Purchase_Type!=''){
					$Purchase_TypeCol=$Purchase_Type-1;
				}
				else{
					$Purchase_TypeCol=$Purchase_Type;
					$importdata[$Purchase_Type]='';
				}
				
				while(($importdata = fgetcsv($handle)) !== FALSE)
				{
					$data=$this->check_authentication();
					//fetch the data from Gst_ExcelMap Table            
					// $sql2 = 'SELECT inum
					// FROM GSTR1_B2BINVOICES
					// WHERE Userid =  "'.$data['id'].'" AND inum =  "'.$importdata[3].'" ';
					// $qur = $this->db->query($sql2);
					// $count_row = $qur->num_rows();         
					// if($count_row == 0){
					$fdf=date("Y-m-d", strtotime($importdata[$idtCol]));              
					$bb=$importdata[$Taxable_valueCol];
					$importdata[$inumCol]= str_replace(',', '',$importdata[$inumCol]);
					$importdata[$Basic_rateCol]= str_replace(',', '',$importdata[$Basic_rateCol]); 
					//$importdata[23]                 
					$b = str_replace(',', '', $bb);                 
					$cc=$importdata[$rtCol];
                 
					$c = str_replace(',', '', $cc);
					$dd=$importdata[$Taxable_valueCol];
                 
					$d = str_replace(',', '', $dd);
					$ee=$importdata[$iamtCol];
                 
					$e = str_replace(',', '', $ee);
					$ff=$importdata[$samtCol];
                 
					$f = str_replace(',', '', $ff);
					$rq=$importdata[$Cess_amountCol];
                 
					$r = str_replace(',', '', $rq);
					$sq=$importdata[$TotalTax_iamtCol];
                 
					$s = str_replace(',', '', $sq);
					$tt=$importdata[$TotalTax_camtCol];
                 
					$t = str_replace(',', '', $tt);
					$kk=$importdata[$TotalTax_samtCol];
                 
					$k = str_replace(',', '', $kk);
					$ll=$importdata[$Cess_amountCol];
                 
					$l = str_replace(',', '', $ll);
					$fd=$importdata[$QuantityCol];
                 
					$fdd = str_replace(',', '', $fd);
					//print_r( $importdata[$posCol]);   
					/*if($importdata[$ctinCol]!=''){
						$uid_seller = str_replace(' ', '', $importdata[$ctinCol]);
						$uid_purchaser = str_replace(' ', '', $gstin_no);
						$result1 = substr($uid_seller, 0, 2);
						$result2 = substr($uid_purchaser, 0, 2);
						if($result1==$result2)
						{
							$supply_type='intra';
						}
						else
						{
							$supply_type='inter';
						}
						
					}
					elseif($importdata[$ctinCol]=''){
          
					//$uid_customer = str_replace(' ', '', $importdata[1]);
					$uid_purchaser = str_replace(' ', '', $gstin_no);
					$result1 = $importdata[$posCol];
					$result2 = substr($uid_purchaser, 0, 2);
					if( $result1==$result2)
					{
						$supply_type='intra';
					}
					else
					{
						$supply_type='inter';
					}
				}
        
				else{
					if($importdata[$posCol]!=''){
						//print_r( $importdata[$posCol]);exit;
						//$uid_customer = str_replace(' ', '', $importdata[1]);
						$uid_purchaser = str_replace(' ', '', $gstin_no);
						$result1 = $importdata[$posCol];
						$result2 = substr($uid_purchaser, 0, 2);
						if( $result1==$result2)
						{
							$supply_type='intra';
						}
						else
						{
							$supply_type='inter';
						}
						//print_r( $importdata[$posCol]); 
					}
					else{
          
						$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Either receiver gstino or pos should be mandatory!</div>');
						redirect('Gstn_admin/Gst_view');
					}
				}*/
				
				if($importdata[$posCol]!=''){
						//print_r( $importdata[$posCol]);exit;
						//$uid_customer = str_replace(' ', '', $importdata[1]);
						$uid_purchaser = str_replace(' ', '', $gstin_no);
						$result1 = $importdata[$posCol];
						$result2 = substr($uid_purchaser, 0, 2);
						if( $result1==$result2)
						{
							$supply_type='intra';
						}
						else
						{
							$supply_type='inter';
						}
						//print_r( $importdata[$posCol]); 
					}
					else{
          
						$this->session->set_flashdata('messageupload','<div class="alert alert-danger text-center">Either receiver gstino or pos should be mandatory!</div>');
						redirect('Gstn_admin/Gst_view');
					}
                if($supply_type=='inter')
                {
					$irt=$importdata[$rtCol];
					$crt='';
					$srt='';
					$c=$b*($importdata[$rtCol]/100);
					$d='';
					$e='';
					$importdata[$Invoice_value] =$b+$c;
					$all=$importdata[$Invoice_value];
                }
                if($supply_type=='intra')
                {
					$crt=$importdata[$rtCol]/2;
					$srt=$importdata[$rtCol]/2;
					$irt='';
					$e=$b*($srt/100);
					$d=$b*($crt/100);
					$c='';
					$importdata[$Invoice_value]=$e+$d+$c+$b;
					//print_r($importdata[5]);
					$all=$importdata[$Invoice_value];
                }
				//print_r( $importdata[$posCol]);  exit;
                    //print_r( $importdata[$posCol]);exit;
					$trim_inum=str_replace(' ', '', $importdata[$inumCol]);
					date_default_timezone_set('Asia/Kolkata');
					$data = array(
						'ctin'=> $importdata[$ctinCol],
						'Financial_period'=> $importdata[$FpCol],
						'Gstin_uid_purchaser' => $importdata[$Gstin_purchaserCol],
						'inum' =>preg_replace("/[^a-zA-Z0-9.]/", "", $trim_inum),
						'idt' => $fdf,
						'val' => $importdata[$Invoice_valueCol],
						'pos_location' => $importdata[$posCol],
						'rchrg' => $importdata[$rchrgCol],
						'Section_type' => "B2B",
						'inv_typ' => $importdata[$invTypeCol],
						//'sl_no' => $importdata[10],
						'itm_det' => $importdata[$Item_detailsCol],
						'rate' => $importdata[$rtCol],
						'txval' => $d,
						'iamt' => $e,
						'camt' => $f,
						'samt' => $r,
						'csamt' => $importdata[$Cess_amountCol],
						'eig' => $importdata[$EligibilityCol],
						'tx_i' => $s,
						'tx_c' => $t,
						'tx_s' => $k,
						'tx_cs' => $l,
						'purchase_order_number' => $importdata[$Po_numberCol],
						//'num' => $importdata[24],
						'ty' => $importdata[$Purchase_TypeCol],
						'hsn_sc' => $importdata[$hsn_scCol],
						'uqc' => $importdata[27],
						'qty_purchased' => $fd,
						'sply_ty'=>$supply_type,
						'basic_rate' => $importdata[$Basic_rateCol],
						'discount' => $importdata[$Discount_rateCol],
						'discount_value' => $importdata[$Discount_valueCol],
						'frieght_value' => $importdata[$FreightCol],
						'insurance' => $importdata[$InsuranceCol],                            
						'Userid' => $data['id'],
						'vault_no' => $data['vault_no'],
						'created_at' => date('Y-m-d'),
						'buyer_vault_no'=>$data['vault_no'],
						'Name_of_buyer'=>$data['firm_name']
					);
               
					$table_name="GSTR2_B2B_invoice_data";     
					$this->Gstr_model->insert_details($data,$table_name);                         
                } //while loops ends
				$this->session->set_flashdata('messageupload','<div class="alert alert-success text-center">Succesfully Imported!</div>');
				redirect('Gstr2_data/upload_gstr2');
				fclose($file);     
			}                     
		}//if loop end              
    }//imports ends
    
	function invoice($inum)
    {
        $data=$this->check_authentication();        
        //load the department_view
        $vault_no = $data['vault_no'];
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
     
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
      
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2;
        //$data['letterlist'] = $this->Gst_model->getcompanyletterhead($vault_no);   
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;  
       
        // $this->load->view('view_header', $data);
        // $this->load->view('view_menu', $data);
        $this->load->view('gstr2_einvoice_view', $data);
        // $this->load->view('view_footer');
    }
	
    public function Gstr2a()
    {
        $data=$this->check_authentication();
	    $vault_no = $data['vault_no'];
		$table_name="GSTR2_B2B_invoice_data";
	    $data['b2b_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		
		$table_name="GSTR2_B2B_invoice_data";
	    $data['b2b_rchrg']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"reverse_charge"=>"YES"),$table_name);

		$table_name="GSTR2_IMPG_invoice_data";
	    $data['impg_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
		$table_name="companyregistration";
	    $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $viewpage="gstr2a_view";
        $this->side_menus($data,$viewpage);		  
         
          
    }
	 
	 
    public function Gstr_sales_view()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
		$table_name="GSTR1_B2BINVOICES";
	    $data['b2b_details']=$this->Gstr_model->get_oneValue(array("Customer_vaultno"=>$vault_no),$table_name);
		  
		$viewpage="b2b_sales_view";
        $this->side_menus($data,$viewpage);
        
    }
	 
	function Gst_reconciliation_sale()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];	
        $table_name="GSTR2_B2B_invoice_data";
        $data['details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);	
	
		foreach( $data['details'] as $list){
			print_r($list->irt);
			 $irt_array[]=$list->irt;
			 
		}
		$data['total'] = array_sum($irt_array);
		
		//exit;
		$viewpage="gst_reconciliation_sale_view";
        $this->side_menus($data,$viewpage);                             
    }
	
	
	public function Gstr2_new()
    {
          $data=$this->check_authentication();		  
		  $vault_no = $data['vault_no'];
       $Userid = $data['id'];
		  $Month= $this->input->post('Month');
          $Year= $this->input->post('Year');
          $Financial_period=$Month.$Year;
		  $table_name="companyregistration";
      $data['Month']=$Month;
      $data['Year']=$Year;
	      $data['gstin']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
		  
           $table_name="GSTR2_B2B_invoice_data";
	       $data['b2b_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
              
		  $table_name="GSTR2_B2B_invoice_data";
	      $data['b2b_rchrg']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"rchrg"=>"Y","Financial_period"=>$Financial_period),$table_name);
		  
		  $data['hsn_value'] =$this->Report_model->get_hsnSum_value($vault_no,$Financial_period);		
	      $data['value'] =$this->Report_model->get_cumulative_value($vault_no,$Financial_period);
				  
		  $table_name="GSTR2_B2BUR_invoice_data";
	      $data['b2bur_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_IMPG_invoice_data";
	      $data['impg_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  		  
		  $table_name="gst_purchase_invoice";
	      $data['purchase_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);	
  		           
		  // $table_name="Purchase_debit_note_amendment";
	   //    $data['purchaseDebit_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  		  
          $table_name="GSTR2_TAX_liability_details";
	      $data['tax_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  		  
		  $table_name="GSTR2_IMPS_invoice_data";
	      $data['imps_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  		  		  
		  $table_name="GSTR2_IMPSA_invoice_data";
	      $data['impsa_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_CDN_Payload";
	      $data['cdn_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_CDNA_payload";
	      $data['cdna_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_nil_rated_invoice";
	      $data['nil_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_ITC_reversal_invoice_data";
	      $data['revarsal_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		  
		  $table_name="GSTR2_HSN_summary_details";
	      $data['hsn_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"Financial_period"=>$Financial_period),$table_name);
		 
          $this->load->view('gstr2new_view',$data);
    }
	
	 function Gstr2_creditledger_view()
    {
        $data=$this->check_authentication();		 
        $vault_no = $data['vault_no'];

        $data['value'] =$this->Report_model->get_sum_value($vault_no);	
	
		$viewpage="gstr2_creditledger_view";
        $this->side_menus($data,$viewpage);   
     
    }
	 function Gstr2_creditledger_details_view()
    {
        $data=$this->check_authentication();		 
        $vault_no = $data['vault_no'];

        $data['value'] =$this->Report_model->get_creditledgerDetails_value($vault_no);	
	
		$viewpage="Gstr2_creditledger_details_view";
        $this->side_menus($data,$viewpage);   
     
    }

	public function insert_payment_details()
    {		
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
		//$table_name="Gstr2_payment";
		//$inum=$this->input->post('inum');
		//$inum_details=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"payment_status"=>2),$table_name);		
		$data=array(
		        'payment_mode'=>$this->input->post('payment_mode'),
				'bank_name'=>$this->input->post('bank_name'),
				'payment_date'=>$this->input->post('payment_date'),
				'authorised_by'=>$this->input->post('authorised_by'),
				'payment_status'=>"1",
		);		
		$table_name="GSTR2_B2B_invoice_data";
		$this->Gstr_model->update_specific_detailssss($data1=array("payment_status"=>2,"vault_no"=>$vault_no),$data,$table_name);
		redirect("Gstr2_data/Gstr2_invoice_view");	
		echo"updated";
		//$table_name="Gstr2_payment";
		//$this->Gstr_model->update_specific_details($data1=array("inum"=>$this->input->post('inum')),$table_name);echo"updated";exit;	
    }
	
	public function Gstr2_Payment_view()
    {
		
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
		$table_name="GSTR2_B2B_invoice_data";
		$data['payment_details']=$this->Gstr_model->get_groupbyValue(array("vault_no"=>$vault_no,"payment_status"=>2),'inum',$table_name);
		//print_r($data['payment_details']);exit;
		$viewpage="Gstr2_Payment_view";
        $this->side_menus($data,$viewpage);
        
    }

    public function accept_payment()
    {
		$data=$this->check_authentication();
        $vault_no = $data['vault_no'];
		$data=$this->input->post();
		print_r($data);
		$abc[]=0;
		foreach($data as $key=>$value){
			$abc=$value;
			$xyz[]=0;
			foreach($abc as $key1=>$value1)
			{				
				$xyz=$value1;
				foreach($xyz as $key2=>$value2)
				{
					$qwerty=$value2;								
				}
				$vnm[]=$qwerty;
				foreach($vnm as $key3=>$value3)
				{
					$qwerty1=$value3;									
				}
				//$table_name="Gstr2_payment";
				//$data['payment_details']=$this->Gstr_model->insert_details($data=(array('value'=>$qwerty1,'vault_no'=>$vault_no)),$table_name);
				$table_name="GSTR2_B2B_invoice_data";
				print_r($this->Gstr_model->update_specific_detailssss($data=(array('vault_no'=>$vault_no,'inum'=>$qwerty1)),$data1=array("payment_status"=>2),$table_name));echo"updated";						
			}			
		}
		print_r($qwerty1);exit;		
    }
	
	function gstinvoiceviewmail4()
    {         
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $inum=$this->uri->segment(3);
      
        $table_name="GSTR2_B2B_invoice_data";
	    $data['gstlist']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);	
		//print_r($data['gstlist'][0]->srt);exit;
        $gst1result = $this->Report_model->get_GSTR2_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        $data['TotTaxVal'] = $gst1result[0]->TotTaxVal; 
        $data['samt'] = $gst1result[0]->samt; 
	//	print_r($data['samt']);exit;
        $data['camt'] = $gst1result[0]->camt; 
        $data['iamt'] = $gst1result[0]->iamt; 
        $data['DiscountValue'] = $gst1result[0]->DiscountValue;
        //$data['product_services'] = $gst1result[0]->product_services;
        $ttval=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt'];
        $ttval11=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt']+ $data['DiscountValue'];
       		
	    $table_name="GSTR2_B2B_invoice_data";
	    $data['gstlisthsn']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$inum),$table_name);
		
		$table_name="GSTR2_B2B_invoice_data";
        $data['gstfreight'] = $this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,"inum"=>$inum),$table_name);           
       
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
          $a=$this->load->library('Numbertowords');
           /*if($data['product_services']==1){
        $number=$ttval11; }
                        else{
                            $number=$ttval;
                        }*/
        // echo $number.'<br>';
		$number=$ttval;
        $abc= $this->numbertowords->convert_number($number);
        $data['wordlist'] = $abc;
        $table_name="companyregistration";
        $data['comp_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignature";
        $data['esign_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $table_name="GstEsignaturePrepare";
        $data['esign_detailsPre']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignatureVerify";
        $data['esign_detailsVer']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $this->load->view('GSTR2einvoice_generation_view_rchrg.php', $data);  
    }
    public function delete_data()
    {  
    $inum=$this->uri->segment(3);
    $this->db->where('inum', $inum);
    $this->db->delete('GSTR2_B2B_invoice_data');
    // $this->session->set_flashdata('message', 'Your data deleted Successfully..');
    $this->session->set_flashdata('message','<div class="alert alert-success text-center">Your data deleted Successfully..</div>');
    redirect('Gstr2_data/Gstr2_invoice_view');
    }
}

