<?php
include("../includes/connect.php");
$id=$_GET['p_id'];
$delete="DELETE from parishes WHERE id='$id'";
$conn->query($delete);
?>
<script type="text/javascript">
alert('Parish removed successfully.');
window.location.href = 'parishes';
</script>