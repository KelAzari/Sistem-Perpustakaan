<?php  
	include ("../proses/connection.php");
	
	if (isset($_POST['submit'])) {
		$cari = $_POST['cari'];
		
		if(empty($cari)){

			echo "<script> alert('Mohon isi keyword buku'); </script>";
			$query = "SELECT * FROM tb_buku ORDER BY id_buku";

		}else{

		$query = "SELECT * FROM tb_buku WHERE id_buku LIKE '%".$cari."%' OR judul LIKE '%".$cari."%' OR pengarang LIKE '%".$cari."%' OR harga LIKE '%".$cari."%' OR jumlah LIKE '%".$cari."%'";

		}
		
	} else {
		$query = "SELECT * FROM tb_buku ORDER BY id_buku";
	}

	if(isset($_POST['refresh'])){
		$query = "SELECT * FROM tb_buku ORDER BY id_buku";
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
					<a class="link" href="../proses/add.php" target="framecontent">
					<i class="fa fa-plus icon-gold"></i> &nbsp;
					<font color="#FCDD94" face="Open Sans"><b>Tambahkan Buku</b></font>
					</a> 
				</td>
				<td>
					<input class="cariform" type="text" name="cari" placeholder="Masukan keyword buku" autocomplete="off">
					
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
						<td><font face="Montserrat" color="#1A1A1A"><b>ID Buku</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Judul</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Pengarang</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Foto</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>ID Penerbit</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Harga</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Jumlah</b></font></td>
						<td colspan="2"><font face="Montserrat" color="#1A1A1A"></font></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$select_stmt = $db->prepare($query);
						$select_stmt->execute();
						while ($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr height='100'>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['id_buku']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['judul']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['pengarang']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><img src='../upload/".$row['photo']."'  height='100'></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['id_penerbit']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['harga']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['jumlah']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/edit.php?update_id=".$row['id_buku']."'><i class='fa fa-edit icon-gold'></a></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><a href='../proses/delete.php?delete_id=".$row['id_buku']."' onClick=\"return confirm('Are you sure want to delete this file ?')\"><i class='fa fa-trash icon-gold'></a></td>";
							echo "</tr>";
						}
					?>
				</tbody>

			</table>
		</center>

	

</body>
</html>