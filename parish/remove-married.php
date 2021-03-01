<?php
include("../includes/connect.php");
$id = $_GET['member_id'];
$delete = "DELETE from marriage WHERE id=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('Marriage record removed successfully.');
window.location.href = 'married';
</script>