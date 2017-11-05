<?php
class Gstn_masters extends CI_Controller
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
        $this->load->model('Gstr');
        $this->load->model('Validation_model');   
        
    }   
    
     public function check_authentication()
    {            
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $data['vault_no'] = $details[0]->vault_no;
        $data['mobile'] = $details[0]->mobile;
        $data['id'] = $details[0]->id;    
        return $data;  
    }

    public function side_menus($data,$viewpage)
    {            
        $this->load->view('view_header', $data);
        $this->load->view('view_menu');
        $this->load->view($viewpage,$data);
        $this->load->view('view_footer');    
        //return $data;  
    }

 	function index(){
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
 		$data=$this->check_authentication();
        $vault_no=$data['vault_no'];
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['id'] = $details[0]->id;
        $Userid=$data['id'];

        $viewpage="gstn_MasterView";
        $this->side_menus($data,$viewpage);
 	}
     function insert_data()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data=$this->check_authentication();
        $vault_no=$data['vault_no'];
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['id'] = $details[0]->id;
        $Userid=$data['id'];
        $dt=date("Y-m-d H:i:s");
        $CustomerName = $this->input->post('CustomerName');
        $CustomerCode = $this->input->post('CustomerCode');
        $DivisionCode = $this->input->post('DivisionCode');
        $DivisionName = $this->input->post('DivisionName');
        $Address = $this->input->post('Address');
        $City = $this->input->post('City');
        $StateName = $this->input->post('StateName');
        $ContactPersonName = $this->input->post('ContactPersonName');
        $ContactNo = $this->input->post('ContactNo');
        $Pin = $this->input->post('Pin');
        $GSTIN = $this->input->post('GSTIN');
        
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Userid"=>$Userid,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="GstCustomerMaster";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
            redirect('Gstn_masters/index/', 'refresh');
        }        
    }
    function insert_data1()
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data=$this->check_authentication();
        $vault_no=$data['vault_no'];
        $data['Statelist'] = $this->User_model->getstatelist();
        $data['id'] = $details[0]->id;
        $Userid=$data['id'];
        $dt=date("Y-m-d H:i:s");
        $VendorName = $this->input->post('VendorName');
        $VendorCode = $this->input->post('VendorCode');
        $DivisionCode = $this->input->post('DivisionCode');
        $DivisionName = $this->input->post('DivisionName');
        $Address = $this->input->post('Address');
        $City = $this->input->post('City');
        $StateName = $this->input->post('StateName');
        $ContactPersonName = $this->input->post('ContactPersonName');
        $ContactNo = $this->input->post('ContactNo');
        $Pin = $this->input->post('Pin');
        $GSTIN = $this->input->post('GSTIN');
        
        $input_data=$this->input->post();
        $array2=array("vault_no"=>$vault_no,"Userid"=>$Userid,"Created_at"=>$dt);
        $data2=array_merge($input_data,$array2);
        $table_name="GstVendorMaster";
        $successinsert=$this->Gstr_model->insert_details($data2,$table_name);
        if ($successinsert) {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Succesfully Added!</div>');
            redirect('Gstn_masters/index/', 'refresh');
        }        
    }
 }	
	