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
		<table>
			<tr>
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
						<td><font face="Montserrat" color="#1A1A1A"><b>Harga</b></font></td>
						<td><font face="Montserrat" color="#1A1A1A"><b>Jumlah</b></font></td>
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
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['harga']."		</font></td>";
							echo "<td align='center' style='border-bottom:1pt solid white;'><font face='open sans' color='white'>".$row['jumlah']."		</font></td>";
							echo "</tr>";
						}
					?>
				</tbody>

			</table>
		</center>

	

</body>
</html>