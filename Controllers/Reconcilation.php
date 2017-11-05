<?php
class Reconcilation extends CI_Controller
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

    function index()
    {
        $data=$this->check_authentication();
        $vault_no=$data['vault_no'];

        $viewpage="ReconcilationExcel_view";
        $this->side_menus($data,$viewpage);
    }

    function Reconcilation_Json()
    {
        $data=$this->check_authentication();
        $vault_no=$data['vault_no'];

        $viewpage="Reconcilation_Json_view";
        $this->side_menus($data,$viewpage);
    }
    function import()
    {

        $data=$this->check_authentication();
        $vault_no=$data['vault_no'];
        $url="http://miisky.com/ci/application/views/m.json";
        
        $filename=$_FILES["file"]["tmp_name"];
        $data = json_decode(file_get_contents($filename), true);
        // var_dump($data);
        

        $std_id = $data['gstin'];
        $std_id2 = $data['fp'];
        var_dump($std_id);
        var_dump($std_id2);
        // $myJSON = json_encode($data);
        // $ctin = $data['ctin'];
        // var_dump($myJSON);
      
    }
    public function importgstr2a(){
 if(isset($_POST["import"]))
  {
      //$filename=$_FILES["file"]["tmp_name"];
      //if($_FILES["file"]["size"] > 0)
        //{
          $file=$_FILES["file"]["tmp_name"];
          $handle = fopen($file, "r");
          fgetcsv($handle);
           while (($importdata = fgetcsv($handle)) !== FALSE)
           {
         $data=$this->check_authentication();
     $vault_no = $data['vault_no'];
     $Userid = $data['id'];
   $fdf=date("Y-m-d", strtotime($importdata[9]));
     $cc=$importdata[5];
                 
                 $c = str_replace(',', '', $cc);
                 $bb=$importdata[1];
                 
                 $b = str_replace(',', '', $bb);
         $inum = preg_replace("/[^a-zA-Z0-9.]/", "", $importdata[11]);
          date_default_timezone_set('Asia/Kolkata');
                  $data = array(
                     'ctin' => $importdata[0],
                      'txval' => $b,
                      'iamt' => $importdata[2],
                      'samt' => $importdata[3], 
                      'camt' =>$importdata[4],
                      'val' =>$c,
                      'flag' =>$importdata[6],
                      'inv_typ' =>$importdata[7],
                      'pos_location' =>$importdata[8],
                      'idt' =>$fdf,
                      'rchrg' =>$importdata[10],
                      'rate' =>$importdata[12],
                      'irt' =>$importdata[13],
                      'srt' =>$importdata[14],
                      'crt' =>$importdata[15],
                      'Financial_period' =>$importdata[16],
                      'inum' =>$inum,
                      'vendor_code' =>$importdata[17],
                      
                      'Userid' => $Userid,
                      'vault_no' => $vault_no,
                      'created_at' => date('Y-m-d H:i:s'),
                      );
           
           //$this->Gstr->insertgstr2aimport($data);
           $this->Gstr->insertgstr2import($data);

              
           }
 
     
$this->session->set_flashdata('messageupload','<div class="alert alert-success text-center">Succesfully Imported!</div>');
redirect('Reconcilation');
 fclose($file);
}
//  else{
// $this->session->set_flashdata('messageupload','<div class="alert alert-warning text-center">Oops Invoice Number is already exist!</div>');
// redirect('Register_invoice_document');
//     }
  }
    function Reconcile()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];

        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile($Userid);           
        $data['gstlist1'] = $gstresult2;
        
        $viewpage="Reconcile_view";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileView()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $Financial_period=$Month.$Year;
        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile_fp($Userid,$Financial_period);           
        $data['gstlist1'] = $gstresult2;
        
        $viewpage="Reconcile_view1";
        $this->side_menus($data,$viewpage);
    }
    function Reconcile2aView()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $Financial_period=$Month.$Year;
        $gstresult2 = $this->Report_model->get_GSTR1_B2BINVOICES_Reconcile_gstr2aFP($Userid,$Financial_period);           
        $data['gstlist1'] = $gstresult2;
        
        $viewpage="Reconcile2a_view";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2a()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];

        $gstresult2 = $this->Report_model->get_GSTR1_B2BINVOICES_Reconcile_gstr2a($Userid);           
        $data['gstlist1'] = $gstresult2;

        $viewpage="Reconcile_viewgstr2a";
        $this->side_menus($data,$viewpage);
    }
    
      function ReconcileGstr2amatched()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];

        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile1($Userid);           
        $data['gstlist1'] = $gstresult2;

        $viewpage="reconciledgstr2_matched_view";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2amatchedFp()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $ctin= $this->input->post('ctin');
        $Financial_period=$Month.$Year;
        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_ReconcileFP($Userid,$Financial_period,$ctin);           
        $data['gstlist1'] = $gstresult2;

        $viewpage="reconciledgstr2_matched_view1";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2Summary()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];

        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile_Summary($Userid);           
        $data['gst2list'] = $gstresult2;

        $gst2aresult = $this->Report_model->get_GSTR2A_B2BINVOICES_Reconcile_Summary($Userid);           
        $data['gst2alist'] = $gst2aresult;

        $viewpage="reconciledgstr2_summary";
        $this->side_menus($data,$viewpage);
    }
    function Reconcilematchedwithdiffer()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];

       
        $viewpage="reconcile_matchedwithdiffer_view";
        $this->side_menus($data,$viewpage);
    }
    function ReconcilematchedwithdifferFP()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $ctin= $this->input->post('ctin');
        $Financial_period=$Month.$Year;
        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile_matched_withdiffP($Userid,$Financial_period,$ctin);           
        $data['gstlist1'] = $gstresult2;

        $viewpage="reconcile_matchedwithdiffer_view1";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2unmatched()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];



        $viewpage="reconciledgstr2_unmatched";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2unmatchedfp()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $ctin= $this->input->post('ctin');
        $Financial_period=$Month.$Year;        
        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile_unmtachedfp($Userid,$Financial_period,$ctin);           
        $data['gstlist1'] = $gstresult2;
 
        $viewpage="reconciledgstr2_unmatched1";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2aunmatched()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];


        $viewpage="reconciledgstr2a_unmatched";
        $this->side_menus($data,$viewpage);
    }
    function ReconcileGstr2aunmatchedFp()
    {
        $data=$this->check_authentication();
        $vault_no = $data['vault_no'];
        $Userid = $data['id'];
        $Month= $this->input->post('Month');
        $Year= $this->input->post('Year');
        $ctin= $this->input->post('ctin');
        $Financial_period=$Month.$Year;
        $gstresult2 = $this->Report_model->get_GSTR2_B2BINVOICES_Reconcile_unmtached_2afp($Userid,$Financial_period,$ctin);           
        $data['gstlist1'] = $gstresult2;
        

        $viewpage="reconciledgstr2a_unmatched1";
        $this->side_menus($data,$viewpage);
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
}