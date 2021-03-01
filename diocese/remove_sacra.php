<?php
include("../includes/connect.php");
$id=$_GET['sid'];
$delete=$conn->query("DELETE from religion_sacraments WHERE id=$id");
if($delete){
?>
<script type="text/javascript">
alert('Parish removed successfully.');
window.location.href = 'sacraments';
</script>
<?php
    }
?>