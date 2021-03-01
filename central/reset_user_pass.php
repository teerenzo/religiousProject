<?php
include("../includes/connect.php");
$id=$_GET['member_id'];
$sl = $conn->query("SELECT * FROM users WHERE user_id='$id'");
$data = mysqli_fetch_array($sl);

$new_password = "123456";
$change_password_query="UPDATE users SET password='$new_password' WHERE user_id='$id'";
$conn->query($change_password_query);
?>
<script type="text/javascript">
alert('password has been changed to default successfully.');
window.location.href = 'members';
</script>