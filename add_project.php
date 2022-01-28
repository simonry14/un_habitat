<?php
//SET GLOBAL FOREIGN_KEY_CHECKS=0;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//include("config.php");

?>


<?php

//Connect to our MySQL database using the PDO extension.
$pdo = new PDO('mysql:host=localhost;dbname=un_habitat', 'root', '');


$sql = "SELECT id, code FROM paas_code";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$codes = $stmt->fetchAll();

$sql2 = "SELECT id, name FROM approval_status";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$approvals = $stmt2->fetchAll();

$sql3 = "SELECT id, name FROM country";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();
$countries = $stmt3->fetchAll();

$sql4 = "SELECT id, name FROM donor";
$stmt4 = $pdo->prepare($sql4);
$stmt4->execute();
$donors = $stmt4->fetchAll();

$sql5 = "SELECT id, name FROM fund";
$stmt5 = $pdo->prepare($sql5);
$stmt5->execute();
$funds = $stmt5->fetchAll();

$sql6 = "SELECT id, name FROM lead_org_unit";
$stmt6 = $pdo->prepare($sql6);
$stmt6->execute();
$orgs = $stmt6->fetchAll();

$sql7 = "SELECT id, name FROM theme";
$stmt7 = $pdo->prepare($sql7);
$stmt7->execute();
$themes = $stmt7->fetchAll();

include("config.php");

$pag_valueErr  = $total_contributionErr = $total_expenditureErr = $total_pscErr  = $project_idErr = $start_dateErr = $end_dateErr = $project_titleErr  ="";

if(isset($_POST['submit'])){

  $project_id = $_POST['project_id'];
  $project_title = $_POST['project_title'];
  $paas_code = $_POST['paas_code'];
  $approval_status = intval( $_POST['approval_status']);
  $fund = $_POST['fund'];
  $pag_value = $_POST['pag_value'];
  $lead_org_unit = $_POST['lead_org_unit'];
  $theme = $_POST['theme'];
  $donor = $_POST['donor'];
  $total_expenditure = $_POST['total_expenditure'];
  $total_contribution = $_POST['total_contribution'];
  $total_psc = $_POST['total_psc'];
   $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
  
  $mysql_startdate = date ('Y-m-d', strtotime($start_date));
  $mysql_enddate = date ('Y-m-d', strtotime($end_date));
  

  
  if (empty($pag_value)){
    $pag_valueErr = "PAG Value is required";
  }
  if (empty($total_contribution)){
    $total_contributionErr = "Total Contribution is required";
  }
  
  if (empty($total_expenditure)){
    $total_expenditureErr = "Total Expenditure is required";
  }
  if (empty($total_psc)){
    $total_pscErr = "Total PSC is required";
  }
 
  if (empty($project_id)){
    $project_idErr = "Project ID is required";
  }
  if (empty($project_title)){
    $project_titleErr = "Project Title is required";
  }
  if (empty($start_date)){
    $start_dateErr = "Start Date is required";
  }
  
  if (empty($end_date)){
    $end_dateErr = "End Date is required";
  }
  
  
    if (empty($start_dateErr) && empty($end_dateErr)&& empty($project_titleErr)&& empty($project_idErr) &&empty($total_pscErr)&&empty($total_contributionErr)&&empty($pag_valueErr)&&empty($total_expenditureErr)){
    $insert_query = "INSERT INTO project (project_id, project_title, paas_code, approval_status, fund, pag_value, start_date,end_date, country, 
  lead_org_unit, theme, donor, total_expenditure, total_contribution,  total_psc)
   VALUES ('$project_id','$project_title', '$paas_code', '$approval_status', '$fund', '$pag_value', '$mysql_startdate', '$mysql_enddate', '$country',
   '$lead_org_unit', '$theme', '$donor', '$total_expenditure', '$total_contribution', '$total_psc')";
 

   
 echo ($insert_query);
 $result = mysqli_query($connection,$insert_query);

if (!$result) {
echo "something";
echo("Could not add record. " . mysqli_error($connection));
 
}else{

echo "
<script>
  $(document).ready(function() {

    setTimeout(function(){ window.location.href  = 'projects.php'; }, 1500);
  });
  </script>";

}


}


}

?>

<!DOCTYPE html>
<html>

<link href="css/style.css" rel="stylesheet" type="text/css">
<body bgcolor="fafafa">

<form enctype='multipart/form-data' action='' method='POST'>
<table width ="100%"  height="30" align="left" cellspacing="1">
  <tr>
<td width="50%" height="26" align="center" bgcolor="#C15811" style="border-top-left-radius:15px; border-top-right-radius:15px; font-family:Calibri; font-size:20px"></td>
  </tr>
</table>
 <a href="projects.php" style=" color:#666666; font-family:Calibri"><--Back To Projects</a> 


<table width="70%" border="0" align="center" style="font-family:Calibri border-collapse:collapse;" bordercolor="#C15811">
  <tr>
    <td bgcolor="#cd7940" style="font-family:Calibri"><span class="style1">Add New Project</span></td>
  </tr>
