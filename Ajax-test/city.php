<?php
  require_once "db.php";

  $state_id = $_POST["state_id"];

  $result = mysqli_query($conn,"SELECT * FROM tbl_cities where state_id = $state_id");
?>
<option value="">select city</option>

<?php

while($row = mysqli_fetch_array($result)){
?>
<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>

<?php
}
?>