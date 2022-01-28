<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("config.php");

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

</head>
<body bgcolor="#fafafa" style="font-family:Calibri">
<div><a href="add_project.php" align="center"style="background-color:#CC6600; padding:3px; font-family:Calibri; border-radius:15px;  ">Add New Project</a></div>

<br><br>
<table width="99%" border="4" align="center" bordercolor="#C15811" id = "projects" style="border-collapse:collapse; font-family:Calibri; padding:5px; font-size:14px">
<thead style="position: relative">
<tr >
       	<th bgcolor="#c76828">ID</th>
              	<th bgcolor="#c76828">Project ID</th>
              	<th bgcolor="#c76828">Project Title</th>
              	<th bgcolor="#c76828">PAAS Code</th>
              	<th bgcolor="#c76828">Approval Status</th>
              	<th bgcolor="#c76828">Fund</th>
              	<th bgcolor="#c76828">PAG Value</th>
              	<th bgcolor="#c76828">Start Date</th>
              	<th bgcolor="#c76828">End Date</th>
              	<th bgcolor="#c76828">Country(ies)</th>
              	<th bgcolor="#c76828">Lead Org Unit</th>
              	<th bgcolor="#c76828">Theme(s)</th>
              	<th bgcolor="#c76828">Donor</th>
      			<th bgcolor="#c76828">Total Expenditure</th>
     	      	<th bgcolor="#c76828">Total Contribution</th>
				<th bgcolor="#c76828">Total Contribution - Total Expenditure</th>
				<th bgcolor="#c76828">Total PSC</th>
				<th bgcolor="#0d9a46" colspan="1">Actions</th>
				<th bgcolor="#0d9a46" colspan="1"></th>
				<th bgcolor="#0d9a46" colspan="1"></th>
              
</tr>
</thead>
<tbody>
<?php
$sel_query ="SELECT * FROM project;";
$result = mysqli_query($connection,$sel_query);



while($row = mysqli_fetch_assoc($result)) { ?>
<tr tr:hover { background-color: #f1f1f1;} style="font-size:14px; font-family: Calibri; padding: 3px">
<td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["project_id"]; ?></td>
<td align="center"><?php echo $row["project_title"]; ?></td>
<td align="center"><?php 
$idd = $row["paas_code"];
$sel_query1 ="SELECT code from paas_code WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["code"]; ?>
</td>
<td align="center"><?php 
$idd = $row["approval_status"];
$sel_query1 ="SELECT name from approval_status WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?>
</td>
<td align="center"><?php 
$idd = $row["fund"];
$sel_query1 ="SELECT name from fund WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?></td>
<td align="center"><?php echo "".number_format($row["pag_value"]); ?></td>
<td align="center"><?php echo $row["start_date"]; ?></td>
<td align="center"><?php echo $row["end_date"]; ?></td>
<td align="center"><?php 
$idd = $row["fund"];
$sel_query1 ="SELECT name from fund WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?></td> 
<td align="center"><?php 
$idd = $row["country"];
$sel_query1 ="SELECT name from country WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?></td>
<td align="center"><?php 
$idd = $row["theme"];
$sel_query1 ="SELECT name from theme WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?></td>
<td align="center"><?php 
$idd = $row["donor"];
$sel_query1 ="SELECT name from donor WHERE id = $idd";
$result = mysqli_query($connection,$sel_query1);
$row1 = mysqli_fetch_assoc($result);
echo $row1["name"]; ?></td>

<td align="center"><?php echo "".number_format($row["total_expenditure"]); ?></td>
<td align="center"><?php echo "".number_format($row["total_contribution"]); ?></td>
<td align="center"><?php echo "".number_format($row["total_contribution"] - $row["total_expenditure"]); ?></td>
<td align="center"><?php echo "".number_format($row["total_psc"]); ?></td>

<td align="center" bgcolor="#d2fbe3">
<form method="get" action="project.php"><input type="hidden" name="projectid" value="<?php echo $row["id"]; ?>"><input type="submit" value="View" style="background-color:#d2fbe3; border-color:#d2fbe3; color:#000000; font-family:Calibri; font-size:12px">
</form></td>
<td align="center" bgcolor="#ffe3b1">
<form method="get" action="edit.php"><input type="hidden" name="projectid" value="<?php echo $row["id"]; ?>"><input type="submit" value="Edit" style="background-color:#ffe3b1; border-color:#ffe3b1; color:#000000; font-family:Calibri; font-size:12px">
</form></td>
<td align="center" bgcolor="#fac0c5">
<form method="get" action="delete.php"><input type="hidden" name="projectid" value="<?php echo $row["id"]; ?>"><input type="submit" value="Delete" style="background-color:#fac0c5; border-color:#fac0c5; color:#000000; font-family:Calibri; font-size:12px">
</form></td>
</tr>
<?php /*$count++*/; } ?>
</tbody>
</table>

<script>

$(document).ready( function () {
    $('#projects').DataTable();
} );

</script>

</body>
</html>