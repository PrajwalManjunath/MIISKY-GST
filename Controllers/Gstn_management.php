<?php
class Gstn_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','html'));
        $this->load->library('session');
        $this->load->database();
        $this->load->model('User_model');
        $this->load->model('Report_model');
        $this->load->model('Gst_model');
        $this->load->model('Gstr_model');
    }   
    
    function index($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $inum=$this->uri->segment(3);
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $sacresult = $this->Report_model->get_service_list();           
        $data['saclist'] = $sacresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult; 
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        //Will not work for excel uploads invoices
        // $gstresulths = $this->Report_model->get_gst_envoice_master($vault_no,$inum);           
        // $data['gstlist1'] = $gstresulths;

        $gstresulths = $this->Report_model->get_gst_dist_b2binv($vault_no,$inum);           
        $data['gstlist1'] = $gstresulths; 
            
        // $table_name="gst_envoice_master";
        // $id=$this->uri->segment(3);
        // $data['gstlist1']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);

        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_management_view', $data,$inum);
        $this->load->view('view_footer');
    }
    function indexser($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $inum=$this->uri->segment(3);
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $sacresult = $this->Report_model->get_service_list();           
        $data['saclist'] = $sacresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult; 
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        
        //will not work for excel uploads
        // $gstresulths = $this->Report_model->get_gst_envoice_master($vault_no,$inum);           
        // $data['gstlist1'] = $gstresulths;    

        $gstresulths = $this->Report_model->get_gst_dist_b2binv($vault_no,$inum);           
        $data['gstlist1'] = $gstresulths;  
        
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_management_services_view', $data,$inum);
        $this->load->view('view_footer');
    }

    function Journal()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $inum=$this->uri->segment(3);
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $inum=$this->uri->segment(3);
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no,$inum);         
        $data['gstlist'] = $gstresult; 
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstresulths = $this->Report_model->get_gst_envoice_master($vault_no,$inum);           
        $data['gstlist1'] = $gstresulths;     

        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_journal_view', $data);
        $this->load->view('view_footer');
    }

    function index2()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   

        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_management2_view', $data);
        $this->load->view('view_footer');
    }
    function index12($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);           
        $data['gst1list'] = $gst1result;  
        
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('invoice_edit_view', $data);
        $this->load->view('view_footer');
        
    }
    function amountupdate()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
         
        $id= $this->input->post('inum');
        $submitInvoice= $this->input->post('amt');

        $data = array(
            
                        'amt' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$id),$data,$table_name);

                            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Updated!</div>');
                            redirect('Gstn_management/invoice/'.$id);
        
    }
     function amount()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $custlist= $query->result();
        $data['gst1list'] = $custlist;
         
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gstinvoiceview2', $data);
        $this->load->view('view_footer');
        
        
    }
    function accept()
    {
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;
        $submitInvoice='A';

        $data = array(
                        'flag' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Invoice Succesfully Accepted!</div>');
        redirect('Gstn_management/gstinvoiceviewmail/'.$inum);
        
    }
    function accept3()
    {
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;

        $submitInvoice='A';

        $data = array(
                        'flag' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Invoice Succesfully Accepted!</div>');
        redirect('Gstn_management/gstinvoiceviewmail2/'.$inum);
        
    }
    function FinalView()
    {
        $inum=$this->uri->segment(3);
        $gstresult = $this->Report_model->get_gst_dist_b2binv1($inum);           
        $data['gstlist'] = $gstresult;
        $data['vault_no'] = $gstresult[0]->vault_no;
        $rchrg = $gstresult[0]->rchrg;
        $vault_no=$data['vault_no'];
        switch ($rchrg) {
            case 'Y':
                redirect('Gstn_management/gstinvoiceviewmail4/'.$inum);
                break;
            case 'N':
                redirect('Gstn_management/gstinvoiceviewmail2/'.$inum);
                break;
            default:
            redirect('Gstn_management/gstinvoiceviewmail2/'.$inum);
        }
        
        
    }

    function accept1()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
       
        $inum=$this->uri->segment(3);
        $submitInvoice='A';

        $data = array(
            
                        'flag' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Invoice Succesfully Accepted!</div>');
        redirect('Gstn_management/invoice/'.$inum);
        
    }
    function modify()
    {
        
        $inum=$this->input->post('inum');
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $data['gst1list'] = $cuslist;
        $vault_no=$cuslist[0]->vault_no;

        $submitInvoice='M';
        $reasons=$this->input->post('reasons');

        $data = array(
                        'reasons'=>$reasons,
                        'flag' =>$submitInvoice,
                    ); 

        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-warning text-center"> Modification request sent !</div>');
        redirect('Gstn_management/gstinvoiceviewmail/'.$inum);
        
    }
    function reject()
    {
        $inum=$this->input->post('inum');
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;

        $submitInvoice='R';
        $reasons=$this->input->post('reasons');

        $data = array(
                        'reasons'=>$reasons,
                        'flag' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Invoice Rejected !</div>');
        redirect('Gstn_management/gstinvoiceviewmail/'.$inum);
        
    }
    function pending()
    {
        $inum=$this->input->post('inum');
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;

        $submitInvoice='P';
        $reasons=$this->input->post('reasons');

        $data = array(
                        'reasons'=>$reasons,
                        'flag' =>$submitInvoice,
                    );  
        $table_name='GSTR1_B2BINVOICES';

        $this->Gstr_model->update_specific_details($data1=array('inum'=>$inum),$data,$table_name);

        $this->session->set_flashdata('msg','<div class="alert alert-warning text-center">Invoice is Under Pending</div>');
        redirect('Gstn_management/gstinvoiceviewmail/'.$inum);
        
    }
    function gstinvoiceviewmail()
    {         
        // $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        // $data['firm_name'] = $details[0]->firm_name;
        // $data['email'] = $details[0]->email;
        // $data['vault_no'] = $details[0]->vault_no;
        // $data['active'] = 'gst_news';
        // $data['mobile'] = $details[0]->mobile;
        // $vault_no=$data['vault_no'];

        $inum=$this->uri->segment(3);

        $gstresult = $this->Report_model->get_gst_dist_b2binv1($inum);           
        $data['gstlist'] = $gstresult;
        $data['vault_no'] = $gstresult[0]->vault_no;
        $vault_no=$data['vault_no'];

        // $this->db->where('inum', $inum);
        // $query=$this->db->get('GSTR1_B2BINVOICES');
        // $cuslist= $query->result();
        // $vault_no=$cuslist[0]->vault_no;
        
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
        $data['comp_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignature";
        $data['esign_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $table_name="GstEsignaturePrepare";
        $data['esign_detailsPre']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignatureVerify";
        $data['esign_detailsVer']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $this->load->view('einvoice_generation_view_mail', $data);  
    }
    function gstinvoiceviewmail2($number)
    {         
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];
        $inum=$this->uri->segment(3);
        // $this->db->where('inum', $inum);
        // $query=$this->db->get('gst_envoice_master');
        // $cuslist= $query->result();
        // $vault_no=$cuslist[0]->vault_no;
        
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;  
        $data['TotTaxVal'] = $gst1result[0]->TotTaxVal; 
        $data['samt'] = $gst1result[0]->samt; 
        $data['camt'] = $gst1result[0]->camt; 
        $data['iamt'] = $gst1result[0]->iamt; 
        $data['DiscountValue'] = $gst1result[0]->DiscountValue;
        $data['product_services'] = $gst1result[0]->product_services;
        $ttval=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt'];
        $ttval11=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt']+ $data['DiscountValue'];
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);   
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
          $a=$this->load->library('Numbertowords');
           if($data['product_services']==1){
        $number=$ttval11; }
                        else{
                            $number=$ttval;
                        }
        // echo $number.'<br>';
                        //print_r($number);
                        //exit();
        $abc= $this->numbertowords->convert_number(round($number));
        $data['wordlist'] = $abc;
        $data['comp_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignature";
        $data['esign_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $table_name="GstEsignaturePrepare";
        $data['esign_detailsPre']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignatureVerify";
        $data['esign_detailsVer']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $this->load->view('einvoice_generation_view_mail2', $data,$number);  
    }
    function gstinvoiceviewmail4()
    {         
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];
        $inum=$this->uri->segment(3);
        // $this->db->where('inum', $inum);
        // $query=$this->db->get('gst_envoice_master');
        // $cuslist= $query->result();
        // $vault_no=$cuslist[0]->vault_no;
        
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        $data['TotTaxVal'] = $gst1result[0]->TotTaxVal; 
        $data['samt'] = $gst1result[0]->samt; 
        $data['camt'] = $gst1result[0]->camt; 
        $data['iamt'] = $gst1result[0]->iamt; 
        $data['DiscountValue'] = $gst1result[0]->DiscountValue;
        $data['product_services'] = $gst1result[0]->product_services;
        $ttval=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt'];
        $ttval11=$data['TotTaxVal']+$data['samt']+ $data['camt']+ $data['iamt']+ $data['DiscountValue'];
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
          $a=$this->load->library('Numbertowords');
           if($data['product_services']==1){
        $number=$ttval11; }
                        else{
                            $number=$ttval;
                        }
        // echo $number.'<br>';
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
        $this->load->view('einvoice_generation_view_rchrg', $data);  
    }
    function gstinvoiceview()
    {         
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];
        $inum=$this->uri->segment(3);
        // $this->db->where('inum', $inum);
        // $query=$this->db->get('gst_envoice_master');
        // $cuslist= $query->result();
        // $vault_no=$cuslist[0]->vault_no;
        
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
        $data['comp_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignature";
        $data['esign_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $table_name="GstEsignaturePrepare";
        $data['esign_detailsPre']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignatureVerify";
        $data['esign_detailsVer']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name); 
        $this->load->view('einvoice_generation_view_mail', $data);  
    }
    function pdf()
    {         
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;
        
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;
        $table_name="companyregistration";
        $data['comp_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
        $table_name="GstEsignature";
        $data['esign_details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);  
        $this->load->view('einvpdf', $data);  
    }
    function index3($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);           
        $data['gst1list'] = $gst1result;    
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_management3_view', $data);
        $this->load->view('view_footer');
    }
    function index4()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];

        $table_name="GstCustomerMaster";
        $data['details']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,'GSTIN!='=>''),$table_name);
        $table_name="Gst_adminOffice";
        $data['details_seller']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no,'ChildGstinNo!='=>''),$table_name);

        $data['doclist']=$this->Report_model->getGst_adminDocumentSereis($vault_no);

        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  

        $data['sectiontype'] = $this->User_model->getsectionlist();

        // $table_name="gst_envoice_master";
        // $data['gstlist1']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
 
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_management_envoice_view', $data);
        $this->load->view('view_footer');
    }
     public function get_supinfo(){
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];
        //check if is an ajax request
        if($this->input->is_ajax_request()){
            //checks if the variable data exists on the posted data
            if($this->input->post('data')){
        $sup_code=$this->input->post('data');
        $table_name="GstCustomerMaster";
        $sup_details=$this->Gstr_model->get_oneValue(array("GSTIN"=>$sup_code,"vault_no"=>$vault_no),$table_name);                    
        $details=json_encode($sup_details);
                print_r($details);
            }
        }
    }
    public function get_sellerinfo(){
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $vault_no=$data['vault_no'];
        //check if is an ajax request
        if($this->input->is_ajax_request()){
            //checks if the variable data exists on the posted data
            if($this->input->post('data')){
       $sup_code=$this->input->post('data');
       $table_name="Gst_adminOffice";
       $sup_details=$this->Gstr_model->get_oneValue(array("ChildGstinNo"=>$sup_code,"vault_no"=>$vault_no),$table_name);                
                //query in your model you should verify if the data passed is legit before querying
                // $price = $this->your_model->get_price($this->input->post('data', TRUE));
        $details=json_encode($sup_details);
                    print_r($details);
                }
            }
        }
    function index5()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult; 

        $gstresult2 = $this->Report_model->get_GSTR1_B2BINVOICES_dist($vault_no);           
        $data['gstlist1'] = $gstresult2;   

        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_env_view', $data);
        $this->load->view('view_footer');
    }
     function einvoice_generation($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
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
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;  

        $this->load->view('einvoice_generation_view', $data);
     }
     
    function invoice_proforma()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   

        $table_name="gst_envoice_master";
        $data['gstlist1']=$this->Gstr_model->get_oneValue(array("vault_no"=>$vault_no),$table_name);
 
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('invoice_proforma_view', $data);
        $this->load->view('view_footer');
    }
    function updatesubmit()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
         
        $id= $this->input->post('inum');
        $submitInvoice= $this->input->post('submitInvoice');

        $data = array(
                        'submitInvoice' =>$submitInvoice,
                    );  
        $this->Gst_model->update_GSTR1_B2BINVOICES($id,$data);
                            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Updated!</div>');
                            redirect('Gstn_management/invoice/'.$inum);
       
        
    }
    function einvoice($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);           
        $data['gst1list'] = $gst1result;   
 
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_einvoice_view', $data,$inum);
        $this->load->view('view_footer');
    }
    function invoice($inum)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;  
        $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($vault_no,$inum);        
        $data['gst1list'] = $gst1result;   
        
        // $a=$this->load->library('Numbertowords');
        // $number=123456;
        // $abc= $this->numbertowords->convert_number($number);
        // return $abc;

        $gstresulthsn = $this->Report_model->get_GSTR1_B2BINVOICES_hsn($vault_no,$inum);           
        $data['gstlisthsn'] = $gstresulthsn;
        $gstfreight2 = $this->Report_model->get_freight($vault_no,$inum);           
        $data['gstfreight'] = $gstfreight2; 
        $gst3result = $this->Gst_model->getcompanyletterhead($vault_no);           
        $data['letterlist'] = $gst3result;   
        $number2=1234577;
        $data['amt']=$this->convert_number_to_words($number2);
        $this->load->view('gstinvoiceview', $data);
        redirect('Gstn_management/gstinvoiceviewmail2/'.$inum);
    }
    function convert_number_to_words($number2) {

        $a=$this->load->library('Numbertowords');
        $number=123456;
        // echo $number.'<br>';
        $abc= $this->numbertowords->convert_number($number2);
        // echo $abc;
        return $abc;
        // echo $abc;
        // var_dump($abc);
    }
    function invoice_update_view()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        // $query=$this->db->get('gst_envoice_master');
        // $custlist= $query->result();
        // $data['gst1list'] = $custlist;

        $gstresulths = $this->Report_model->get_gst_dist_b2binv($vault_no,$inum);           
        $data['gst1list'] = $gstresulths;  
  
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gstinvoiceupdateview', $data);
        $this->load->view('view_footer');
    }

    
    function Reconciliation()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));   
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;   
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_reconciliation_view', $data);
        $this->load->view('view_footer');
    }
   function Gst_reconciliation_sale()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;     
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_reconciliation_sale_view', $data);
        $this->load->view('view_footer');
    }
    function Gst_rules_sales()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
            
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;   
         
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_rules_sales_view', $data);
        $this->load->view('view_footer');
    }

    function Gst_format_sales()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;    
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_format_sales_view1', $data);
        $this->load->view('view_footer');
    }
     function Gst_taxregister_sales()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;   
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_taxregister_sales_view', $data);
        $this->load->view('view_footer');
    }
     function Gst_transition_management()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;  
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;  
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('transition_management_view', $data);
        $this->load->view('view_footer');
    }
    function insert_data()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['id'] = $details[0]->id;
        $Userid=$data['id'];
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $SellerState = $this->input->post('SellerState');
        $state = $this->input->post('state');
        $inum = $this->input->post('inum');
        $gstrate = $this->input->post('gstrate');
        
        /**getting form values**/
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Userid"=>$Userid,"Created_at"=>$dt,"inum"=>$inum);
        $data2=array_merge($input_data,$array2);
        $table_name="GSTR1_B2BINVOICES";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
            redirect('Gstn_management/index/'.$inum, 'refresh');
        }        
    }
    function insert_data1()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['id'] = $details[0]->id;
        $Userid=$data['id'];
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        
        $product_services = $this->input->post('product_services');

        if($product_services==1)
        {
            // var_dump($inum);
            /**getting form values**/
            $SellerState = $this->input->post('SellerState');
            $state = $this->input->post('state');
            $gstrate = $this->input->post('gstrate');
            $inum = $this->input->post('inum');
            $Name_of_receiver = $this->input->post('Name_of_receiver');
            $FinancialMonth = $this->input->post('FinancialMonth');
            $FinancialYear = $this->input->post('FinancialYear');
            $Financial_period=$FinancialMonth.$FinancialYear;
            $Gstr_tableref = $this->input->post('Gstr_tableref');

            $this->db->where('Gstr_tableref', $Gstr_tableref);
            $query=$this->db->get('Gstr1_sectiontypemaster');
            $cuslist= $query->result();
            $Section_type=$cuslist[0]->Section_type;
            $desc=$cuslist[0]->descp;


            $input_data=$this->input->post();
            $array2=array("vault_no"=>$vault_no,"Userid"=>$Userid,"Created_at"=>$dt,"inum"=>$inum,"Section_type"=>$Section_type,"Financial_period"=>$Financial_period);
            $data2=array_merge($input_data,$array2);
            $table_name="GSTR1_B2BINVOICES";
            $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
            // var_dump($input_data);
            if ($successinsert) {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                    redirect('Gstn_management/index/'.$inum, 'refresh');
            }
        }
        else{
            // var_dump($inum);
            /**getting form values**/
            $SellerState = $this->input->post('SellerState');
            $state = $this->input->post('state');
            $gstrate = $this->input->post('gstrate');
            $inum = $this->input->post('inum');
            $Name_of_receiver = $this->input->post('Name_of_receiver');
            $FinancialMonth = $this->input->post('FinancialMonth');
            $FinancialYear = $this->input->post('FinancialYear');
            $Financial_period=$FinancialMonth.$FinancialYear;
            $Gstr_tableref = $this->input->post('Gstr_tableref');
            $this->db->where('Gstr_tableref', $Gstr_tableref);
            $query=$this->db->get('Gstr1_sectiontypemaster');
            $cuslist= $query->result();
            $Section_type=$cuslist[0]->Section_type;
            $desc=$cuslist[0]->descp;

            $input_data=$this->input->post();
            $array2=array("vault_no"=>$vault_no,"Userid"=>$Userid,"Created_at"=>$dt,"inum"=>$inum,"Section_type"=>$Section_type,"Financial_period"=>$Financial_period);
            $data2=array_merge($input_data,$array2);
            $table_name="GSTR1_B2BINVOICES";
            $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
            // var_dump($input_data);
            if ($successinsert) {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/indexser/'.$inum, 'refresh');
            }
        }
    }
    function updatefreight()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        
        $inum = $this->input->post('inum');
        $Freight = $this->input->post('Freight');
        $Insurance = $this->input->post('Insurance');
        $othr_chrg = $this->input->post('othr_chrg');
        /**getting form values**/
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt,"inum"=>$inum,"Freight"=>$Freight,"Insurance"=>$Insurance,"othr_chrg"=>$othr_chrg);
        $data2=array_merge($input_data,$array2);

        $table_name="GSTR1_B2BINVOICES";
        $data=array('inum'=>$inum,"vault_no"=>$vault_no);//checks the given condition
        $data1=$data2;
        $this->Gstr_model->update_specific_details($data,$data1,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Freight, Insurance and Other charges Updated!</div>');
        redirect('Gstn_management/index3/'.$inum, 'refresh');
    }

    function update_data()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $inum = $this->input->post('inum');
        /**getting form values**/
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt,"inum"=>$inum);
        
        $data2=array_merge($input_data,$array2);
        $successupdate=$this->Report_model->update_GSTR1_B2BINVOICES($inum,$data2);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
        redirect('Gstn_management/invoice'.$inum, 'refresh');
    }
    function hsn_update_data()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $id = $this->input->post('id');
        $inum = $this->input->post('inum');
        /**getting form values**/
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt,"id"=>$id,"inum"=>$inum);
        $data2=array_merge($input_data,$array2);

        $table_name="GSTR1_B2BINVOICES";
        $data=array('id'=>$id);
        $data1=$data2;
        $this->Gstr_model->update_specific_details($data,$data1,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">HSN ItemSuccesfully Updated!</div>');
            redirect('Gstn_management/index/'.$inum, 'refresh');
    }
    function invoice_update_data()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $id = $this->input->post('id');
        $inum = $this->input->post('inum');
        /**getting form values**/
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt,"id"=>$id,"inum"=>$inum);
        $data2=array_merge($input_data,$array2);

        $table_name="gst_envoice_master";
        $data=array('id'=>$id);
        $data1=$data2;
        $this->Gstr_model->update_specific_details($data,$data1,$table_name);
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Invoice Data Updated Succesfully!</div>');
        redirect('Gstn_management/invoice_update_view/'.$inum, 'refresh');
    }
    
    function hsn_update_view()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id')); 
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;

        $data['vault_no'] = $details[0]->vault_no;
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['Unit_quantity_code'] = $this->User_model->getuqclist();
        $vault_no = $data['vault_no'];
        $this->db->where('vault_no', $vault_no);
        $query=$this->db->get('companyregistration');
        $client_doc= $query->result();
        $data['client_doc'] = $client_doc;
        $catresult = $this->Report_model->get_product_list();           
        $data['catlist'] = $catresult;
        $gstresult = $this->Report_model->get_GSTR1_B2BINVOICES($vault_no);           
        $data['gstlist'] = $gstresult;   
        $id=$this->uri->segment(3);
        $this->db->where('id', $id);
        $query=$this->db->get('GSTR1_B2BINVOICES');
        $custlist= $query->result();
        $data['gst1list'] = $custlist;
        $this->load->view('view_header', $data);
        $this->load->view('view_menu', $data);
        $this->load->view('gst_hsn_update_view', $data);
        $this->load->view('view_footer');
    }
     
     public function delete_data()
    {  
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $this->db->delete('gst_envoice_master');

        $this->db->where('inum', $inum);
        $this->db->delete('GSTR1_B2BINVOICES');
        $this->session->set_flashdata('message','<div class="alert alert-success text-center">Your data deleted Successfully..</div>');
        redirect('Gstn_management/index5');
    }
    function logout()
    {
             $user_data = $this->User_model->get_user_by_id($this->session->userdata('id'));
             foreach ($user_data as $key => $value) {
                      if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                               $this->session->unset_userdata($key);
                      }
             }
             $this->session->sess_destroy();
             redirect('Welcome', 'refresh');
    }
