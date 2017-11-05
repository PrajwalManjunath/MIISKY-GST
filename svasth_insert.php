<?php 
    include("svasth_connect.php");
    /** Date and time set according to indian timings **/

    //$dt2=date("Y-m-d h:i:s");
    $indiatimezone = new DateTimeZone("Asia/Kolkata" );
    $date = new DateTime();
    $date->setTimezone($indiatimezone);
    $dt1=$date->format( 'jS M Y' );
    $dt2 = $date->format( 'g:i A' );
    $current_date_time=$date->format( 'Y-m-d G:i:s' );
    $current_dat=$date->format( 'Y-m-d' );
    $current_tim=$date->format( 'G:i:s' );

    $ecg_data= $_REQUEST['ecg_data'];
    $temp = $_REQUEST['temp'];
    $hrpul = $_REQUEST['hrpul'];
    $spo2 = $_REQUEST['spo2'];
    $hrecg = $_REQUEST['hrecg'];
    $sim_no = $_REQUEST['sim_no'];
    $rr_rate= $_REQUEST['rr_rate'];
    $calibrated= $_REQUEST['calibrated'];
    $diabetes_inv= $_REQUEST['diabetes_inv'];

    $dis_name1="SELECT name,DiabeticNonDiabetic from svasth_registration WHERE device_sim_no='".$sim_no."' order by id desc limit 1";
    $dis_name2=mysql_query($dis_name1);
    $dis_name=mysql_fetch_array($dis_name2);
    $name=$dis_name['name'];
    $DiabeticNonDiabetic=$dis_name['DiabeticNonDiabetic'];
    echo $DiabeticNonDiabetic;
    $diabetes = $_REQUEST['diabetes'];  
    $message=$_REQUEST['message'];
    $InvDiabetesArray=$_REQUEST['InvDiabetesArray'];
    $myArray = explode(',', $message);
    $Mulavg=0;
    $Sum=0;
    $newcalc=0;
    $SubVal=0;
    $DivVal=0;
    $PowVal=0;
    $inc=1;
    $cnt=0;
    $sumdeviation=0;
    $variance=0;
    $stddev=0;

    foreach($myArray as $my_Array)
    {
        if($my_Array>0 && $inc<81)
        {
            $mean_average+=$my_Array;
            $inc++;
        }
    }
    $mean_average=$mean_average/80;
    $inc=1;
   foreach($myArray as $my_Array)
    {
        if($my_Array>0 && $inc<81)
        {
            $sumdeviation = ($sumdeviation + ($my_Array- $mean_average)*($my_Array-$mean_average)); 
            $inc++;
        }
    }
   	$variance = $sumdeviation / 80;
    $stddev= sqrt($variance);
    $DivVal=$mean_average/$stddev;
    $inc=1;
   foreach($myArray as $my_Array)
    {
        if($my_Array>0 && $inc<81)
        {
            $SubVal =$my_Array/$mean_average;
            $SubVal =$SubVal*$stddev;
            $newcalc= $newcalc+($SubVal*1.509);
            $inc++;
        }
    }
    $newcalc=$newcalc/80;
    $finalglu=round($newcalc);


    //Request Values from Device
    $avg_diabetes = $finalglu;
    $bpsys = $_REQUEST['bpsys'];
    $bpdia = $_REQUEST['bpdia'];
    $distance = $_REQUEST['distance'];
    $calorie = $_REQUEST['calorie'];
    $speed = $_REQUEST['speed'];
    $location= $_REQUEST['location'];
    $hb= $_REQUEST['hb'];
           

    $dis_patient1="SELECT testee_name from svasth_doctor_register WHERE device_no='".$sim_no."' order by did desc limit 1";
    $dis_patient2=mysql_query($dis_patient1);
    $dis_patient=mysql_fetch_array($dis_patient2);
    $patient=$dis_patient['testee_name'];

    $dis_patient7="SELECT PatientName,HospitalName from ClinicalPatientRegister WHERE DeviceNo='".$sim_no."' order by id desc limit 1";
    $dis_patient8=mysql_query($dis_patient7);
    $dis_patient9=mysql_fetch_array($dis_patient8);
    $PatientName=$dis_patient9['PatientName'];
    $HospitalName=$dis_patient9['HospitalName'];

    $ecg_peak= $_REQUEST['ecg_peak'];
    $ppg_peak= $_REQUEST['ppg_peak'];
    $highest_ecg=$_REQUEST['highest_ecg'];
    $lowest_ecg= $_REQUEST['lowest_ecg'];
    $std_dev= $_REQUEST['std_dev'];
    $device_no=$_REQUEST['device_no'];
    $mac_no= $_REQUEST['mac_no'];
    $alcohol=$_REQUEST['alcohol'];

    $battery_level=$_REQUEST['battery_level'];
    $lat=$_REQUEST['lat'];
    $longi=$_REQUEST['longi'];
    $weight=$_REQUEST['weight'];
    $height=$_REQUEST['height'];
    $bmi=$_REQUEST['bmi'];
    
    $rfid=$_REQUEST['rfid'];
    $kiosk_location=$_REQUEST['kiosk_location'];
    $kiosk_no=$_REQUEST['kiosk_no'];
    
    $dis_rfid1="SELECT name from svasth_rfid_registration WHERE rfid_no='".$rfid."' order by rfid desc limit 1";
    $dis_rfid2=mysql_query($dis_rfid1);
    $dis_rfid=mysql_fetch_array($dis_rfid2);
    $rfid_us=$dis_rfid['name'];
   

    $sql_insert = "insert into svasth_connect (dt1,dt2,ecg_data,temp,hrpul,spo2,hrecg,diabetes,diabetes_inv,avg_diabetes,bpsys,bpdia,distance,calorie,speed,location,sim_no,dis_name,patient,ecg_peak,ppg_peak,highest_ecg,lowest_ecg,std_dev,device_no,mac_no,alcohol,battery_level,rfid,rfid_user,lat,longi,weight,bmi,height,message,current_date_time,current_dat,current_tim,kiosk_location,kiosk_no,RepeatedCounts,AveragePower,Factor,SumVal,Sqrt,Sumby80,SumbyRepeated,PatientName,HospitalName,rr_rate,calibrated,hb,InvDiabetesArray) values ('$dt1','$dt2','$ecg_data','$temp','$hrpul','$spo2','$hrecg','$diabetes','$diabetes_inv','$avg_diabetes','$bpsys','$bpdia','$distance','$calorie','$speed','$location','$sim_no','$name','$patient','$ecg_peak','$ppg_peak','$highest_ecg','$lowest_ecg','$std_dev','$device_no','$mac_no','$alcohol','$battery_level','$rfid','$rfid_us','$lat','$longi','$weight','$bmi','$height','$message','$current_date_time','$current_dat','$current_tim', '$kiosk_location', '$kiosk_no','$mean_average','$valuecorrelation','$Factor','$Mulavg','$mean_average','$PositiveAvg','$NegativeAvg','$PatientName','$HospitalName','$rr_rate','$calibrated','$hb','$InvDiabetesArray')";
   
    
    mysql_query($sql_insert);
    
    if($sql_insert)
    {
        echo "Successfully Inserted";
        // $result1="SELECT hrpul from svasth_connect where sim_no=".$new_no." order by id desc LIMIT 1";
        // $dis_name2=mysql_query($result1);
        // $dis_name=mysql_fetch_array($dis_name2);
        // $hrpul1=$dis_name['hrpul'];

        // $up_da="UPDATE svasth_connect
        //     SET hrpul=".$hrpul1."
        //     WHERE sim_no =".$ecg_sim_no." order by id desc LIMIT 1 ";
        // mysql_query($up_da);

    }
    else{
        echo "Error occured/No data found for this device";
    }
 ?>