</table>
<table width="70%" border="0" align="center" id="Fullrecord_familydetails" style="font-family:Calibri; border-collapse:collapse;" bordercolor="#C15811">
<tr>
  
    
    <td width="20%"><strong>Project ID</strong></td>
    <td width="39%"><input name="project_id" type="text" id="project_id" value="<?= isset($_POST['project_id']) ? $_POST['project_id'] : ''; ?>" size="30"> <span style="color:#FF0000";> <?php echo $project_idErr;?></span></td>
  
  
  </tr>

  <tr>
    <td width="20%" height="37"><p><strong>Project Title:</strong></p>      </td>
    <td width="25%">
    <input name="project_title" type="text" id="project_title" value="<?= isset($_POST['project_title']) ? $_POST['project_title'] : ''; ?>" size="30">  <span style="color:#FF0000";> <?php echo $project_titleErr;?></span>  </td>
   
  </tr>

 
  

 <tr>
    <td width="20%" height="37"><p><strong>PAAS Code:</strong></p>      </td>
    <td width="39%"><select name="paas_code" id="paas_code" value="<?= isset($_POST['paas_code']) ? $_POST['paas_code'] : ''; ?>">
    <?php foreach($codes as $code): ?>
        <option selected="true"  value="<?= $code['id']; ?>"><?= $code['code']; ?></option>
    <?php endforeach; ?>
</select> </td>
   
  </tr>
  
  
   <tr>
    <td width="20%" height="37"><p><strong>Approval Status:</strong></p>      </td>
<td width="39%"><select name="approval_status" id="approval_status" value="<?= isset($_POST['approval_status']) ? $_POST['approval_status'] : ''; ?>">
    <?php foreach($approvals as $approval): ?>
        <option selected="true" value="<?= $approval['id']; ?>"><?= $approval['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
   
  </tr>
  
   <tr>
    <td width="20%" height="37"><p><strong>Fund:</strong></p>      </td>
    <td width="39%"><select name="fund" id="fund" value="<?= isset($_POST['fund']) ? $_POST['fund'] : ''; ?>">
    <?php foreach($funds as $fund): ?>
        <option selected="true" value="<?= $fund['id']; ?>"><?= $fund['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
   
  </tr>
  
   <tr>
    <td width="20%" height="37"><p><strong>PAG Value:</strong></p>      </td>
    <td width="25%">
    <input name="pag_value" type="text" id="pag_value" value="<?= isset($_POST['pag_value']) ? $_POST['pag_value'] : ''; ?>" size="30">  <span style="color:#FF0000";> <?php echo $pag_valueErr;?></span>  </td>
  </tr>




  <tr>
    <td><strong>Start Date:</strong></td>
    <td><input name="start_date" type="date" id="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>" size="30"><span style="color:#FF0000";> <?php echo $start_dateErr;?></span></td>
   
  </tr>
  
    <tr>
    <td><strong>End Date:</strong></td>
    <td><input name="end_date" type="date" id="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>" size="30"><span style="color:#FF0000";> <?php echo $end_dateErr;?></span></td>

   </tr>
   
    <tr>
    <td width="20%" height="37"><p><strong>Country:</strong></p>      </td>
    <td width="39%"><select name="country" id="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
    <?php foreach($countries as $country): ?>
        <option selected="true" value="<?= $country['id']; ?>"><?= $country['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
  </tr>
  
    <tr>
    <td width="20%" height="37"><p><strong>Lead Org. Unit:</strong></p>      </td>
    <td width="39%"><select name="lead_org_unit" id="lead_org_unit " value="<?= isset($_POST['lead_org_unit']) ? $_POST['lead_org_unit'] : ''; ?>">
    <?php foreach($orgs as $org): ?>
        <option selected="true" value="<?= $org['id']; ?>"><?= $org['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
  </tr>
  
  
   <tr>
    <td width="20%" height="37"><p><strong>Theme:</strong></p>      </td>
    <td width="39%"><select name="theme" id="theme" value="<?= isset($_POST['theme']) ? $_POST['theme'] : ''; ?>">
    <?php foreach($themes as $theme): ?>
        <option selected="true" value="<?= $theme['id']; ?>"><?= $theme['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
  </tr>
  
   <tr>
    <td width="20%" height="37"><p><strong>Donor:</strong></p>      </td>
    <td width="39%"><select name="donor" id="donor" value="<?= isset($_POST['donor']) ? $_POST['donor'] : ''; ?>">
    <?php foreach($donors as $donor): ?>
        <option selected="true" value="<?= $donor['id']; ?>"><?= $donor['name']; ?></option>
    <?php endforeach; ?>
</select> </td>
  </tr>
   
  <tr>
    <td width="20%" height="37"><p><strong>Total Expenditure:</strong></p>      </td>
    <td width="25%">
    <input name="total_expenditure" type="text" id="total_expenditure" value="<?= isset($_POST['total_expenditure']) ? $_POST['pag_value'] : ''; ?>" size="30">  <span style="color:#FF0000";> <?php echo $total_expenditureErr;?></span>  </td>
  </tr>
  
    <tr>
    <td width="20%" height="37"><p><strong>Total Contribution:</strong></p>      </td>
    <td width="25%">
    <input name="total_contribution" type="text" id="total_contribution" value="<?= isset($_POST['total_contribution']) ? $_POST['total_contribution'] : ''; ?>" size="30">  <span style="color:#FF0000";> <?php echo $total_contributionErr;?></span>  </td>
  </tr>
  
    <tr>
    <td width="20%" height="37"><p><strong>Total PSC:</strong></p>      </td>
    <td width="25%">
    <input name="total_psc" type="text" id="total_psc" value="<?= isset($_POST['total_psc']) ? $_POST['pag_value'] : ''; ?>" size="30">  <span style="color:#FF0000";> <?php echo $total_pscErr;?></span>  </td>
  </tr>
 

 
</table>



  </tbody>
<p>&nbsp;</p>
  <label>
  <input type="submit" name="submit" id="submit" value="Add Project">
  </label>
</form>  
</body>
</html>