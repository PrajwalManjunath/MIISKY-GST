<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //read the department list from db
     function get_category_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_category` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
 function get_GSTR3b()
    {
           $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `Gstr3b` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_product_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $vault_no = $data['vault_no'];
            $sql = 'SELECT * FROM  `gst_productmaster` where vault_no =  '.$vault_no.'';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_service_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $vault_no = $data['vault_no'];
            $sql = 'SELECT * FROM  `gst_servicemaster` where vault_no =  '.$vault_no.'';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

     function get_vendor_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_vendormaster` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     
   function get_GSTR1_B2BINVOICES1($Userid,$inum)
    {

          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where Userid="'.$Userid.'" and inum="'.$inum.'" and status="1"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_customer_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_customermaster` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

     function get_bill_supply()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_supplybill` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

     function get_purchase_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_purchasemaster` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
 
 function get_purchases_order_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GST_purchaseOrder` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
 
 function get_purchases_invoice_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_purchase_invoice` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_sales_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_salesmaster` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
      

     function get_sales_order_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `sale_order` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
 function get_sale_invoice_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_sale_invoice` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_document_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $vault_no = $data['vault_no'];
          $sql = 'SELECT * 
                  FROM gst_documentmaster
                  INNER JOIN gst_vendormaster ON gst_documentmaster.VendorId= gst_vendormaster.VendorCode
                  WHERE gst_documentmaster.vault_no =  '.$vault_no.'';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     // function get_vendor_location_list()
     // {  
     //       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
     //      $data['vault_no'] = $details[0]->vault_no;
     //      $data['id'] = $details[0]->id;
     //     $sql = 'SELECT gst_vendor_location.DivisionCode,gst_vendor_location.DivisionName,gst_vendor_location.PIN_CODE,gst_vendor_location.Location,gst_vendor_location.VendorCode, gst_vendor_location.Address, gst_vendor_location.State, gst_vendor_location.GSTIN_No, gst_vendormaster.VendorName, gst_vendor_location.id, gst_vendor_location.ARN_No, gst_vendor_location.Contactperson, gst_vendor_location.ContactNo, gst_vendor_location.EmailID, gst_vendor_location.TAN_No, gst_vendor_location.PAN_No, gst_vendor_location.HSN_code, gst_vendor_location.SAC_code, gst_vendor_location.BankIfscCode, gst_vendor_location.BankAccNo, gst_vendor_location.AccountHolderName, gst_vendor_location.BankName
     //              FROM gst_vendor_location
     //              INNER JOIN gst_vendormaster ON gst_vendor_location.VendorID = gst_vendormaster.VendorID
     //              WHERE gst_vendor_location.vault_no = '.$data['vault_no'].' ';
     //      $query = $this->db->query($sql);
     //      $result = $query->result();
     //      return $result;
     // }
     
     function get_customer_location_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          $vault_no = $data['vault_no'];
           $sql = 'SELECT * FROM gst_customer_location where vault_no = '.$data['vault_no'].' ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     // function get_vendor_location_list()
     // {  
     //       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
     //      $data['vault_no'] = $details[0]->vault_no;
     //      $data['id'] = $details[0]->id;
     //     $sql = 'SELECT gst_vendor_location.DivisionCode,gst_vendor_location.DivisionName,gst_vendor_location.PIN_CODE,gst_vendor_location.Location,gst_vendor_location.VendorCode, gst_vendor_location.Address, gst_vendor_location.State, gst_vendor_location.GSTIN_No, gst_vendormaster.VendorName, gst_vendor_location.id, gst_vendor_location.ARN_No, gst_vendor_location.Contactperson, gst_vendor_location.ContactNo, gst_vendor_location.EmailID, gst_vendor_location.TAN_No, gst_vendormaster.PAN_NO,gst_vendormaster.ECC_NO,gst_vendormaster.VAT_NO, gst_vendor_location.HSN_code, gst_vendor_location.SAC_code, gst_vendor_location.BankIfscCode, gst_vendor_location.BankAccNo, gst_vendor_location.AccountHolderName, gst_vendor_location.BankName, gst_vendor_location.doc_name,gst_vendor_location.DocName1,gst_vendor_location.DocName2,gst_vendor_location.DocName3,gst_vendor_location.DocName4,gst_vendor_location.DocName5,gst_vendor_location.FinalDoc
     //              FROM gst_vendor_location
     //              INNER JOIN gst_vendormaster ON gst_vendor_location.VendorCode = gst_vendormaster.VendorCode
     //              WHERE gst_vendor_location.vault_no = '.$data['vault_no'].' ';
     //      $query = $this->db->query($sql);
     //      $result = $query->result();
     //      return $result;
     // }
     function get_vendor_location_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          $vault_no = $data['vault_no'];
           $sql = 'SELECT * FROM gst_vendor_location where vault_no = '.$data['vault_no'].' ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_item_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $vault_no = $data['vault_no'];
          $sql = 'SELECT * FROM  `gst_itemmaster_hsc` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
      
function get_sale_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_salesenquiry` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_multiple_location_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_multiple_locations` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_tag_refer_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_tag_refer` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function show_student_id($data){
        $this->db->select('*');
        $this->db->from('gst_category');
        $this->db->where('id', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;  
    }

function update_student_id1($id,$data){
     $this->db->where('id', $id);
     $this->db->update('gst_category', $data);  
    }

function gst_vendor_location_list($ID_decript)
     {  
         $sql = 'SELECT *
                  FROM gst_vendor_location
                  WHERE gst_vendor_location.VendorID= "'.$ID_decript.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function gst_customer_location_list($ID_decript)
     {  
         $sql = 'SELECT *
                  FROM gst_customer_location
                  WHERE Customer_ID= "'.$ID_decript.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function gst_vendor_mail($ID_decript)
     {  
         $sql = 'SELECT *
                  FROM gst_vendormaster
                  WHERE gst_vendormaster.VendorID= "'.$ID_decript.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function gst_customer_mail($ID_decript)
     {  
         $sql = 'SELECT *
                  FROM gst_customermaster
                  WHERE gst_customermaster.CustomerID= "'.$ID_decript.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function get_description($item_code)
     {  
         $result = $this->db->where('ItemCode', $item_code)->get('gst_itemmaster')->result();
        $id = array('0');
        $name = array('0');
        for ($i=0; $i<count($result); $i++)
        {
            array_push($id, $result[$i]->ItemDescription);
            array_push($name, $result[$i]->ItemDescription);
        }
        return array_combine($id, $name);
    }

function get_purchase_management_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_purchaseenquiry` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_purchase_quote_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_salenewquotation` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function getTotalvendor()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT COUNT(*) as total_vendor FROM gst_vendormaster WHERE vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function getUpdatedvendor()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT COUNT(*) as updated_vendor FROM gst_vendor_location WHERE vault_no="'.$data['vault_no'].'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function getNoUpdateVendor()
     {  
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT gst_vendormaster.VendorCode,gst_vendormaster.DivisionCode,gst_vendormaster.DivisionName, gst_vendormaster.VendorID, gst_vendormaster.VendorEmail, gst_vendormaster.VendorName, gst_vendormaster.VendorMobile, gst_vendormaster.VendorLandline, gst_vendormaster.Contactperson, gst_vendormaster.VendorAddress, gst_vendormaster.State, gst_vendormaster.City, gst_vendormaster.PIN_CODE, gst_vendormaster.GSTIN_No, gst_vendormaster.Bank_ifsc_code, gst_vendormaster.Bank_accountno, gst_vendormaster.Branch_address, gst_vendormaster.Bank_name, gst_vendormaster.ARN_No, gst_vendormaster.PAN_NO, gst_vendormaster.ECC_NO, gst_vendormaster.VAT_NO
         FROM gst_vendormaster 
         LEFT JOIN gst_vendor_location ON gst_vendormaster.VendorCode = gst_vendor_location.VendorCode
         WHERE gst_vendor_location.id IS NULL AND gst_vendormaster.vault_no = "'.$data['vault_no'].'" ';

          // $sql = 'SELECT * FROM gst_vendor_location WHERE vault_no="'.$data['vault_no'].'" and GSTIN_No in ("")';

          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getNoUpdateVendorCount($vault_no)
     {  
         
         
          $sql = 'SELECT count(gst_vendormaster.VendorCode)
         FROM gst_vendormaster 
         LEFT JOIN gst_vendor_location ON gst_vendormaster.VendorCode = gst_vendor_location.VendorCode
         WHERE gst_vendor_location.id IS NULL AND gst_vendormaster.vault_no = "'.$vault_no.'" ';

          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getNoUpdateCustomerCount($vault_no)
     {  
          
          $sql = 'SELECT count(gst_customermaster.CustomerCode)
         FROM gst_customermaster
         LEFT JOIN gst_customer_location ON gst_customermaster.CustomerCode= gst_customer_location.CustomerCode
         WHERE gst_customer_location.id IS NULL AND gst_customermaster.vault_no = "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getUpdateVendor()
     {  
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT *
         FROM gst_vendor_location 
         WHERE vault_no = "'.$data['vault_no'].'" and GSTIN_No Not in ("") ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     
     function getUpdateCustomer($vault_no)
     {  
        $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT *
         FROM gst_customer_location 
         WHERE vault_no = "'.$vault_no.'" and GSTIN_No Not in ("") ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function getTotalcustomer()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT COUNT(*) as total_customer FROM gst_customermaster WHERE vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function getUpdatedcustomer()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT COUNT(*) as updated_customer FROM gst_customer_location WHERE vault_no="'.$data['vault_no'].'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }



     function getNoUpdateCustomer()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          $sql = 'SELECT gst_customermaster.DivisionName,gst_customermaster.DivisionCode,gst_customermaster.CustomerCode,gst_customermaster.CustomerName, gst_customermaster.CustomerID, gst_customermaster.Email, gst_customermaster.CustomerName, gst_customermaster.Mobile, gst_customermaster.ContactPerson, gst_customermaster.Address, gst_customermaster.City, gst_customermaster.State, gst_customermaster.Pin, gst_customermaster.PAN_Number, gst_customermaster.GSTIN_No, gst_customermaster.VatNo, gst_customermaster.EccNo,gst_customermaster.ClientCode
         FROM gst_customermaster
         LEFT JOIN gst_customer_location ON gst_customermaster.CustomerCode= gst_customer_location.CustomerCode
         WHERE gst_customer_location.id IS NULL AND gst_customermaster.vault_no = "'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

    function get_all_custloc_list($vault_no)
     { 
     
          $sql = 'SELECT * FROM  `gst_customer_location` where GSTIN_No in ("") AND vault_no="'.$vault_no.'"   ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
      }

function get_all_vendor_list($vault_no)
     { 
          $sql = 'SELECT * FROM  `gst_vendormaster` where vault_no="'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_all_invoice_client_list($vault_no)
     { 
          $sql = 'SELECT * FROM  `Gst_adminDocumentSereis` where vault_no="'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_all_customer_list($vault_no)
     { 
          $sql = 'SELECT * FROM  `gst_customermaster` where vault_no="'.$vault_no.'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_vendor_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_vendor_location WHERE VendorCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_vendor_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_vendor_location WHERE VendorName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_Provisional_ID_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_vendor_location WHERE GSTIN_No LIKE "'.$search.'%'
          .'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_customer_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_customer_location WHERE CustomerCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_customer_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_customer_location WHERE CustomerName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_customer_Provisional_ID_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_customer_location WHERE GSTIN_No LIKE "'.$search.'%'
          .'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_vendor_master_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_vendormaster WHERE VendorCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_vendor_master_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_vendormaster WHERE VendorName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_Email_ID_master_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_vendormaster WHERE VendorEmail LIKE "'.$search.'%'
          .'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_customer_master_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_customermaster WHERE CustomerCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_customer_master_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_customermaster WHERE CustomerName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function filter_customer_Email_ID_master_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_customermaster WHERE Email LIKE "'.$search.'%'
          .'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function filter_vendor_master_item_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_itemmaster WHERE itemcode LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getsendmailcust($vault_no,$FrCID,$ToCID)
     { 
          $sql = 'SELECT * FROM  `gst_customermaster` where vault_no="'.$vault_no.'" and CustomerID BETWEEN "'.$FrCID.'" and "'.$ToCID.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getsendmailvend($vault_no,$FrVID,$ToVID)
     { 
          $sql = 'SELECT * FROM  `gst_vendormaster` where vault_no="'.$vault_no.'" and VendorID BETWEEN "'.$FrVID.'" and "'.$ToVID.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function filter_vendor_division_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_vendormaster WHERE DivisionCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_vendor_division_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_vendormaster WHERE DivisionName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function filter_customer_division_code_list($vault_no, $search)
     { 
          $sql = 'SELECT * FROM gst_customermaster WHERE DivisionCode LIKE "'.$search.'%'.'" AND vault_no =  "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function filter_customer_division_name_list($vault_no,$search)
     { 
          $sql = 'SELECT * FROM gst_customermaster WHERE DivisionName LIKE "'.$search.'%'.'" AND vault_no= "'.$vault_no.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     /**Not updated customers and vendors**/
     function getsendremaindermailcust($vault_no,$FrCID,$ToCID)
     { 
 
          $sql = 'SELECT gst_customermaster.CustomerCode, gst_customermaster.CustomerID, gst_customermaster.Email, gst_customermaster.CustomerName
         FROM gst_customermaster
         LEFT JOIN gst_customer_location ON gst_customermaster.CustomerCode= gst_customer_location.CustomerCode
         WHERE gst_customer_location.GSTIN_No IS NULL AND gst_customermaster.vault_no = "'.$vault_no.'" and gst_customermaster.CustomerID BETWEEN "'.$FrCID.'" and "'.$ToCID.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function getsendremaindermailvend($vault_no,$FrVID,$ToVID)
     { 
      
          $sql = 'SELECT gst_vendormaster.VendorCode, gst_vendormaster.VendorID, gst_vendormaster.VendorEmail, gst_vendormaster.VendorName
         FROM gst_vendormaster 
         LEFT JOIN gst_vendor_location ON gst_vendormaster.VendorCode = gst_vendor_location.VendorCode
         WHERE gst_vendor_location.id IS NULL AND gst_vendormaster.vault_no = "'.$vault_no.'" and gst_vendormaster.VendorID BETWEEN "'.$FrVID.'" and "'.$ToVID.'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }


function get_purchaseEnquiry_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_purchaseenquiry` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_gstr1invoice_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR1_B2BINVOICES` where vault_no="'.$data['vault_no'].'" and status="1" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_gstr1invoice_gstr3b($Financial_period)
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR1_B2BINVOICES` where vault_no="'.$data['vault_no'].'" AND  Financial_period="'.$Financial_period.'" and status="1" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_gstr2invoice_gstr3b($Financial_period)
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR2_B2BUR_invoice_data` where vault_no="'.$data['vault_no'].'" AND  Financial_period="'.$Financial_period.'" and ctin is NULL';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_gstr2invoice_gstr3b2($Financial_period)
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR2_B2BUR_invoice_data` where vault_no="'.$data['vault_no'].'" AND  Financial_period="'.$Financial_period.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_gstr1b2binvoice_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR1_B2BL_INVOICES` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
          function get_gstr1b2clinvoice_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR1_B2CLINVOICES` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_gstr1b2csinvoice_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `GSTR1_B2CSINVOICES` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_purchase_proforma_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_sale_proformainvoice` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_purchase_profrma_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_proforma_invoice_purchase` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
     function get_entity_list($vaultNo)
     {  
          $sql = 'SELECT * FROM  `gst_entitymaster` where vaultNo="'.$vaultNo.'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function get_purchase_invoice_list()
     {  
         $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $sql = 'SELECT * FROM  `gst_sale_invoice` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }

function update_remark($remark,$id)
    {
       $this->db->set('remark', $remark); //value that used to update column  
       $this->db->where('CustomerID', $id); //which row want to upgrade  
       $this->db->update('gst_customermaster');
    }
     
function update_name($name,$id)
    {

       $this->db->set('name', $name); //value that used to update column  
       $this->db->where('CustomerID', $id); //which row want to upgrade  
       $this->db->update('gst_customermaster');
    }

function updateVendor_remark($remark,$id)
    {
       $this->db->set('remark', $remark); //value that used to update column  
       $this->db->where('VendorID', $id); //which row want to upgrade  
       $this->db->update('gst_vendormaster');
    }
     
function updateVendor_name($name,$id)
    {

       $this->db->set('name', $name); //value that used to update column  
       $this->db->where('VendorID', $id); //which row want to upgrade  
       $this->db->update('gst_vendormaster');
    }

function getHsnCode()
    {

       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT * FROM Gst_hsncode_ratemaster; ';
        $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }

    function getSacCode()
    {

       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT * FROM gst_sacmaster; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }

    function sale_register_details()
    {

       $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT *  FROM gst_sale_invoice; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function acceptance_type()
    {

          $sql = 'SELECT *  FROM  Acceptance_option_master; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function uqc_type()
    {

          $sql = 'SELECT * FROM   UQC_master; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
  function customer_type()
    {

          $sql = 'SELECT *  FROM   Customer_type_master; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
 function purchase_register_details()
    {

          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $data['id'] = $details[0]->id;
          
         
          $sql = 'SELECT *  FROM gst_purchase_invoice; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
function vendor_type()
    {

          $sql = 'SELECT *  FROM   Vendor_type_master; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
function outward_details()
    {

          $sql = 'SELECT *  FROM    Inward_supplies_from_outward_vendor; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_gstindetails_list($vault_no)
    {
          $sql = 'SELECT *  FROM  Gst_adminOffice where vault_no='.$vault_no.'  ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    
    function get_GSTR1_B2BINVOICES($vault_no)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and status="1" group by inum; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_ProformaInvoice($vault_no)
    {
          $sql = 'SELECT *  FROM  ProformaInvoice_Master where vault_no='.$vault_no.' and flag is NULL; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_ProformaInvoice_dist($vault_no)
    {
          $sql = 'SELECT Distinct InvoiceNumber  FROM  ProformaInvoice_Master where vault_no='.$vault_no.' and flag="A"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_ProformaInvoiceAccepted($vault_no)
    {
          $sql = 'SELECT *  FROM  ProformaInvoice_Master where vault_no='.$vault_no.' and flag="A"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_GSTR1_B2BINVOICES_dist($vault_no)
    {
          $sql = 'SELECT DISTINCT inum  FROM  GSTR1_B2BINVOICES where vault_no='.$vault_no.' and status="1" ORDER by inum asc; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     

    
    function getGst_adminDocumentSereis($vault_no)
    {

          $sql = 'SELECT *  FROM  gst_envoice_master where vault_no='.$vault_no.' order by id desc limit 1; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_inum($inum)
    {

          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where inum='.$inum.' and status="1"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_SUM($vault_no,$inum)
    {

          $sql = 'SELECT *, sum(txval) as TotTaxVal,sum(Basic_value) as Basic_value, sum(DiscountValue) as DiscountValue, sum(samt) as samt, sum(camt) as camt, sum(iamt) as iamt,Gstinno_seller,Gstinno_customer,Month,Year,Address_of_receiver,SellerState,Name_of_seller,Address_of_seller,Name_of_receiver,Address_of_receiver,inum,idt,Gstinno_customer,Subcustomer_vaultno,Gstinno_subcustomer,Gstr_no,rchrg,pos,ctin,dos,email,phone_no,idt,doc_dt,doc_num  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and inum="'.$inum.'" and status="1" order by id desc; ';
           
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_GSTR1_B2BINVOICES_SUM1($vault_no,$Financial_period)
    {

          $sql = 'SELECT *, sum(txval) as TotTaxVal,sum(Basic_value) as Basic_value, sum(DiscountValue) as DiscountValue, sum(samt) as samt, sum(camt) as camt, sum(iamt) as iamt,Gstinno_seller,Gstinno_customer,Month,Year,Address_of_receiver,SellerState,Name_of_seller,Address_of_seller,Name_of_receiver,Address_of_receiver,inum,idt,Gstinno_customer,Subcustomer_vaultno,Gstinno_subcustomer,Gstr_no,rchrg,pos,ctin,dos,email,phone_no,idt,doc_dt,doc_num  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and Financial_period="'.$Financial_period.'" and status=1 ';
           //print_r($sql);exit();
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_hsn($vault_no,$inum)
    {

          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and inum="'.$inum.'" and status="1"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    // function update_GSTR1_B2BINVOICES($inum,$data2){
    //   $this->db->where('inum', $inum);
    //  $this->db->update('GSTR1_B2BINVOICES', $data2);   
    // }
    function get_gst_envoice_master($vault_no,$inum)
    {

          $sql = 'SELECT *  FROM  gst_envoice_master where vault_no="'.$vault_no.'" and inum="'.$inum.'"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_gst_dist_b2binv($vault_no,$inum)
    {

          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and inum="'.$inum.'" and status="0" GROUP BY inum; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_gst_dist_b2binv1($inum)
    {

          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where inum="'.$inum.'" and status="1" GROUP BY inum; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_freight($vault_no,$inum)
    {

          $sql = 'SELECT *  FROM  GSTR2_Freight_And_Insurance where vault_no="'.$vault_no.'" and inum="'.$inum.'"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_desp($Sac_code)
    {

          $sql = ' SELECT Description FROM gst_sacmaster where Sac_code="'.$Sac_code.'"; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }

function get_proforma_SUM($vault_no,$InvoiceNumber)
    {

          $sql = 'SELECT *, sum(TaxableValue) as TaxableValue,sum(Sgst) as Sgst, sum(Cgst) as Cgst  FROM  ProformaInvoice_Master where vault_no="'.$vault_no.'" and InvoiceNumber="'.$InvoiceNumber.'" order by id desc; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }

      function get_cumulative_value($vault_no,$Financial_period)
    {
     $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     $this->db->query($query);
    $sql = 'SELECT id, `supplier_vault_no`, `rchrgdup`,`iamt`,`camt`,`samt`, `buyer_vault_no`, `Name_of_buyer`, `Name_of_receiver`, `sup_state`, `sup_code`, `supplier_loc_vault_no`, `Gstin_uid_purchaser`, `Gstin_uid_receiver`, `Financial_period`, `advnc`, `ctin`, `rt`, `nt_dt`, `chksum`, `ostd`, `qty`, `rtin`, `nt_num`, `inum`, `imp_g`, `rsn`, `is_sez`, `idt`, `val`, `flag`, `rchrg`, `pos_location`, `pos_loc`, `oinum`, `oidt`, `list`, `num`, `purchase_invoice_number`, `purchase_order_number`, `itc_details`, `itm_det`, `ty`, `hsn_sc`, `det`, `rate`, `basic_rate`, `discount`, `discount_value`, `net_basic`, `uqc`, `qty_purchased`, `inv_typ`, `rate`,`txval`, `irt` ,`crt`,`srt`,(@isum := @isum +  `iamt`) AS cumulative_sum, (@csum := @csum +  `camt`) AS crt_sum,(@ssum := @ssum +  `samt`) AS srt_sum FROM  `GSTR2_B2B_invoice_data` where vault_no="'.$vault_no.'" AND  Financial_period="'.$Financial_period.'" AND  month(`created_at`) = "'. date('m').'"  ORDER BY id;';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }
  function get_item_sac_list()
     {  
          $details = $this->User_model->get_user_by_id($this->session->userdata('id'));
          $data['vault_no'] = $details[0]->vault_no;
          $vault_no = $data['vault_no'];
          $sql = 'SELECT * FROM  `gst_itemmaster_sac` where vault_no="'.$data['vault_no'].'" ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
     }
function gstr1b2b4atableref_list1($vault_no,$Financial_period)
     { 
 $sql = 'SELECT * FROM GSTR1_B2BL_INVOICES WHERE 
      vault_no= "'.$vault_no.'" AND Gstr_tableref="4A" AND  Financial_period="'.$Financial_period.'"';

        $query = $this->db->query($sql);
          $result = $query->result();
          return $result;

}

  function get_sum_value($vault_no)
    {
     // $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     // $this->db->query($query);
    $sql = 'SELECT id ,`supplier_vault_no`,"'.date("m", strtotime('idt')).'" as month,idt, `Section_type`,`rchrgdup`, `buyer_vault_no`, `Name_of_buyer`, `Name_of_receiver`, `sup_state`, `sup_code`, `supplier_loc_vault_no`, `Gstin_uid_purchaser`, `Gstin_uid_receiver`, `Financial_period`, `advnc`, `ctin`, `rt`, `nt_dt`, `chksum`, `ostd`, `qty`, `rtin`, `nt_num`, `inum`, `imp_g`, `rsn`, `is_sez`, `idt`, `val`, `flag`, `rchrg`, `pos_location`, `pos_loc`, `oinum`, `oidt`, `list`, `num`, `purchase_invoice_number`, `purchase_order_number`, `itc_details`, `itm_det`, `ty`, `hsn_sc`, `det`, `rate`, `basic_rate`, `discount`, `discount_value`, `net_basic`, `uqc`, `qty_purchased`, `inv_typ`, `txval`, `irt` ,`crt`,`srt`,sum(`iamt`) AS irt_sum,sum(`samt`) AS srt_sum,sum(`camt`) AS crt_sum FROM  `GSTR2_B2B_invoice_data` where vault_no="'.$vault_no.'"  GROUP BY Section_type, "'.date("m", strtotime('idt')).'" ORDER BY idt;';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }

        function get_creditledgerDetails_value($vault_no)
    {
     // $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     // $this->db->query($query);
    $sql = 'SELECT *  FROM  GSTR2_B2B_invoice_data where vault_no="'.$vault_no.'" ORDER BY inum;  ';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }

        function get_hsnSum_value($vault_no,$Financial_period)
    {
     // $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     // $this->db->query($query);
    $sql = 'SELECT id ,`supplier_vault_no`,`hsn_sc`,idt, `Section_type`,sum(`qty_purchased`) as qty,sum(`val`) as total_value,sum(`txval`) as txval_value,`rchrgdup`, `buyer_vault_no`, `Name_of_buyer`, `Name_of_receiver`, `sup_state`, `sup_code`,`itm_det`, `supplier_loc_vault_no`, `Gstin_uid_purchaser`, `Gstin_uid_receiver`, `Financial_period`, `advnc`, `ctin`, `rt`, `nt_dt`, `chksum`, `ostd`, `qty`, `rtin`, `nt_num`, `inum`, `imp_g`, `rsn`, `is_sez`, `idt`, `flag`, `rchrg`, `pos_location`, `pos_loc`, `oinum`, `oidt`, `list`, `num`, `purchase_invoice_number`, `purchase_order_number`, `itc_details`, `itm_det`, `ty`, `hsn_sc`, `det`, `rate`, `basic_rate`, `discount`, `discount_value`, `net_basic`, `uqc`, `qty_purchased`, `inv_typ`, `txval`, `irt` ,`crt`,`srt`,sum(`iamt`) AS irt_sum,sum(`samt`) AS srt_sum,sum(`camt`) AS csrt_sum,sum(`csamt`) AS crt_sum FROM  `GSTR2_B2B_invoice_data` where vault_no="'.$vault_no.'" and `Financial_period`="'.$Financial_period.'"   GROUP BY hsn_sc';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }
   function get_hsnSum_value_gstr1($vault_no)
    {
     // $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     // $this->db->query($query);
    $sql = 'SELECT id ,`hsn_sc`, `idt`, `inum`, `num`, sum(`val`) as val,`Section_type`,sum(`qty`) as qty,sum(`txval`) as txval,`rchrg`,`Financial_period`,`uqc`,`ctin`,`rt`,sum(`iamt`) AS iamt,sum(`samt`) AS samt,sum(`camt`) AS camt,sum(`csamt`) AS csamt FROM  `GSTR1_B2BINVOICES` where vault_no="'.$vault_no.'" and status="1"  GROUP BY hsn_sc';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }
  function gst1_b2b_inv_count($vault_no)
  {
  // {SELECT count(inum) FROM  `GSTR1_B2BINVOICES` where vault_no="512191560098978039" and status="1"  group by inum limit 1
    $sql = 'SELECT count(inum) FROM  `GSTR1_B2BINVOICES` where vault_no="'.$vault_no.'" and status="1" group by inum limit 1';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }
  function get_sum1_value($vault_no,$Financial_period)
    {
     // $query ='set @isum := 0,@csum := 0,@ssum := 0;';
     // $this->db->query($query);
    $sql = 'SELECT id ,`supplier_vault_no`,"'.date("m", strtotime('idt')).'" as month,idt, `Section_type`,`rchrgdup`, `buyer_vault_no`, `Name_of_buyer`, `Name_of_receiver`, `sup_state`, `sup_code`, `supplier_loc_vault_no`, `Gstin_uid_purchaser`, `Gstin_uid_receiver`, `Financial_period`, `advnc`, `ctin`, `rt`, `nt_dt`, `chksum`, `ostd`, `qty`, `rtin`, `nt_num`, `inum`, `imp_g`, `rsn`, `is_sez`, `idt`, `val`, `flag`, `rchrg`, `pos_location`, `pos_loc`, `oinum`, `oidt`, `list`, `num`, `purchase_invoice_number`, `purchase_order_number`, `itc_details`, `itm_det`, `ty`, `hsn_sc`, `det`, `rate`, `basic_rate`, `discount`, `discount_value`, `net_basic`, `uqc`, `qty_purchased`, `inv_typ`, `txval`, `irt` ,`crt`,`srt`,sum(`iamt`) AS irt_sum,sum(`samt`) AS srt_sum,sum(`camt`) AS crt_sum FROM  `GSTR2_B2B_invoice_data` where vault_no="'.$vault_no.'" and `Financial_period`="'.$Financial_period.'"  GROUP BY  "'.date("m", strtotime('idt')).'" ORDER BY idt;';
      $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
  }
function get_GSTR1_B2BINVOICES_11($vault_no)
    {
          $sql = 'SELECT * FROM  GSTR1_B2BINVOICES where vault_no='.$vault_no.' and flag="R" and status="1" group by inum;';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_12($vault_no)
    {
          $sql = 'SELECT * FROM  GSTR1_B2BINVOICES where vault_no='.$vault_no.' and flag="P" and status="1" group by inum;';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    
     function get_GSTR2_B2BINVOICES_SUM($vault_no,$inum)
    {

          $sql = 'SELECT *, sum(txval) as TotTaxVal,sum(basic_rate) as Basic_value, sum(discount_value) as DiscountValue, sum(samt) as samt, sum(camt) as camt, sum(iamt) as iamt,Gstin_uid_purchaser,Gstin_uid_receiver,sup_state,sup_name,Name_of_receiver,Name_of_buyer,inum,idt,rchrg,pos_location,ctin,sup_email,discount  FROM  GSTR2_B2B_invoice_data where vault_no="'.$vault_no.'" and inum="'.$inum.'" order by id desc; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    // function get_GSTR1_B2BINVOICES_nilrated($vault_no)
    // {
    //       $sql = 'SELECT * FROM  `GSTR1_NILRATED` where vault_no='.$vault_no.' group by inum;';
    //       $query = $this->db->query($sql);
    //       $result = $query->result();
    //       return $result;
    // }

   function get_GSTR1_B2BINVOICES_dist_inv($vault_no,$inum)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where vault_no="'.$vault_no.'" and inum="'.$inum.'" and status="1" order by id desc limit 1; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function send_gstr1_mails($Userid)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where Userid="'.$Userid.'" and status="1" and `EmailofSeller`!="" AND EmailofReceiver!="" group by inum';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function send_gstr1_mails_1($Userid,$FP)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where Userid="'.$Userid.'" and Financial_period="'.$FP.'" and status="1" and `EmailofSeller`!="" AND EmailofReceiver!="" group by inum';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_cust_invoice_list($ctin,$Userid,$FP)
    {
          $sql = 'SELECT *,sum(val) as val,sum(iamt) as iamt,sum(camt) as camt,sum(samt) as samt  FROM  GSTR1_B2BINVOICES where Userid="'.$Userid.'" and Financial_period="'.$FP.'" and status="1" and `ctin`="'.$ctin.'" group by inum';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function send_gstr1_errormails($Userid,$FP)
    {
          $sql = 'SELECT *,COUNT(DISTINCT inum) as inum FROM GSTR1_B2BINVOICES  WHERE Userid= "'.$Userid.'" AND Financial_period="'.$FP.'" and status="1" group by inum';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
function get_gst_error_mail($inum,$Userid)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where (inum="'.$inum.'" and  status="1") and Userid="'.$Userid.'" GROUP BY inum; ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
 function gst_sup_info($sup_code)
  {
      $sql = 'SELECT gst_vendor_location.GSTIN_No as GSTIN_No, gst_vendormaster.vault_no as vault_no,gst_vendormaster.VendorEmail as EmailID,gst_vendormaster.VendorName as VendorName,gst_vendormaster.VendorAddress as Address
          FROM  gst_vendormaster LEFT JOIN gst_vendor_location
          ON gst_vendor_location.VendorCode = gst_vendormaster.VendorCode
           WHERE gst_vendor_location.VendorCode= "'.$sup_code.'" group by gst_vendor_location.VendorCode ';
          $query = $this->db->query($sql);
          $result = $query->result();
          //print_r($result);
          return $result;
    }
    
   function send_gstr1_mails_2($Userid,$FP)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where Userid="'.$Userid.'" and Financial_period="'.$FP.'" and status="1" and `EmailofSeller`!="" AND EmailofReceiver!="" group by inum,ctin';
          //var_dump($sql);exit;
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function ExcelCols($Userid)
    {
          $sql = 'SELECT *  FROM  Gst_ExcelMap where Userid="'.$Userid.'" order by id desc limit 1';
          // var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    
    
    function get_gstindetails_list1()
    {
          $sql = 'SELECT *  FROM  Gst_adminOffice;';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    
    function get_GSTR1_B2BINVOICES_ar($inum,$Userid)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where inum="'.$inum.'" and Userid="'.$Userid.'" and status="1"; ';
                 
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_ArView($Financial_period,$Userid)
    {
          $sql = 'SELECT *  FROM  GSTR1_B2BINVOICES where Financial_period="'.$Financial_period.'" and Userid="'.$Userid.'" and status=1';
                 
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_CustomerData($Userid)
    {
          $sql = 'SELECT *  FROM  GstCustomerMaster where Userid="'.$Userid.'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_VendorData($Userid)
    {
          $sql = 'SELECT *  FROM  GstVendorMaster where Userid="'.$Userid.'"';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function ExcelCols2($Userid)
    {
          $sql = 'SELECT *  FROM  Gst2_ExcelMap where Userid="'.$Userid.'" order by id desc limit 1';
          // var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function ExcelCols5($Userid)
    {
          $sql = 'SELECT *  FROM  Gst2_ExcelMap where Userid="'.$Userid.'" order by id';
          // var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_Reconcile1($Userid)
    {
          //$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.iamt=t2.iamt and t1.camt=t2.camt and t1.samt=t2.samt and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'"';
          $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'"';
      // group by t1.inum,t2.inum order by t1.inum ASC///$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum  WHERE t1.Userid=42 and t2.Userid=42';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
   function get_GSTR2_B2BINVOICES_ReconcileFP($Userid,$Financial_period,$ctin)
    {
          //$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.iamt=t2.iamt and t1.camt=t2.camt and t1.samt=t2.samt and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'"';
         if($ctin=="Gstin"){
               // $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin  and t1.samt=t2.samt and t1.camt=t2.camt and t1.iamt=t2.iamt  and t1.txval=t2.txval and t1.Userid=t2.Userid and t1.Financial_period=t2.Financial_period  WHERE t2.Userid="'.$Userid.'" and t2.Financial_period="'.$Financial_period.'"';
                // $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, sum(t1.txval) as txval2, sum(t2.txval) as txval2a, sum(t1.iamt) as iamt2, sum(t2.iamt) as iamt2a, sum(t1.camt) as camt2, sum(t2.camt) as camt2a, sum(t1.samt) as samt2, sum(t2.samt) as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin  and t1.Userid=t2.Userid and t1.Financial_period=t2.Financial_period  WHERE t2.Userid="'.$Userid.'" and t2.Financial_period="'.$Financial_period.'" group by t1.ctin';

//                 $sql = "SELECT CONCAT(t1.ctin,',',t1.inum) as tabl1, sum(t1.txval) as txval2, sum(t2.txval) as txval2a, sum(t1.iamt) as iamt2, sum(t2.iamt) as iamt2a, sum(t1.camt) as camt2, sum(t2.camt) as camt2a, sum(t1.samt) as samt2, sum(t2.samt) as samt2a FROM `GSTR2_B2B_invoice_data` as t1 
// INNER JOIN 
// GSTR2A AS t2 ON CONCAT(t1.ctin,',',t1.inum) = CONCAT(t2.ctin,',',t2.inum)  and t1.Userid=t2.Userid  WHERE t2.Userid='".$Userid."' and t2.Financial_period='".$Financial_period."' group by tabl1";

$sql = "SELECT CONCAT(t1.ctin,'#$#',t1.inum) as tabl1, (t1.txval) as txval2, (t2.txval) as txval2a, (t1.iamt) as iamt2, (t2.iamt) as iamt2a, (t1.camt) as camt2, (t2.camt) as camt2a, (t1.samt) as samt2, (t2.samt) as samt2a FROM `GSTR2_B2B_invoice_data` as t1 
INNER JOIN 
GSTR2A AS t2 ON CONCAT(t1.ctin,'#$#',t1.inum) = CONCAT(t2.ctin,'#$#',t2.inum)  and t1.Userid=t2.Userid and t1.txval=t2.txval WHERE t2.Userid='".$Userid."' and t2.Financial_period='".$Financial_period."'";



         }

     else{
           $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.Userid=t2.Userid  and t1.samt=t2.samt and t1.camt=t2.camt and t1.iamt=t2.iamt and t1.Financial_period=t2.Financial_period  WHERE t2.Userid="'.$Userid.'" and t2.Financial_period="'.$Financial_period.'"';
         }
      // group by t1.inum,t2.inum order by t1.inum ASC///$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum  WHERE t1.Userid=42 and t2.Userid=42';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_Reconcile($Userid)
    {
          $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` where Userid="'.$Userid.'"  order by inum ASC';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_Reconcile_fp($Userid,$Financial_period)
    {
          $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` where Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'" order by inum ASC';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_Reconcile_gstr2a($Userid)
    {
          $sql = 'SELECT * FROM `GSTR2A` where Userid="'.$Userid.'"  order by inum ASC';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR1_B2BINVOICES_Reconcile_gstr2aFP($Userid,$Financial_period)
    {
          $sql = 'SELECT * FROM `GSTR2A` where Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'" order by inum ASC';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_Reconcile_unmtached($Userid)
    {
          $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` t1 WHERE not exists (select * from GSTR2A t2 where t2.ctin = t1.ctin and t2.inum = t1.inum and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'"';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_GSTR2_B2BINVOICES_Reconcile_unmtachedfp($Userid,$Financial_period,$ctin)
    {
       if($ctin="Gstin"){
          //$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` t1 WHERE not exists (select * from GSTR2A t2 where t2.ctin = t1.ctin  and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
           $sql="SELECT *,CONCAT(t1.ctin,'#$#',t1.inum) as tabl1, (t1.txval) as txval2, (t1.iamt) as iamt2, (t1.camt) as camt2, (t1.samt) as samt2, 
           (select VendorName  from GstVendorMaster v where v.GSTIN = t1.ctin and v.Userid = t1.Userid limit 1) as VendorName,
(select EmailId from GstVendorMaster v where v.GSTIN = t1.ctin  and v.Userid = t1.Userid limit 1) as vendorEmail
           FROM `GSTR2_B2B_invoice_data` as t1 
WHERE NOT EXISTS(SELECT * FROM GSTR2A as t2 WHERE CONCAT(t1.ctin,'#$#',t1.inum) = CONCAT(t2.ctin,'#$#',t2.inum)) and Userid=".$Userid." and Financial_period=".$Financial_period."";
       }
        else{
          $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` t1 WHERE not exists (select * from GSTR2A t2 where t2.ctin = t1.ctin and t2.inum = t1.inum and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
        }
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_unmtachedFP($Userid,$Financial_period,$ctin)
    {
      if($ctin=='Gstin'){
           $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` t1 WHERE not exists (select * from GSTR2A t2 where t2.ctin = t1.ctin  and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
        
//echo $sql;
      }
      else{
         $sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` t1 WHERE not exists (select * from GSTR2A t2 where t2.ctin = t1.ctin and t2.inum = t1.inum and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
      }
         
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_GSTR2_B2BINVOICES_Reconcile_unmtached_2a($Userid)
    {
          $sql = 'SELECT * FROM `GSTR2A` t1 WHERE not exists (select * from GSTR2_B2B_invoice_data t2 where t2.ctin = t1.ctin and t2.inum = t1.inum and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'"';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function get_GSTR2_B2BINVOICES_Reconcile_unmtached_2afp($Userid,$Financial_period,$ctin)
    {
         if($ctin=='Gstin'){
          // $sql = 'SELECT * FROM `GSTR2A` t1 WHERE not exists (select * from GSTR2_B2B_invoice_data t2 where t2.ctin = t1.ctin  and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
          $sql="SELECT *,CONCAT(t1.ctin,'#$#',t1.inum) as tabl1, (t1.txval) as txval2, (t1.iamt) as iamt2, (t1.camt) as camt2, (t1.samt) as samt2,
           (select VendorName  from GstVendorMaster v where v.GSTIN = t1.ctin and v.Userid = t1.Userid limit 1) as VendorName,
(select EmailId from GstVendorMaster v where v.GSTIN = t1.ctin  and v.Userid = t1.Userid limit 1) as vendorEmail FROM GSTR2A as t1 
WHERE NOT EXISTS(SELECT * FROM GSTR2_B2B_invoice_data as t2 WHERE CONCAT(t1.ctin,'#$#',t1.inum) = CONCAT(t2.ctin,'#$#',t2.inum)) and Userid=".$Userid." and Financial_period=".$Financial_period;

        }
          else{
             $sql = 'SELECT * FROM `GSTR2A` t1 WHERE not exists (select * from GSTR2_B2B_invoice_data t2 where t2.ctin = t1.ctin and t2.inum = t1.inum and t2.Userid = t1.Userid and t1.txval=t2.txval) and Userid="'.$Userid.'" and `Financial_period`="'.$Financial_period.'"';
          }
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2_B2BINVOICES_Reconcile_Summary($Userid)
    {
          $sql = 'SELECT sum(txval) as txval,sum(samt) as samt,sum(camt) as camt,sum(iamt) as iamt FROM GSTR2_B2B_invoice_data where Userid="'.$Userid.'" ; ';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    function get_GSTR2A_B2BINVOICES_Reconcile_Summary($Userid)
    {
          $sql = 'SELECT sum(txval) as txval,sum(samt) as samt,sum(camt) as camt,sum(iamt) as iamt FROM  GSTR2A where Userid="'.$Userid.'" ; ';
          //var_dump($sql);
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
    
    function get_GSTR2_B2BINVOICES_Reconcile_matched_withdiffP($Userid,$Financial_period,$ctin)
    {
          //$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.iamt=t2.iamt and t1.camt=t2.camt and t1.samt=t2.samt and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'"';
      if($ctin="Gstin"){
       // $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin  and t1.txval=t2.txval and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'" AND t2.Financial_period="'.$Financial_period.'"';
        // $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin  and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'" AND t2.Financial_period="'.$Financial_period.'"';

        $sql = "SELECT CONCAT(t1.ctin,'#$#',t1.inum) as tabl1, (t1.txval) as txval2, (t2.txval) as txval2a, (t1.iamt) as iamt2, (t2.iamt) as iamt2a, (t1.camt) as camt2, (t2.camt) as camt2a, (t1.samt) as samt2, (t2.samt) as samt2a, t3.EmailId as VendorEmail, t3.VendorName as VendorName FROM `GSTR2_B2B_invoice_data` as t1 
INNER JOIN 
GSTR2A AS t2 ON CONCAT(t1.ctin,'#$#',t1.inum) = CONCAT(t2.ctin,'#$#',t2.inum)  and t1.Userid=t2.Userid  
INNER JOIN
GstVendorMaster t3 ON t3.GSTIN = t1.ctin AND t3.Userid = t1.Userid
WHERE t2.Userid='".$Userid."' and t2.Financial_period='".$Financial_period."'";
      }else{
        $sql = 'SELECT *,t1.ctin as ctin2,t2.ctin as ctin2a, t1.inum as inum2, t2.inum as inum2a, t1.idt as idt2, t2.idt as idt2a,t1.val as val2, t2.val as val2a, t1.txval as txval2, t2.txval as txval2a, t1.iamt as iamt2, t2.iamt as iamt2a, t1.camt as camt2, t2.camt as camt2a, t1.samt as samt2, t2.samt as samt2a FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum and t1.txval=t2.txval and t1.Userid=t2.Userid  WHERE t2.Userid="'.$Userid.'" AND t2.Financial_period="'.$Financial_period.'"';

      }
          
      // group by t1.inum,t2.inum order by t1.inum ASC///$sql = 'SELECT * FROM `GSTR2_B2B_invoice_data` as t1 INNER JOIN GSTR2A AS t2 ON t1.ctin=t2.ctin and t1.inum=t2.inum  WHERE t1.Userid=42 and t2.Userid=42';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
}