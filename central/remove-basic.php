<?php
include("../includes/connect.php");
$id=$_GET['suc_id'];
$delete="DELETE from basic_churches WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('basic removed successfully.');
window.location.href = 'basic';
</script>