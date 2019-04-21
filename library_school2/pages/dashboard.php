<?php  
	include '../proses/connection.php';
	session_start();
	try {
		$name = $_SESSION['nama'];
	} catch (Exception $e) {
		echo $e;
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>

	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/wow/css/libs/animate.css">

	<style type="text/css">
		::-webkit-scrollbar {
		  width: 20px;
		}
		
		/* Track */
		::-webkit-scrollbar-track {
		  box-shadow: inset 0 0 5px grey; 
		  border-radius: 10px;
		}
		 
		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: red; 
		  border-radius: 10px;
		}
		
		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #b30000; 
		}
	</style>

</head>
<body class="preload dashbg">

	<div class="dashheader">

		<!--HEADER-->
		<div class="accheader">

			<i class="fa fa-user"></i>
			&nbsp;
			<?php  
				echo $name;
			?>
			
		</div>

		<div class="headertitle">
			<img src="../img/book.png" width="30px"> &nbsp; Sistem <b>Perpustakaan</b>
		</div>

	</div>

	<!--SIDEBAR-->

	<div class="dashsidebar">

		<ul class="fa-ul">
			<li>
				<a href="stats.php" target="framecontent"><i class="fa-li fa fa-chart-line"></i> &nbsp;Dashboard</a>
			</li>
			<li>
				<a href="managebuku.php" target="framecontent"><i class="fa-li fa fa-book"></i> &nbsp;Manage Buku</a>
			</li>
			<li>
				<a href="managesiswa.php" target="framecontent"><i class="fa-li fa fa-users"></i> &nbsp;Manage Siswa</a>
			</li>
			<li>
				<a href="managepenerbit.php" target="framecontent"><i class="fa-li fas fa-gem"></i> &nbsp;Manage Penerbit</a>
			</li>
			<li>
				<a href="managepustakawan.php" target="framecontent"><i class="fa-li fa fa-book-reader"></i> &nbsp;Manage Pustakawan</a>
			</li>
			<li>
				<a href="#"><i class="fa-li fas fa-hand-holding-usd"></i> &nbsp;Peminjaman</a>
			</li>
		</ul>
	</div>

	<!--CONTENT-->

	<div  class="dashcontent">
		<iframe src="stats.php" name="framecontent" scrolling="yes">
		</iframe>
	</div>
		

<script src="../css/wow/dist/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>

</body>
</html>