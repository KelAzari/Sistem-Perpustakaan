<?php
	session_start();  
	include '../proses/connection.php';

	$query = "SELECT sum(jumlah) as buku from tb_buku";

	$stmt=$db->prepare($query);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$buku = $row['buku'];
	}

	$query = "SELECT COUNT(id_pustakawan) as pustakawan from tb_pustakawan";

	$stmt=$db->prepare($query);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$pustakawan = $row['pustakawan'];
		}

	$query = "SELECT COUNT(id_penerbit) as penerbit from tb_penerbit";

	$stmt=$db->prepare($query);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$penerbit = $row['penerbit'];
		}

	$query = "SELECT COUNT(NIS) as siswa from tb_siswa";

	$stmt=$db->prepare($query);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$siswa = $row['siswa'];
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/wow/css/libs/animate.css">
</head>
<body bgcolor="#1A1A1A">

		<table class="stattable">
			<tr>
				<td>
					<div class="boxbiru">
						<?php echo $buku; ?>
						<br>	
						<b>BUKU</b>
					</div>
				</td>
				<td>
					<div class="boxungu">
						<?php echo $pustakawan; ?>
						<br>	
						<b>PUSTAKAWAN</b>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="boxhijau">
						<?php echo $siswa; ?>
						<br>	
						<b>SISWA</b>
					</div>
				</td>
				<td>
					<div class="boxoranye">
						<?php echo $penerbit; ?>
						<br>	
						<b>PENERBIT</b>
					</div>
				</td>
			</tr>
		</table>
		
			
		
		
	

</body>
</html>