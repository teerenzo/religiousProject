<?php
include("../includes/connect.php");
$id=$_GET['member_id'];
$delete="DELETE from sacrament_issuing WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('member removed successfully.');
window.location.href = 'sustenance';
</script>