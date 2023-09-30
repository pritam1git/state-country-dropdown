<?php

require_once "db.php";

$country_id = $_POST["country_id"];

$result  = mysqli_query($conn,"SELECT * FROM tbl_states where country_id = $country_id");

?>

<option value=""> select state</option>

<?php

while($row = mysqli_fetch_array($result)){
?> 
<option value="<?php echo $row['id'];?>"><?php echo  $row['name'];?></option>
<?php
}
?>























