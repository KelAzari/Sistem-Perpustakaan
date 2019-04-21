<?php  
	include ("../proses/connection.php");
	
	if (isset($_POST['submit'])) {
		$cari = $_POST['cari'];
		
		if(empty($cari)){

			$query = "SELECT * FROM tb_buku ORDER BY id_buku";

		}else{

		$query = "SELECT * FROM tb_buku WHERE judul LIKE '%".$cari."%'";

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
	<title>Cari Buku</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/wow/css/libs/animate.css">
</head>
<body bgcolor="#1A1A1A">
	<div align="center" class="title">

		<h2 class="siswatitle">Cari <b>Buku</b></h2>

		<hr class="siswahr" size="1" width="500px">
	</div>
	<div class="content">
		<center>
			<table>
				<tr>
					<td width="500px" align="center">
						<form method="post" action="">
							<input id="formcari" type="text" name="cari" placeholder="Masukan keyword buku" autocomplete="off">
							<button id="btncari" type="submit" name="submit">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</td>
				</tr>
			</table>

			<br><br>

			<table width="90%" align="center" cellspacing="0">
				<thead>
					<tr bgcolor="#B3B3B3" align="center" height="35px">
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
	</div>





<script src="../css/wow/dist/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>

</body>
</html>