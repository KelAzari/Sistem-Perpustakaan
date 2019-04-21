<?php  
	include ("../proses/connection.php");
	
	if (isset($_POST['submit'])) {
		$cari = $_POST['cari'];
		
		if(empty($cari)){

			echo "<script> alert('Mohon isi keyword siswa'); </script>";
			$query = "SELECT * FROM tb_siswa ORDER BY NIS";

		}else{

		$query = "SELECT * FROM tb_siswa WHERE NIS LIKE '%".$cari."%' OR nama LIKE '%".$cari."%' OR jurusan LIKE '%".$cari."%' OR tingkat LIKE '%".$cari."%' OR kelas LIKE '%".$cari."%' OR email LIKE '%".$cari."%' OR phone LIKE '%".$cari."%'";

		}
		
	} else {
		$query = "SELECT * FROM tb_siswa ORDER BY NIS";
	}

	if(isset($_POST['refresh'])){
		$query = "SELECT * FROM tb_siswa ORDER BY NIS";
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
	<form method="post" action="">
		<table class="table">
			<tr>
				<td width="28%">
					<a class="link" href="../proses/siswa/add.php" target="framecontent">
					<i class="fa fa-plus icon-gold"></i> &nbsp;
					<font color="#FCDD94" face="Open Sans"><b>Tambahkan Data Siswa</b></font>
					</a> 
				</td>
				<td>
					<input class="cariform" type="text" name="cari" placeholder="Masukan keyword siswa" autocomplete="off">
					
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
						<td><font face="Montserrat" color="#1A1A1A"><b>NIS</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Nama</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Jurusan</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Tingkat</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Kelas</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Email</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Foto</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>No Telp</b></font></td>
						<td colspan="2"><font face="Montserrat" color="#1A1A1A"></font></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$select_stmt = $db->prepare($query);
						$select_stmt->execute();
						while ($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr height='100'>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['NIS']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['nama']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['jurusan']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['tingkat']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['kelas']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['email']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'>";
							echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" height=75/>';
							echo "</td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['phone']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/siswa/edit.php?update_id=".$row['NIS']."'><i class='fa fa-edit icon-gold'></a></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/siswa/delete.php?delete_id=".$row['NIS']."' onClick=\"return confirm('Are you sure want to delete this file ?')\"><i class='fa fa-trash icon-gold'></a></td>";
							echo "</tr>";
						}
					?>
				</tbody>

			</table>
		</center>

	

</body>
</html>