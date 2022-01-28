<?php

include("config.php");


$id = $_GET['id'];

$view_query = " SELECT * FROM projects 
				WHERE id = '$id'; ";
				
$result = mysqli_query($connection,$view_query);
$record = mysqli_fetch_assoc($result);
$paas_code = $record['paas_code'];

$view_query2 = " SELECT * FROM paas_code 
				WHERE code = '$paas_code'; ";
$paas_code_result = mysqli_query($connection,$view_query2);
$paas_code_record = mysqli_fetch_assoc($paas_code_result);

$status = $record['paas_code'];
$view_query3 = " SELECT * FROM approval_status 
				WHERE name = '$status'; ";
				
$reint_result = mysqli_query($connection,$view_query3);
$reint_record = mysqli_fetch_assoc($reint_result);

?>
<html>
<body bgcolor="fafafa">


<table width ="100%"  height="30" align="left" cellspacing="1">
  <tr>
<td width="50%" height="26" align="center" bgcolor="#C15811" style="border-top-left-radius:15px; border-top-right-radius:15px; font-family:Calibri; font-size:20px; color:#fafafa ">Full Child Record</td>
  </tr>
</table>
 <a href="view.php" style=" color:#666666; font-family:Calibri"><--Back To Directory</a> 
<table width="70%" border="0" align="center">
  <tr>
    <td bgcolor="#cd7940"><span class="style1">Project Details</span></td>
  </tr>
</table>
<table width="70%" border="0" align="center" style="font-family:Calibri; border-collapse:collapse;" bordercolor="#C15811">
  <tr>
    <td width="37%"><img src="cartoon-black-girl-got-idea-191438095.jpg" width="270" height="270"/></td>
    <td width="30%"><p><strong>Project id:</strong> <?php echo $record["id"]; ?></p>
      <p><strong>Project Title:</strong> <?php echo $record["project_id"]; ?></p>
      <p><strong>PAAS Code:</strong> <?php echo $record["paas_code"]; ?> </p>
      <p><strong>Approval Status:</strong> <?php echo $record["approval_status"]; ?></p>
      <p><strong>Fund:</strong> <?php echo $record["fund"]; ?></p>
      <p><strong>PAG Value:</strong> <?php echo $record["pag_value"]; ?>        </p>
      <p><strong>Start Date:</strong> <?php echo $record["start_date"]; ?></p>
    </td>
    <td width="30%"><p><strong>End Date:</strong> <?php echo $record["end_date"]; ?></p>
    <p><strong>Country:</strong> <?php echo $record["country"]; ?></p>
    <p><strong>LEad ORg Unit:</strong> <?php echo $record["lead_org_unit"]; ?></p>
    <p><strong>Theme:</strong> <?php echo $record["theme"]; ?></p>
    <p><strong>Donor:</strong> <?php echo $record["donor"]; ?></p>
    <p><strong>Total Expenditure:</strong> <?php echo $record["total_expenditure"]; ?></p>
    <p><strong>Total Contribution:</strong> <?php echo $record["total_contribution"]; ?></p></td>
	    <p><strong>Total PSC:</strong> <?php echo $record["total_psc"]; ?></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</body>