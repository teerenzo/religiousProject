<?php
include("../includes/connect.php");
$id=$_GET['rel_id'];
$delete="DELETE from diocese WHERE id='".$_GET['rel_id']."'";
$conn->query($delete);
?>
<script type="text/javascript">
alert('Doicese removed successfully.');
window.location.href = 'diocese';
</script>