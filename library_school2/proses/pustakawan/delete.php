<?php
	include_once("../connection.php");

	if(isset($_GET['delete_id'])){
		$id = $_GET['delete_id'];

		$sql="DELETE FROM tb_penerbit WHERE id_penerbit=:id";
		$delete_stmt = $db->prepare($sql);
		$delete_stmt ->bindParam(':id',$id);
		$delete_stmt ->execute();

        header("Location:../../pages/managepenerbit.php?info=berhasildelete");
	}
?>