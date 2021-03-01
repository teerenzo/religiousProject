<?php
include("../includes/connect.php");
$id=$_GET['p_id'];
$delete="DELETE from churches WHERE church_id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('Mosque removed successfully.');
window.location.href = 'mosques';
</script>