<?php
include("../includes/connect.php");
$new_password = "123456";
$change_password_query=$conn->query("UPDATE users SET password='$new_password' WHERE user_id='".$_GET['rel_id']."'");
if($change_password_query){
?>
<script type="text/javascript">
alert('Religion password has been changed successfully.');
window.location.href = 'religions';
</script>
<?php }else{ ?>
<script type="text/javascript">
alert('Unable to reset password');
</script>
<?php } ?>