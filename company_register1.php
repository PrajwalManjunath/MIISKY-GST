<?php
session_start();
  define('HOST','localhost');
  define('USER','miiskyroot');
  define('PASS','miisky@123');
  define('DB','MiiGst');
  $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
                // $recaptcha_secret = "6LfxxA8TAAAAAONPG7LL98jtx8pZPvv5wJRnRvoe";
                // $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
                // $response = json_decode($response, true);
                // echo $recaptcha_secret."<br>";
                // echo $response;
                // if($response["success"] == true)
                // {
                    
                

                $company_core = ($_POST['company_core']);
                $category = trim($_POST['category']);
                $status = trim($_POST['status']);
                $Professional = trim($_POST['Professional']);
                $ServiceProviders = trim($_POST['ServiceProviders']);
                $Manufacturers = trim($_POST['Manufacturers']);
                $firm_name = ($_POST['firm_name']);
                $address = trim($_POST['address']);
                $yos = trim($_POST['yos']);
                $password = trim($_POST['password']);
                $mobile = trim($_POST['mobile']);
                $email = trim($_POST['email']);
                $country = trim($_POST['country']);
                $state = trim($_POST['state']);
                $city = trim($_POST['city']);
                $pin = trim($_POST['pin']);
                $gstno= trim($_POST['gstno']);
                $MembershipNo= trim($_POST['MembershipNo']);

                if($country!='India')
                {
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Something went wrong')
                  window.alert('Please select Country as India')
                  window.location.href='NewMii/page_registration1.php';
                  </SCRIPT>");
                } 
                if(empty($state))
                {
                
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Something went wrong')
                  window.alert('State is empty')
                  window.location.href='NewMii/page_registration1.php';
                  </SCRIPT>");
                  // alert('Something went wrong');
                  // alert('Please select State and city accordingly');
                }
                if(empty($city))
                {
                
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Something went wrong')
                  window.alert('city is empty')
                  window.location.href='NewMii/page_registration1.php';
                  </SCRIPT>");
                  // alert('Something went wrong');
                  // alert('Please select State and city accordingly');
                }
                else
                {

                    $sql = "SELECT mobile, email FROM companyregistration WHERE mobile = '$mobile' ";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_fetch_array($result))
                    {
                      $response["error"] = true;
                      $response["error_msg"] = "user already existed with" . ": " . $mobile;
                      echo json_encode($response);
                    }
                    else
                    {
                          $characters = '0123456789';
                          $uuid = '';
                          $random_string_length = 6;
                          for ($i = 0; $i < $random_string_length; $i++)
                          {
                            $uuid .= $characters[rand(0, strlen($characters) - 1)];
                          }
                          $fullname = $fname . " " . $lname;
            
                          // $query = "SELECT country_code FROM country_codes WHERE country_name = '$country' ";
                          // $result = mysqli_query($con, $query);
                          // $row = $result->fetch_assoc();
                          // $country_code = $row['country_code'];
                          $vault_no = $company_core . "". $category. "". $status . "". $Professional . "". $ServiceProviders . "91" . $pin . "" . $uuid;

                          $sql = "insert into companyregistration (company_core, category, Professional , ServiceProviders,Manufacturers,firm_name, status, yos, address, country, state, city, pin, password, gstno, MembershipNo,  mobile, email, vault_no, created_at) 
                          values ('$company_core','$category','$Professional','$ServiceProviders','$Manufacturers','$firm_name','$status','$yos','$address','$country','$state','$city','$pin','$password','$gstno','$MembershipNo','$mobile','$email','$vault_no',now())";

                          // echo $sql;
                          $result = mysqli_query($con, $sql);
                          
                          if($result == 1)
                          {
                            $_SESSION['vault_no'] = $vault_no;
                            $_SESSION['email'] = $email;
                            $_SESSION['mobile'] = $mobile;
                            $_SESSION['firm_name'] = $firm_name;
               
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                                window.alert('Succesfully Stored')
                                window.location.href='formprofile.php';
                                </SCRIPT>");
                          // }
                          // else
                          // {
                          //   $response["error"] = true;
                          //   $response["error_msg"] = "Unknown error occurred in registration!";
                          //   echo json_encode($response);
                          // }
                    }
}
}

// else
// {
//   echo "You are a robot";
// }
mysqli_close($con);
