<?php  
 if(isset($_POST["export"]))  {
  $connect = mysqli_connect("localhost", "root", "", "library"); 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Tool Rental Record.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('User Name', 'Gender', 'ToolName', 'Issued Date', 'Donor','Donor Email'));  
      $query = "SELECT tblusers.FullName,tblusers.Gender,tbltools.ToolName,tblissuedtooldetails.issuesDate,tbldonors.DonorName,tbldonors.Email from tblissuedtooldetails 
      join tbltools on tblissuedtooldetails.ToolID = tbltools.id
      join tbldonors on tbltools.DonorId = tbldonors.id
      join tblusers on tblissuedtooldetails.UserID = tblusers.UserId;";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  