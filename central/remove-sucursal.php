<?php
include("../includes/connect.php");
$id=$_GET['suc_id'];
$delete="DELETE from sucursals WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('sucursal removed successfully.');
window.location.href = 'sucursals';
</script>