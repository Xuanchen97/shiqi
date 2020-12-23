<?php  
 if(isset($_POST["export"]))  {
  $connect = mysqli_connect("localhost", "root", "", "library"); 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename= Donors.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id', 'Donor', 'Email', 'Phone No.','Create Date','Update Date','Status'));  
      $query = "SELECT * from tbldonors";
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  