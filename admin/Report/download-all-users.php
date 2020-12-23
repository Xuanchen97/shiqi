<?php  
 if(isset($_POST["export"]))  {
  $connect = mysqli_connect("localhost", "root", "", "library"); 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename= Users.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id', 'User Id', 'Full Name', 'Gender', 'Birthdate','Education','Phone No.'
      ,'Phone No.2','Status','Reg Date','Update Date'));  
      $query = "SELECT * from tblusers";
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  