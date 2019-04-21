<?php  
	include ("../proses/connection.php");
	
	if (isset($_POST['submit'])) {
		$cari = $_POST['cari'];
		
		if(empty($cari)){

			echo "<script> alert('Mohon isi keyword siswa'); </script>";
			$query = "SELECT * FROM tb_pustakawan ORDER BY id_pustakawan";

		}else{

		$query = "SELECT * FROM tb_pustakawan WHERE id_pustakawan LIKE '%".$cari."%' OR nama LIKE '%".$cari."%' OR phone LIKE '%".$cari."%'";

		}
		
	} else {
		$query = "SELECT * FROM tb_pustakawan ORDER BY id_pustakawan";
	}

	if(isset($_POST['refresh'])){
		$query = "SELECT * FROM tb_pustakawan ORDER BY id_pustakawan";
	}


	if (isset($_GET['info'])) {
		if ($_GET['info']=="berhasildelete") {
			echo "<script>alert('Berhasil Menghapus Data!')</script>";
		}
		if ($_GET['info']=="berhasiledit") {
			echo "<script>alert('Berhasil Mengubah Data!')</script>";
		}
		if ($_GET['info']=="berhasiltambah") {
			echo "<script>alert('Berhasil Menambahkan Data!')</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
</head>
<body bgcolor="#1A1A1A" class="preload">

	<center>

	<br><br>

	<table width="90%" align="center" cellspacing="0">
				<thead>
					<tr bgcolor="#FCDD94" align="center" height="35px">
						<td><font face="Montserrat" color="#1A1A1A"><b>ID Pustakawan</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Nama</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>No. Telp</b></font></td>
						<td colspan="2"><font face="Montserrat" color="#1A1A1A"></font></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$select_stmt = $db->prepare($query);
						$select_stmt->execute();
						while ($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr height='100'>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['id_pustakawan']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['nama']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['phone']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/pustakawan/edit.php?update_id=".$row['nama']."'><i class='fa fa-edit icon-gold'></a></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/pustakawan/delete.php?delete_id=".$row['nama']."' onClick=\"return confirm('Are you sure want to delete this file ?')\"><i class='fa fa-trash icon-gold'></a></td>";
							echo "</tr>";
						}
					?>
				</tbody>

			</table>
		</center>

	

</body>
</html>