<?php
include("../includes/connect.php");
$id=$_GET['ser_id'];
$delete="DELETE from services WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('service removed successfully.');
window.location.href = 'services';
</script>