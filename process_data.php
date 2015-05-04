<?php
include('connect.php');

if(isset($_POST['action']) && $_POST['action']=="add") //menangani aksi penambahan data pelanggan
  {  
    
	 $name=$_POST['add_name'];
     $address=$_POST['add_address'];
     $studied=$_POST['add_studied'];   //$pattern="/^[A-Z]{2}\d{4}\b/";
	 $workplacement=$_POST['add_workplacement'];
	 $paidperhour=$_POST['add_paidperhour'];
     if(($name=="")||($address == "")){
	  echo '{"status":"1"}';
      exit;
     }
	 /*else if( !preg_match($pattern,$exam_no)){
     echo  '{"status":"2"}';
	 exit;
	 }*/
	 else{
     $test=mysqli_query($con,"INSERT INTO students(name,address,studied,workplacement,paidperhour) VALUES('$name','$address','$studied','$workplacement',$paidperhour)") or die ("data gagal ditambahakan!");
     echo '{"status":"3"}';
     exit; 
	 }
  }

elseif(isset($_POST['action'])&& $_POST['action']=="update") //menangani aksi perubahan data pelanggan
  {
    
    
     $id=$_POST['edit_id'];
     $name=$_POST['edit_name'];
     $address=$_POST['edit_address'];
     $studied=$_POST['edit_studied'];
	 $workplacement=$_POST['edit_workplacement'];
	 $paidperhour=$_POST['edit_paidperhour'];
	 
     $test = mysqli_query($con,"UPDATE students SET name='$name',address='$address',studied='$studied',workplacement='$workplacement',paidperhour=$paidperhour WHERE studentid='$id'") or die ("data gagal di-update!");
     echo '{"status":"3"}';
     exit;
  }
  elseif(isset($_POST['action']) && $_POST['action']=="delete") //menangani aksi penghapusan data pelanggan
  {
     
	 $id = $_POST['delete_id'];
     $test = mysqli_query($con,"delete from students where studentid='$id'");
     if(mysqli_affected_rows($con) == 1){ //jika jumlah baris data yang dikenai operasi delete == 1
       echo '{"status":"1"}';
     }else{
       echo '{"status":"0"}';
     }
     exit;
  }
  ?>