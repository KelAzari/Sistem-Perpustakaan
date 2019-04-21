<?php  
	include ("../proses/connection.php");

	if (isset($_GET['info'])) {
		$info = $_GET['info'];
	}else{
		$info = "";
	}
	
	if (isset($_POST['submit'])) {
		$cari = $_POST['cari'];
		$info = "";
		
		if(empty($cari)){

			echo "<script> alert('Mohon isi keyword penerbit'); </script>";
			$query = "SELECT * FROM tb_penerbit ORDER BY id_penerbit";

		}else{

		$query = "SELECT * FROM tb_penerbit WHERE id_penerbit LIKE '%".$cari."%' OR nama LIKE '%".$cari."%' OR kota LIKE '%".$cari."%' OR phone LIKE '%".$cari."%' OR email LIKE '%".$cari."%'";

		}
		
	} else {
		$query = "SELECT * FROM tb_penerbit ORDER BY id_penerbit";
	}

	if(isset($_POST['refresh'])){
		$query = "SELECT * FROM tb_penerbit ORDER BY id_penerbit";
	}

	if ($info =="berhasildelete") {
		echo "<script>alert('Berhasil Menghapus Data!')</script>";
	}
	if ($info =="berhasiledit") {
		echo "<script>alert('Berhasil Mengubah Data!')</script>";
	}
	if ($info =="berhasiltambah") {
		echo "<script>alert('Berhasil Menambahkan Data!')</script>";
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
	<form method="post" action="">
		<table class="table">
			<tr>
				<td width="28%">
					<a class="link" href="../proses/penerbit/add.php" target="framecontent">
					<i class="fa fa-plus icon-gold"></i> &nbsp;
					<font color="#FCDD94" face="Open Sans"><b>Tambahkan Penerbit</b></font>
					</a> 
				</td>
				<td>
					<input class="cariform" type="text" name="cari" placeholder="Masukan keyword penerbit" autocomplete="off">
					
					<button id="btncari" type="submit" name="submit">
						<i class="fa fa-search"></i>
					</button>
				</td>
			</tr>
		</table>
	</form>

	<br><br>

	<table width="90%" align="center" cellspacing="0">
				<thead>
					<tr bgcolor="#FCDD94" align="center" height="35px">
						<td><font face="Montserrat" color="#1A1A1A"><b>ID Penerbit</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Nama</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Kota</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>No Telp</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Email</b></font></td>
						<td colspan="2"><font face="Montserrat" color="#1A1A1A"></font></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$select_stmt = $db->prepare($query);
						$select_stmt->execute();
						while ($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr height='100'>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['id_penerbit']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['nama']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['kota']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['phone']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['email']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/penerbit/edit.php?update_id=".$row['id_penerbit']."'><i class='fa fa-edit icon-gold'></a></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/penerbit/delete.php?delete_id=".$row['id_penerbit']."' onClick=\"return confirm('Are you sure want to delete this file ?')\"><i class='fa fa-trash icon-gold'></a></td>";
							echo "</tr>";
						}
					?>
				</tbody>

			</table>
		</center>

	

</body>
</html>