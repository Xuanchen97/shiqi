<?php  
 if(isset($_POST["export"]))  {
  $connect = mysqli_connect("localhost", "root", "", "library"); 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Tools.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ToolName', 'Barcode', 'Trade', 'Type', 'Location','Donor','status','Damage Level','Kits','Tools','Created Date','Update Date'));  
      $query = "SELECT tbltools.ToolName,
      tbltools.Barcode,
      tbltrade.CategoryName,
      tbltype.TypeName,
      tbllocations.LocationName,
      tbldonors.DonorName,
      tbltools.status,
      tbltools.Damage,
      tbltools.type,
      tbltools.kits,
      tbltools.RegDate,
      tbltools.UpdationDate
      from  tbltools join tbltrade on tbltrade.id=tbltools.TradeId 
      join tbllocations on tbllocations.id=tbltools.LocationId 
      join tbltype on tbltype.id=tbltools.TypeId 
      join tbldonors on tbldonors.id=tbltools.DonorId;";
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  