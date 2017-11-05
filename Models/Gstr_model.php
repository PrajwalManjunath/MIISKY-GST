<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gstr_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

function get_gstr1b2bdata_list($vault_no)
    {

        $query = $this->db->query('SELECT * FROM GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" ');


        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
	

    function get_check_exists($gstr_id)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $vault_no= $details[0]->vault_no;  
        $query = $this->db->query('SELECT * FROM GSTR2_B2B_invoice_data where vault_no="'.$vault_no.'" AND gstr1_id="'.$gstr_id.'" ');


        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
    
    function get_b2ba_check_exists($gstr_id)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $vault_no= $details[0]->vault_no;  
        $query = $this->db->query('SELECT * FROM GSTR2_B2BA_invoices where vault_no="'.$vault_no.'" AND gstr1_id="'.$gstr_id.'" ');


        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
	function insert_gstr2_b2b_data($data)
    {
		return $this->db->insert('GSTR2_B2B_invoice_data', $data);
    }

    function update_gstr2_b2b_data($data,$gstr1_id){
		$this->db->where('gstr1_id', $gstr1_id);  
		$this->db->update('GSTR2_B2B_invoice_data', $data);
    } 
    
    function insert_details($data,$table_name)
    {
		 $this->db->insert($table_name, $data);
                 return $this->db->insert_id();
    }
    function insert_receiptvch($data,$table_name)
    {
         $this->db->insert($table_name, $data);
                 return $this->db->insert_id();
    }
    function insert_paymentvch($data,$table_name)
    {
         $this->db->insert($table_name, $data);
                 return $this->db->insert_id();
    }
 function insert_spplybill($data,$table_name)
    {
         $this->db->insert($table_name, $data);
                 return $this->db->insert_id();
    }
    function update_details($data,$data1=array(),$table_name){
		foreach($data1 as $key=>$value){
			$this->db->where($key, $value);  
		    $this->db->update($table_name, $data);
		}
    }

    //to select single value from table
    function get_oneValue($data1=array(),$table_name)
    {
        if($data1!=""){
	 foreach($data1 as $key=>$value){	 
		 $this->db->where($key, $value);}}
                 $query=$this->db->get($table_name);
                 $result= $query->result();       
        
        return $result;
    } 
    //to set/update the perticular columns
    function update_specific_details($data,$data1,$table_name){
	foreach($data as $key=>$value){		
	     foreach($data1 as $key1=>$value1){
		$this->db->set($key1, $value1);
		$this->db->where($key, $value);
		$result=$this->db->update($table_name);
	     }
	}
    }
    function get_invoicecheck_exists($id)
    {
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
        $data['firm_name'] = $details[0]->firm_name;
        $data['email'] = $details[0]->email;
        $vault_no= $details[0]->vault_no;  
        $query = $this->db->query('SELECT * FROM GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" AND id="'.$id.'" ');


        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }

     public function delete_row($data,$table_name){
	    foreach($data as $key=>$value){
			$this -> db -> where($key, $value);
			$this -> db -> delete($table_name);
		}
     }
	 
	function get_orderbyValue($data1=array(),$data2,$table_name)
    {
        if($data1!=""){
	        foreach($data1 as $key=>$value){	 
				$this->db->where($key, $value);
			}
		}
		$this->db->order_by($data2);
        $query=$this->db->get($table_name);
        $result= $query->result();
        		
        //$this->db->distinct($data2);
        return $result;
    } 
	function insertproformaCSV($data)
    {
          return $this->db->insert('ProformaInvoice_Master', $data);
     }
	function get_groupbyValue($data1=array(),$data2,$table_name)
    {
        if($data1!=""){
	        foreach($data1 as $key=>$value){	 
				$this->db->where($key, $value);
			}
		}
		$this->db->group_by($data2);
        $query=$this->db->get($table_name);
        $result= $query->result();
        		
        //$this->db->distinct($data2);
        return $result;
    } 

     function insert_multiple_details($data,$table_name)
    {
		$this->db->insert_batch($table_name, $data);
                // return $this->db->insert_id();
    }
    
    function update_specific_detailssss($data,$data1,$table_name){		
	    foreach($data1 as $key1=>$value1){
			$this->db->set($key1, $value1);
			foreach($data as $key=>$value){	
				$this->db->where($key, $value);
			}
			$result=$this->db->update($table_name);	    
		}
    }
   function update_specific_modifyDetails($ctin,$Userid,$FP,$inum,$reasons,$submitInvoice){
        // $query = $this->db->query('UPDATE  GSTR1_B2BINVOICES set reasons="'.$reasons.'",flag="'.$submitInvoice.'" where ctin="'.$ctin.'" AND Userid="'.$Userid.'" AND Financial_period="'.$FP'" AND inum="'.$inum.'" ');
        // return $query->result();

        $sql = 'UPDATE  GSTR1_B2BINVOICES set reasons="'.$reasons.'",flag="'.$submitInvoice.'" where ctin="'.$ctin.'" AND Userid="'.$Userid.'" AND Financial_period="'.$FP.'" AND inum="'.$inum.'" ';
            // echo $sql;
          $query = $this->db->query($sql);
          //$result = $query->result();
          // return $result;
    }
    function gstr2b2bdetails_list($Userid,$Financial_period)
     { 
 $sql = 'SELECT * FROM GSTR2_B2B_invoice_data  WHERE 
      Userid= "'.$Userid.'" AND Financial_period="'.$Financial_period.'" group by inum;';

        $query = $this->db->query($sql);
          $result = $query->result();
          return $result;

}
function update_details_ar($inum,$Userid,$receipt_payment_mode,$receipt_voucherno,$date_of_receipt,$bank_name,$amnt,$Payment_number,$Voucher_type){
    $sql = 'UPDATE  GSTR1_B2BINVOICES set receipt_payment_mode="'.$receipt_payment_mode.'",receipt_voucherno="'.$receipt_voucherno.'",date_of_receipt="'.$date_of_receipt.'",Payment_number="'.$Payment_number.'",Voucher_type="'.$Voucher_type.'",bank_name="'.$bank_name.'",amnt="'.$amnt.'" where inum="'.$inum.'" AND Userid="'.$Userid.'" AND status="1"';
    $query = $this->db->query($sql);
    //print_r($sql);exit();
}
   function check_dup_inumgstr2($inum_deatails1, $vault_no)
    {
     // $this->db->select('inum');
     $this->db->where_in('inum', $inum_deatails1);
     $this->db->where('vault_no', $vault_no);
     $query=$this->db->get('GSTR2_B2B_invoice_data');
     $result= $query->result();       
        
        return $result;
    }
  
     function check_dup_rate($rate_deatails1)
    {
    //print_r($rate_deatails1);exit;
     $this->db->where_in('ratedetail', $rate_deatails1);
     //$this->db->where('vault_no', $vault_no);
     $query=$this->db->get('gst_rate');
     $result= $query->result();       
        return $result;
    }
    function check_dup_sys($combined, $Userid)
    {
     // $this->db->select('inum');
     $this->db->where_in('SysCode', $combined);
     $this->db->where('Userid', $Userid);
     $query=$this->db->get('GstVendorMaster');
     $result= $query->result();       
        
        return $result;
    }
    function check_dup_syscustomer($combined, $Userid)
    {
     // $this->db->select('inum');
     $this->db->where_in('SysCode', $combined);
     $this->db->where('Userid', $Userid);
     $query=$this->db->get('GstCustomerMaster');
     $result= $query->result();       
     return $result;
    }
}
?>