<?php
	include_once("../connection.php");

	if(isset($_GET['delete_id'])){
		$id = $_GET['delete_id'];

		$sql="DELETE FROM tb_siswa WHERE NIS=:id";
		$delete_stmt = $db->prepare($sql);
		$delete_stmt ->bindParam(':id',$id);
		$delete_stmt ->execute();

        header("Location:../../pages/managesiswa.php?info=berhasildelete");
	}
?>