function insert_data2()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $ser_num = $this->input->post('ser_num');
        $date_issue = $this->input->post('date_issue');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');
        $name_rx = $this->input->post('name_rx');
        $add_rx = $this->input->post('add_rx');
        $gstin_rx = $this->input->post('gstin_rx');
        $state_rx = $this->input->post('state_rx');
        $statecode_rx = $this->input->post('statecode_rx');
        $name_csgn = $this->input->post('name_csgn');
        $add_csgn = $this->input->post('add_csgn');
        $gstin_csgn = $this->input->post('gstin_csgn');
        $state_csgn = $this->input->post('state_csgn');
        $statecode_csgn = $this->input->post('statecode_csgn');

        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_supplybill";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
    function check_type()
    {
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;
        $this->load->view('checkinvoiceview');
    }
    function check_type2()
    {
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;
        $this->load->view('checkinvoiceview2');
    }
    function check_type3()
    {
        $inum=$this->uri->segment(3);
        $this->db->where('inum', $inum);
        $query=$this->db->get('gst_envoice_master');
        $cuslist= $query->result();
        $vault_no=$cuslist[0]->vault_no;
        $this->load->view('checkinvoiceview3');
    }
    function insert_data3()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $ser_num = $this->input->post('ser_num');
        $date_issue = $this->input->post('date_issue');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');
        $name_rx = $this->input->post('name_rx');
        $add_rx = $this->input->post('add_rx');
        $gstin_rx = $this->input->post('gstin_rx');
        $state_rx = $this->input->post('state_rx');
        $statecode_rx = $this->input->post('statecode_rx');
        $name_csgn = $this->input->post('name_csgn');
        $add_csgn = $this->input->post('add_csgn');
        $gstin_csgn = $this->input->post('gstin_csgn');
        $state_csgn = $this->input->post('state_csgn');
        $statecode_csgn = $this->input->post('statecode_csgn');

        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_receiptVoucher";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
    function insert_data7()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $docno = $this->input->post('docno');
        $doi = $this->input->post('doi');
        $agnt_inv = $this->input->post('agnt_inv');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');
        $doi_billspp = $this->input->post('doi_billspp');

        $name_rx = $this->input->post('name_rx');
        $add_rx = $this->input->post('add_rx');
        $gstin_rx = $this->input->post('gstin_rx');
        $state_rx = $this->input->post('state_rx');
        $statecd_rx = $this->input->post('statecd_rx');
        
        $name_csg = $this->input->post('name_csg');
        $add_csg = $this->input->post('add_csg');
        $gstin_csg = $this->input->post('gstin_csg');
        $state_csg = $this->input->post('state_csg');
        $statecode_csg = $this->input->post('statecode_csg');

        /**getting form values**/ 
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_creditnote";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
     function insert_data4()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $name = $this->input->post('name');
        $add = $this->input->post('add');
        $gstin = $this->input->post('gstin');
        $vch_num = $this->input->post('vch_num');
        $vch_date = $this->input->post('vch_date');
        $pos = $this->input->post('pos');
        $state_rx = $this->input->post('state_rx');
        $statecd_rx = $this->input->post('statecd_rx');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');

        $ttl_amt_bftx = $this->input->post('ttl_amt_bftx');
        $add_cgst = $this->input->post('add_cgst');
        $add_sgst = $this->input->post('add_sgst');
        $add_igst = $this->input->post('add_igst');
        $tax_gst = $this->input->post('tax_gst');
        $ttl_amt_aftr_tx = $this->input->post('ttl_amt_aftr_tx');
        /**getting form values**/ 
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_paymentVoucher";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        // var_dump($input_data);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
    function insert_data5()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $name = $this->input->post('name');
        $add = $this->input->post('add');
        $gstin = $this->input->post('gstin');
        $vch_num = $this->input->post('vch_num');
        $vch_date = $this->input->post('vch_date');
        $pos = $this->input->post('pos');
        $state_rx = $this->input->post('state_rx');
        $statecd_rx = $this->input->post('statecd_rx');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');

        $ttl_amt_bftx = $this->input->post('ttl_amt_bftx');
        $add_cgst = $this->input->post('add_cgst');
        $add_sgst = $this->input->post('add_sgst');
        $add_igst = $this->input->post('add_igst');
        $tax_gst = $this->input->post('tax_gst');
        $ttl_amt_aftr_tx = $this->input->post('ttl_amt_aftr_tx');
  

        // var_dump($inum);
        /**getting form values**/ 
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_refundVoucher";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
    function insert_data6()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));  
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['active'] = 'gst_news';
        $data['mobile'] = $details[0]->mobile;
        $data['vault_no'] = $details[0]->vault_no;
        $vault_no = $data['vault_no'];  
        $dt=date("Y-m-d H:i:s");
        $docno = $this->input->post('docno');
        $doi = $this->input->post('doi');
        $agnt_inv = $this->input->post('agnt_inv');
        $state = $this->input->post('state');
        $state_code = $this->input->post('state_code');
        $doi_billspp = $this->input->post('doi_billspp');

        $name_rx = $this->input->post('name_rx');
        $add_rx = $this->input->post('add_rx');
        $gstin_rx = $this->input->post('gstin_rx');
        $state_rx = $this->input->post('state_rx');
        $statecd_rx = $this->input->post('statecd_rx');
        
        $name_csg = $this->input->post('name_csg');
        $add_csg = $this->input->post('add_csg');
        $gstin_csg = $this->input->post('gstin_csg');
        $state_csg = $this->input->post('state_csg');
        $statecode_csg = $this->input->post('statecode_csg');
  
        /**getting form values**/ 
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="gst_debitnote";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
                redirect('Gstn_management/index4');
        }
    }
public function expdata()
     {
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['firm_name'] = $details[0]->firm_name;
          $data['email'] = $details[0]->email;
          $data['vault_no'] = $details[0]->vault_no;
          $data['mobile'] = $details[0]->mobile;
         
          //load the department_model
          $this->load->model('Gstr');  
          //call the model function to get the department data
          $cusresult = $this->Gstr->get_invoice_list();           
          $data['cuslist'] = $cusresult;
          //load the department_view
          $this->load->view('view_header', $data);
          $this->load->view('view_menu', $data);
          $this->load->view('expdata_view',$data);
          $this->load->view('view_footer');
     }
       public function gstcustomerinv($inum,$vault_no)
     {
          $ctin=$this->uri->segment(3);
          $Userid=$this->uri->segment(4);
          $FP=$this->uri->segment(5);

          $gst1result = $this->Report_model->get_GSTR1_B2BINVOICES_SUM($inum,$vault_no);        
          $data['gst1list'] = $gst1result;
          
          $cusresult = $this->Report_model->get_cust_invoice_list($ctin,$Userid,$FP);           
          $data['cuslist'] = $cusresult;
          
          $this->load->view('CustEmailView',$data);
     }
}
