-<?php
include("../includes/connect.php");
$id=$_GET['p_id'];
$new_password = "123456";
$change_password_query="UPDATE users SET password='$new_password' WHERE id='$id'";
$conn->query($change_password_query);
?>
<script type="text/javascript">
alert('Parish account password reset successful.');
window.location.href = 'parishes';
</script>