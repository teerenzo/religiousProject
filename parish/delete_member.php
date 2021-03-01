<?php
include("../includes/connect.php");
$id=$_GET['member_id'];
$delete="DELETE from believers WHERE believer_ID=$id";
$conn->query($delete);
?>
<script type="text/javascript">
alert('member removed successfully.');
window.location.href = 'members';
</script>