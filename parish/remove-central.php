<?php
include("../includes/connect.php");
$id=$_GET['c_id'];
$delete="DELETE from centrals WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('central removed successfully.');
window.location.href = 'centrals';
</script>